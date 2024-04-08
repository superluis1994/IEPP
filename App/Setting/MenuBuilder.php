<?php

namespace App\Setting;

use Core\Utils;
use App\Setting\Conexion;
use PDO;

class MenuBuilder
{
    private $db;

    public function __construct()
    {
        $this->db = Conexion::getConexion_();
    }

    public function buildMenu()
    { 
        $menuItems = $this->getMenuItems(NULL,$_SESSION["datos"][0]["id"]);
        $menu = $this->organizeMenuItems($menuItems,$_SESSION["datos"][0]["id"]);
        return $this->renderMenu($menu);
    }
    private function getMenuItems($parentId,$userId)
    {
        if ($parentId === NULL) {
            $stmt = $this->db->prepare('SELECT * FROM menu WHERE id_padre IS NULL ORDER BY orden');
        } else {
            $stmt = $this->db->prepare('SELECT * FROM menu WHERE id_padre = :id_padre ORDER BY orden');
            $stmt->bindValue(':id_padre', $parentId, PDO::PARAM_INT);
        }
        $stmt->execute();
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $allMenuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Filtra los ítems de menú según los permisos del usuario
        $filteredMenuItems = [];
        foreach ($allMenuItems as $menuItem) {
            if ($this->userHasPermission($userId, $menuItem['id'])) {
                $filteredMenuItems[] = $menuItem;
            }
        }
        return $filteredMenuItems;
    }
    private function userHasPermission($userId, $menuId) {
        $stmt = $this->db->prepare("SELECT tipo_permiso FROM permisos_user WHERE id_hermano = :userId AND id_menu = :menuId");
        $stmt->execute([':userId' => $userId, ':menuId' => $menuId]);
        $permissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Asumiendo que 'ninguno' significa sin acceso
        if (empty($permissions) || $permissions[0]['tipo_permiso'] === 'ninguno') {
            return false;
        }
        return true;
    }
    // private function organizeMenuItems($items) {
    //     $menu = [];
    //     foreach ($items as $item) {
    //         // Solo agrega al menú si el ítem es un encabezado y tiene hijos
    //         if ($item['id_padre'] === NULL ) {
    //             $children = $this->getMenuItems($item['id'],$_SESSION["datos"][0]["id"]);
    //             if (!empty($children)) { // Comprueba si hay hijos antes de agregarlo al menú
    //                 $menu[$item['id']] = $item;
    //                 $menu[$item['id']]['children'] = $children;
    //             }
    //         }
    //     }
    //     return $menu;
    // }
    private function organizeMenuItems($items, $userId) {
        $menu = [];
        foreach ($items as $item) {
            if ($item['id_padre'] === NULL) {
                // Obtener hijos con permiso
                $children = array_filter($this->getMenuItems($item['id'], $userId), function ($child) use ($userId) {
                    return $this->userHasPermission($userId, $child['id']);
                });
    
                if (!empty($children)) {
                    $menu[$item['id']] = $item;
                    $menu[$item['id']]['children'] = $children;
                }
            }
        }
        return $menu;
    }
    
    

    // private function organizeMenuItems($items)
    // {
    //     $menu = [];
    //     foreach ($items as $item) {
    //         if ($item['id_padre'] === NULL) {
    //             $menu[$item['id']] = $item;
    //             $menu[$item['id']]['children'] = $this->getMenuItems($item['id'],$_SESSION["datos"][0]["id"]);
    //         }
    //     }
    // //    echo var_dump($menu);
    //     return $menu;
    // }

    // Este método principal renderiza el menú completo, incluyendo submenús.
    private function renderMenu($items, $isSubmenu = false, $level = 0)
    {
        $ulClass = $isSubmenu ? "sub-nav collapse" : "navbar-nav iq-main-menu";
        $parentId = $isSubmenu ? "sidebar-menu-level-$level" : "sidebar-menu";
        $html = "<ul class=\"$ulClass\" id=\"$parentId\" data-bs-parent=\"#sidebar-menu\">";

        $html .= sprintf('<li class="nav-item static-item">
        <a class="nav-link static-item disabled" href="%s" tabindex="-1">
            <span class="default-icon">%s</span>
            <span class="mini-icon">-</span>
            </a>
         </li>',
         $url=Utils::url("/panel"),
         $titulo="Home"
        );

        foreach ($items as $item) {
            $hasChildren = !empty($item['children']);
            $collapseId = $hasChildren ? "menu-collapse-" . $item['id'] : '';
            
            // Para ítems con hijos, usamos otro método para renderizar el submenú.
            if ($hasChildren) {
                $html .= $this->renderMenuItemWithChildren($item, $collapseId, $level);
            } else {
                // Para ítems sin hijos, simplemente los agregamos como enlaces normales.
                $html .= $this->renderMenuItemWithoutChildren($item);
            }
        }

        $html .= "</ul>";
        return $html;
    }

    // Método para renderizar ítems de menú que tienen hijos (submenús).
    private function renderMenuItemWithChildren($item, $collapseId, $level,$active="")
    {
        $iconHtml = $this->getIconHtml($item['icono']);
        $rightIconHtml = $this->getRightIconHtml();
        $foco= $this->isActive($item);
        $show = $foco == "true" ? 'show': '';
        $submenuHtml = $this->renderSubMenu($item['children'], $level + 1, $collapseId,$show);
        $collapse = $foco == "true" ? '': 'collapsed';
        $active=$active;
      
        return sprintf(
            '<li class="nav-item has-submenu "><a class="nav-link %s %s" href="#%s" aria-expanded="%s" data-bs-toggle="collapse"  aria-controls="%s">%s<span class="item-name">%s</span>%s</a>%s</li>',
            $active,
            $collapse,
            $collapseId,
            $foco,
            $collapseId,
            $iconHtml,
            $item['titulo'],
            $rightIconHtml,
            $submenuHtml
        );
    }

    // Método para renderizar un ítem de menú sin hijos.
    private function renderMenuItemWithoutChildren($item)
    {
        $active=$this->isActiveSubMenu($item["enlace"]);
        $iconHtml = $this->getIconHtml($item['icono']);
        return sprintf(
            '<li class="nav-item"><a class="nav-link %s" href="%s">%s<span class="item-name">%s</span></a></li>',
            $active,
            Utils::url($item['enlace']),
            $iconHtml,
            $item['titulo']
        );
    }

    // Método dedicado exclusivamente a renderizar submenús.
    private function renderSubMenu($items, $level, $collapseId,$show)
    {
        $parentId = $collapseId;
        $html = "<ul class=\"sub-nav collapse $show\" id=\"$parentId\" data-bs-parent=\"#sidebar-menu\">";

        foreach ($items as $item) {
            $hasChildren = !empty($item['children']);
            $collapseId = $hasChildren ? "menu-collapse-" . $item['id'] : '';
        //    echo  var_dump($item);
            
            if ($hasChildren) {
                $html .= $this->renderMenuItemWithChildren($item, $collapseId, $level);
            } else {
                $html .= $this->renderMenuItemWithoutChildren($item);
            }
        }

        $html .= "</ul>";
        return $html;
    }


    private function getIconHtml($icon)
    {
        // Implementación de ejemplo: ajusta según tus necesidades.
        if (strpos($icon, '<svg') !== false) {
            // Si el ícono ya es un SVG, simplemente lo retornamos.
            return $icon;
        } else {
            // Si el ícono es el nombre de una clase de algún framework de íconos (como FontAwesome).
            return sprintf('<i class="%s"></i>', htmlspecialchars($icon, ENT_QUOTES, 'UTF-8'));
        }
    }


    private function getRightIconHtml()
    {
        // Este método retorna el icono que indica que hay un submenú
        return '<svg class="icon-18" xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>';
    }

    private function isActive($item)
    {
        // Tu lógica para determinar si un elemento está activo.
        // Esto podría basarse en la URL actual, en parámetros específicos, etc.

    //   echo var_dump(explode("/",$item['enlace']));
           $urlLink=explode("/",$item['enlace']);
           $urlActual= explode("/",$this->getCurrentUrl());
           // return $this->getCurrentUrl();
           // return Utils::url($item['enlace']);
        // return $respuesta=Utils::url($item['enlace']) == $this->getCurrentUrl()? "true" : "false";
        return $Rs=@$urlActual[3] == @$urlLink[2] ? "true" : "false";
    }
    private function isActiveSubMenu($item)
    {
      

    //   echo var_dump(explode("/",$item['enlace']));
        //    $urlLink=explode("/",$item['enlace']);
        //    $urlActual= explode("/",$this->getCurrentUrl());
           // return $this->getCurrentUrl();
        //    return Utils::url($item['enlace']);
        return Utils::url($item) == $this->getCurrentUrl()? "active" : "";
        // return $Rs=@$urlActual[3] == @$urlLink[2] ? "true" : "false";
    }
    // Este método obtiene la URL actual.
    private function getCurrentUrl()
    {
        return $_SERVER['REQUEST_URI'];
    }
}

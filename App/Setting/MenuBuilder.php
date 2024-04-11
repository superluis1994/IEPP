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

        $html .= sprintf('<li class="nav-item">
        <a class="nav-link %s" aria-current="page" href="%s">
            <i class="icon">
                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-20">
                    <path opacity="0.4" d="M16.0756 2H19.4616C20.8639 2 22.0001 3.14585 22.0001 4.55996V7.97452C22.0001 9.38864 20.8639 10.5345 19.4616 10.5345H16.0756C14.6734 10.5345 13.5371 9.38864 13.5371 7.97452V4.55996C13.5371 3.14585 14.6734 2 16.0756 2Z" fill="currentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="currentColor"></path>
                </svg>
            </i>
            <span class="item-name">Dashboard</span>
         </a>
        </li>
        <li><hr class="hr-horizontal"></li>
        <li class="nav-item static-item">
        <a class="nav-link static-item disabled" href="%s" tabindex="-1">
            <span class="default-icon">%s</span>
            <span class="mini-icon">-</span>
            </a>
         </li>',
         $this->isActiveSubMenu("/panel"),
         Utils::url("/panel"),
         Utils::url("/panel"),
         $titulo="Menu"
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

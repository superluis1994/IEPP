<?php

namespace App\Setting;

class Paginacion
{

    private $totalRecords;
    private $recordsPerPage;
    private $currentPage;
    private  $grupPage;
    private  $limitedRecord;
    public function __construct($totalRecords, $limitedRecord,$recordsPerPage, $currentPage, $grupPage)
    {
        $this->totalRecords = $totalRecords;
        $this->recordsPerPage = $recordsPerPage;
        $this->currentPage = $currentPage;
        $this->grupPage = $grupPage;
        $this->limitedRecord = $limitedRecord;
    }
    public function getOffset()
    {

        return ($this->currentPage - 1) * $this->recordsPerPage;
    }
    public function createLink($pageLinkClass)
    {
        $totalPages = ceil($this->totalRecords / $this->limitedRecord);
        // $grupPage = urlencode($this->grupPage);
        $links = "";
        /** AQUI ASIGNO EL VALOR DEL GRUPO QUE ESTA CORRIENDO PUEDE SER DE 0-10 ETC*/
        $grupPage=(int)$this->grupPage;
        /** AQUI HAGO EL CALCULO DEL GRUPO SIGUIENTE DE PAGINAS QUE SE VAN A MOSTRAR */
        $SiguenteGrup=$grupPage + $this->recordsPerPage;
          /** AQUI HAGO EL CALCULO DEL GRUPO ANTERIOR DE PAGINAS QUE SE VAN A MOSTRAR */
        $AnteriorGrup= abs($grupPage - $this->recordsPerPage);
        /** ASIGNO EL VALOR ACTUAL QUE SE PRESIONO*/
        $itemActual =intval($this->currentPage);
        /** VALIDO SI YA ESTA LA PRIMERA PAGINA DESACTIVO EL BTN DE ANTERIOR*/
        $disabledClassInicio = $grupPage == 0 ? "disabled text-muted" : "";
        /** VALIDO SI YA ESTA LA ULTIMA PAGINA Y DESACTIVO EL BTN DE SIGUIENTE */
        $disabledClassFinal = $totalPages < $SiguenteGrup   ? "disabled text-muted" : "";

        if ($totalPages > 1) {
            $seguinteActual=$itemActual == $this->recordsPerPage ? 9: $SiguenteGrup-11;
            $links.=" <div class='position-absolute start-0 bottom-4'>
            <span class='text-muted p-4'>Mostrando  del ".( $incial=$itemActual !=1 ? ($itemActual*$this->limitedRecord)-$this->limitedRecord+1:1)." al ".$itemActual*$this->limitedRecord."</span>
          </div>";
            $links .= "
            <ul class='$pageLinkClass'>";
            $links .= " 
             <li class='page-item cursor-pointer'>
                        <a class='page-link $disabledClassInicio' onclick='getSolicitud($seguinteActual,$AnteriorGrup);' aria-label='Previous'>
                            <span aria-hidden='true'>Previous</span>
                        </a>
                  </li>";
            for ($i = 1; $i <= $totalPages; $i++) {
                if($i>=$grupPage && $i<($grupPage+$this->recordsPerPage) ){
                    $active = $i==$itemActual ? "active" : "";

                    $links .= "<li class='page-item cursor-pointer $active'  btn-paginacion><a class='page-link' onclick='getSolicitud($i,$grupPage);'>$i</a></li>";
                }
            }
            $AnteriorActual=$grupPage==0 ? $this->recordsPerPage:$SiguenteGrup;
            $links .= " <li class='page-item cursor-pointer'>
                <a class='page-link $disabledClassFinal'  onclick='getSolicitud($AnteriorActual,$SiguenteGrup);' aria-label='Next'>
                    <span aria-hidden='true'>Next</span>
                </a>
             </li>";
            $links .= "</ul>
            </div>";
        }
        return $links;
    }
}

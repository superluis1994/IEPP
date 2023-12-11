<?php
namespace Core;

class Requiere
{
   private $directorio="";
    public function __construct($directorioBase)
    {
        $this->directorio = $directorioBase;
    }

    public function cargar()
    {
        $archivos = scandir($this->directorio);

        foreach ($archivos as $archivo) {
            if ($archivo != '.' && $archivo != '..') {
                if (is_file($this->directorio . '/' . $archivo)) {
                    require $this->directorio . '/' . $archivo;
              
                }
            }
        }
    }
}

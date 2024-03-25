<?php
namespace App\Setting;

class AntiInyection {

 

    public function __construct() {
       
    }
    function Limpiar($Data){
        $arrayDatos=[];
        foreach ($Data as $key => $value) {
            $arrayDatos[$key] =trim(rtrim(preg_replace("/[^a-zA-Z0-9@# =+-_-]/", "",$value)));
         }
         return $arrayDatos;
    }

        

}


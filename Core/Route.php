<?php
     namespace Core;

     class Route{

          private static $group = "";
          private static $params = [];
          
          public static function get($path , $class){
               $self = self::class; // Definimos la variable `$self`
               self::$params [] = [
                    "path" => $self::$group.$path,
                    "http" =>"GET",
                    "class" => $class,
               ];
               
          }
          //puedes utilizar mas metodos put , delete y el que tu quieras
          public static function post($path , $class){
               $self = self::class; // Definimos la variable `$self`
               self::$params[] = [
                    "path"=>self::$group.$path,
                    "http"=>"POST",
                    "class" => $class,
               ];
          }
          public static function group($path , $class){

               self::$group = $path;
               return $class();
          }
          public static function getRoutes(){
               return self::$params;
          }

     }
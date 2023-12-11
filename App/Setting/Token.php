<?php
namespace app\Setting;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use core\Utils;
class Token 
{
  /**DECODIFICO EL TOKEN */
   public static function getToken($token) {
        try{
           
           $key=$_ENV["JWT_SECRET_KEY"];
           return JWT::decode($token, new Key($key,'HS256'));
     
        }catch(\throwable $th){
          
            return [
                "error"=>$th->getMessage(),
                "status" =>"Token expirado"
         ];
        }
      }
      /** VALIDO EL TOKEN PRIMERO LLAMO LA CLASE getToken Y LUEGO VALIDO */
    public static function validarToken(string $token){
    
        try{
           $TokenRespon=self::getToken($token);
           
           if(!isset($TokenRespon->exp)){
             /** RETORNO LA VISTA SI EL TOKEN ES INVALIDO */
             return  header("Location:".Utils::url('/login'));
            }
          }catch(\Throwable $th){
            /** RETORNO LA VISTA SI HUBO ALGUN ERROR */
            return header("Location:".Utils::url('/login'));
          }
        
        // return true;
        
      }
}


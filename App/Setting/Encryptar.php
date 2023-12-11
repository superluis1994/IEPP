<?php
namespace app\Setting;

class Encryptar {

    private $key;
    private $iv;

    public function __construct($key) {
        $this->key = $key;
    }
/** ESTA FUNCION SE UTILIZA PARA DATOS DELICADOS mgs,contraseñas etc. */
    public function encrypt($data) {
        $iv = openssl_random_pseudo_bytes(16);
        $ciphertext = openssl_encrypt($data, 'aes-256-cbc', $this->key, OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $ciphertext);
    }
    public function decrypt($data) {
        $data = base64_decode($data);
        $iv = substr($data, 0, 16);
        $ciphertext = substr($data, 16);
        return openssl_decrypt($ciphertext, 'aes-256-cbc', $this->key, OPENSSL_RAW_DATA, $iv);
    }
    /** ESTA FUNCION SE UTILIZA PARA LOS ITEM POR EJEMPLO IDs */
    public function encryptItem($data) {
        $iv = str_repeat("\0", 16);
            $ciphertext = openssl_encrypt($data, 'aes-256-cbc', $this->key, OPENSSL_RAW_DATA,$iv);
            return str_replace("/","",base64_encode($ciphertext));
        }
        public function decryptItem($data) {
            $ciphertext = base64_decode($data);
            $iv = str_repeat("\0", 16);
            return openssl_decrypt($ciphertext, 'aes-256-cbc', $this->key, OPENSSL_RAW_DATA, $iv);
        }
        

}




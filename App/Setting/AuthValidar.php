<?php

namespace App\Setting;

use Core\Utils;
use App\Models\UserModel;
use App\Models\DatosUserModel;
use App\Models\SucursalesModel;
use App\Setting\Encryptar;
use App\Setting\AntiInyection;

class AuthValidar
{
    private UserModel $UserModel;
    private DatosUserModel $DatosUserModel;
    private SucursalesModel $SurcursalModel;
    private Encryptar $Encrypto;
    private AntiInyection $antiInyeccion;
    public function __construct()
    {
        $this->UserModel = new UserModel;
        $this->DatosUserModel = new DatosUserModel;
        $this->SurcursalModel = new SucursalesModel;
        $this->Encrypto = new Encryptar($_ENV["JWT_SECRET_KEY"]);
        $this->antiInyeccion = new AntiInyection;
    }
    function Cookies()
    {
        if (!isset($_COOKIE['Auth'])) {

            if (!isset($_SESSION['datosUser'])) {
                return header("Location:" . Utils::url('/Auth/sign-in'));
            }
        } else {
            if (!isset($_SESSION['datosUser'])) {
                if (!isset($_SESSION['datosUser'])) {
                }
                $datos = json_decode($_COOKIE['Auth'], true);

                $Data = [
                    "dui" => $datos["dui"],
                    "password" => $this->Encrypto->decrypt($datos["password"]),
                ];
                //  $Data = $this->antiInyeccion->Limpiar($Data);
                @$userData = $this->UserModel
                    ->QueryEspefico([
                        "user.id_user as id", "data_user.nombre as nombre", "data_user.apellidos",
                        "user.dui as Dui", "user.password as password", "sucursal.nombre as sucursal", "user.rol", "estado.nombre as estado"
                    ])
                    ->MultJoin([
                        ["tablaPk" => "user", "pk" => "id_user", "tablaFk" => "data_user", "fk" => "id_user"],
                        ["tablaPk" => "user", "pk" => "id_sucursal", "tablaFk" => "sucursal", "fk" => "id_sucursal"],
                        ["tablaPk" => "user", "pk" => "status", "tablaFk" => "estado", "fk" => "id_status"],
                    ])
                    ->Mult_Where([
                        [
                            "atributo" => "user.dui", "condicion" => "=",
                            "value" => $Data['dui'], "operador" => ""
                        ]
                    ])->first();

                // print_r($userData);
                if ($userData != null) {
                    if ($this->Encrypto->decrypt($userData[0]["password"]) == $Data["password"]) {
                        if (isset($_POST["cookie"]) && @$_POST["cookie"] == "on") {

                            $array = ['empleado' => $userData[0]["nombre"], 'password' => $userData[0]["password"]];
                            setcookie('Auth', json_encode($array), time() + (60 * 60 * 24 * 30), '/'); // 30 días

                        }
                        @$_SESSION['datosUser'];
                        $datos['id'] = $this->Encrypto->encryptItem($userData[0]['id']);
                        $datos['user'] = $userData[0]['nombre'];
                        $datos['status'] = $userData[0]['estado'];
                        $datos['rol'] = $userData[0]['rol'];
                        $_SESSION['datosUser'] = $datos;
                    }
                }
                return false;
            }
        }
    }
    static function CookiesEnAuth()
    {
        if (isset($_COOKIE['Auth'])) {

            if (!isset($_SESSION['datosUser'])) {

                return header("Location:" . Utils::url('/Auth/sign-in'));
            } else {
            }
        }
        return false;
    }
    static function Session()
    {
        if (!isset($_SESSION['datosUser'])) {
            return true;
        }
        return false;
    }
}

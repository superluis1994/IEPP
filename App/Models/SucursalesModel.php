<?php

namespace App\Models;
use App\Repository\Model;

class SucursalesModel extends Model
{
    protected $Tabla = "sucursal";
    protected $alias = "as sucursal";/// alias de la tabla referente al modelo
    protected $primaryKey = "id_sucursal";
}
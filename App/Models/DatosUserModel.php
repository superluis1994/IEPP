<?php

namespace App\Models;
use App\Repository\Model;

class DatosUserModel extends Model
{
    protected $Tabla = "data_user";
    protected $alias = "as datos_empleados";/// alias de la tabla referente al modelo
    protected $primaryKey = "id_data";
}
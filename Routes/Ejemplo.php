<?php

namespace Routes;

use Core\Route;
use Core\Utils;

Route::group('/ejemplo', function () {
    Route::get('/', "EjemploControllers@index");
    Route::get('', "EjemploControllers@index");
  
});
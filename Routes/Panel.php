<?php

namespace Routes;

use Core\Route;
use Core\Utils;


Route::group('/panel', function () {
    Route::get('', "PanelControllers@home");
    Route::get('/', "PanelControllers@home");
    Route::get('/inicio', "PanelControllers@home");
  
});
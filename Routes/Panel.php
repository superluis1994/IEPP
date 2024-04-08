<?php

namespace Routes;

use Core\Route;
use Core\Utils;


Route::group('/panel', function () {
    Route::get('', "PanelControllers@home");
    Route::get('/', "PanelControllers@home");
    Route::get('/asig/sorto', "PanelControllers@home");
    Route::get('/inicio', "PanelControllers@home");
    Route::get('/salir', "PanelControllers@cerrarSesion");
    
});
Route::group('/panel/adm/Ventas', function () {
    
    Route::get('', "VentaControllers@home");
    Route::get('/', "VentaControllers@home");
});
Route::group('/panel/adm/Rifas', function () {
    
    Route::get('', "RifaControllers@home");
    Route::get('/', "RifaControllers@home");
});
Route::group('/panel/adm/Talento', function () {
    Route::get('', "TalentoControllers@home");
    Route::get('/', "TalentoControllers@home");
});
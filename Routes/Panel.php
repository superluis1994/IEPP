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
    Route::get('/entrada/add', "PanelControllers@addEntrada");
    
});
Route::group('/panel/adm/ventas', function () {
    
    Route::get('', "ventaControllers@home");
    Route::get('/', "ventaControllers@home");
});
Route::group('/panel/adm/rifas', function () {
    
    Route::get('', "rifaControllers@home");
    Route::get('/', "rifaControllers@home");
});
Route::group('/panel/adm/talento', function () {
    Route::get('',"talentoControllers@home");
    Route::get('/',"TalentoControllers@home");
    Route::get('/add',"TalentoControllers@home");
});
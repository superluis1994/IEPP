<?php

namespace Routes;

use Core\Route;
use Core\Utils;


Route::group('/panel', function () {
    // Route::get('', "PanelControllers@home");
    Route::get('/home', "PanelControllers@home");
    // Route::get('/home/', "PanelControllers@home");
    Route::get('/asig/sorto', "PanelControllers@home");
    Route::get('/inicio', "PanelControllers@home");
    Route::get('/salir', "PanelControllers@cerrarSesion");
    Route::get('/entrada/add', "PanelControllers@addEntrada");
    Route::get('/salida/add', "PanelControllers@addSalida");
    
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
    // Route::post('/trasaccion/{tipo}',"TalentoControllers@home");
    Route::post('/paginacion',"TalentoControllers@home");
});
Route::group('/panel/mantenimiento/directivas', function () {
    Route::get('',"DirectivasControllers@home");
    Route::get('/',"DirectivasControllers@home");
    Route::get('/add',"DirectivasControllers@home");
    // Route::post('/trasaccion/{tipo}',"DirectivasControllers@home");
    Route::post('/paginacion',"DirectivasControllers@home");


});
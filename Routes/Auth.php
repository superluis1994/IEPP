<?php

namespace Routes;

use Core\Route;
use Core\Utils;

Route::get('', "SignInControllers@sign_in");
Route::group('/Auth', function () {
    Route::get('', "SignInControllers@sign_in");
    Route::get('/', "SignInControllers@sign_in");
    Route::get('/sign-up', "SignUpControllers@sign_up");
    Route::get('/inscribirse', "SignUpControllers@Inscribirse");
    Route::get('/acceder', "SignInControllers@Acceder");
    // Route::get('/', "EjemploControllers@index");
});
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('prueba');
});

Route::get('/documentacion-offside', function () {
    return view('docum'); 
});
<?php

use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    $name = $request->input('name');
    $password = $request->input('name');
});

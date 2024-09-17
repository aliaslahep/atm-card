<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/customer', function (Request $request) {

    return $return->user();

})->middleware('auth:api-customers');
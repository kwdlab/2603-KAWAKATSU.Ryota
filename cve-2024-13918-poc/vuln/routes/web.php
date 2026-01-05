<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('index');
});

Route::get('/test', function (Request $req) {
    $q = $req->query('q', 'no-param');
    throw new \Exception('エラーメッセージ:' . $q);
});

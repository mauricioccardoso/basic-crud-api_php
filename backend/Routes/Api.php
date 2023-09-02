<?php

use App\Core\Abstractions\Route;

Route::get("/", function () {
    echo "home";
});

Route::get("/hello", function () {
    echo "hello";
});

Route::post('/post', function () {
    echo 'post';
});
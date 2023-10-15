<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::put('changePassword', [AuthController::class, 'changePassword']);
        Route::post('logout', [AuthController::class, 'logout']);
    });

    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', [PostController::class, 'index']);
        Route::get('latest', [PostController::class, 'latest']);
        Route::get('search/{post:slug}', [PostController::class, 'search']);
        Route::post('newComment/{post:slug}', [PostController::class, 'comment']);
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('category/{category:title}', [CategoryController::class, 'search']);
    });

    //admin section
    Route::group(['prefix' => 'admin'], function () {
        Route::group(['prefix' => 'posts'], function () {
            Route::post('create', [PostController::class, 'create']);
            Route::put('update/{post:slug}', [PostController::class, 'update']);
            Route::delete('delete/{post:slug}', [PostController::class, 'delete']);
        });

        Route::group(['prefix' => 'categories'], function () {
            Route::post('create', [CategoryController::class, 'create']);
        });
    });
});

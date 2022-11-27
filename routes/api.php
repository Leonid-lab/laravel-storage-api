<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StorageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|-------------------------------------------------------------------------
|
*/
//Guest routes

Route::post('auth/register', [AuthController::class, 'register']);	// +
Route::post('auth/login', [AuthController::class, 'login']);		// +


//Users routes

Route::group(['middleware' => ['auth:sanctum']], function () {
    
    Route::get('auth/logout', [AuthController::class, 'logout']);	// +

    Route::controller(StorageController::class)->group(function () {

        Route::post('/directory/create', 'createDirectory'); // +
        Route::get('/directory/size/{dirname?}', 'getDirectorySize'); // +
        Route::get('/user/info', 'getUserInfo'); // +

        Route::get('/file/list', 'getList');	// +
        Route::get('/file/publish/{dirname}/{name?}', 'publish');
        Route::post('/file/{dirname?}', 'upload');	// +
        Route::get('/file/{dirname}/{name?}', 'download'); // +
        Route::put('/file/{dirname}/{name?}', 'update'); // +
        Route::delete('/file/{dirname}/{name?}', 'destroy');
        
    });
});

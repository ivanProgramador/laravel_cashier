<?php

use App\Http\Controllers\MainController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/login',[MainController::class,'loginPage']);

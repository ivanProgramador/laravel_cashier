<?php

use App\Http\Controllers\MainController;
use App\Http\Middleware\isGuest;
use App\Http\Middleware\isUser;
use App\Models\User;
use Illuminate\Support\Facades\Route;

//rotas pra visitantes 
Route::middleware([isGuest::class])->group(function(){
    Route::get('/login',[MainController::class,'loginPage'])->name('login');
    Route::get('/login/{id}',[MainController::class,'loginSubmit'])->name('login.submit');
});

//rotas pra usuarios 
Route::middleware([isUser::class])->group(function(){
    Route::redirect('/','login');
    Route::get('/logout',[MainController::class,'logout'])->name('logout');
    Route::get('/planos',[MainController::class,'planos'])->name('planos');
    Route::get('/plan_selected/{id}',[MainController::class,'planSelected'])->name('plano.selected');
    Route::get('/subscription/success',[MainController::class,'subscriptionSuccess'])->name('subscription.success');
});








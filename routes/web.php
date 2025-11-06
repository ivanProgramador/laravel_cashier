<?php

use App\Http\Controllers\MainController;
use App\Http\Middleware\hasSubscription;
use App\Http\Middleware\isGuest;
use App\Http\Middleware\isUser;
use App\Http\Middleware\noSubscription;
use App\Models\User;
use Illuminate\Support\Facades\Route;

//rotas pra visitantes 
Route::middleware([isGuest::class])->group(function(){
    Route::get('/login',[MainController::class,'loginPage'])->name('login');
    Route::get('/login/{id}',[MainController::class,'loginSubmit'])->name('login.submit');
});

//rotas pra usuarios 
Route::middleware([isUser::class])->group(function(){
     
     //não precisam de inscrição 
     Route::redirect('/','login');
     Route::get('/logout',[MainController::class,'logout'])->name('logout');

     //cliente logou mais ainda não comprou nada 

     Route::middleware([noSubscription::class])->group(function(){

       Route::get('/planos',[MainController::class,'planos'])->name('planos');
       Route::get('/plan_selected/{id}',[MainController::class,'planSelected'])->name('plano.selected');
       Route::get('/subscription/success',[MainController::class,'subscriptionSuccess'])->name('subscription.success');
      
     });

     //cliente logou e ja tem um plano 
     Route::middleware([hasSubscription::class])->group(function(){
        Route::get('/dashboard',[MainController::class,'dashboard'])->name('dashboard');
     });

   
    
});








<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function loginPage(){
         return view('login');
    }

    public function loginSubmit($id){
         //login direto 

         $user = User::findOrFail($id);
         if($user){
            auth()->login($user);
            return redirect()->route('planos');
         }
    }

    public function logout(){

      auth()->logout();

      return redirect()->route('login');
      
    }

    public function planos(){

     $prices=[
          "monthly"=>env('STRIPE_PRODUCT_ID').'|'.env('STRIPE_MONTHLY_PRICE_ID'),
          "yearly"=>env('STRIPE_PRODUCT_ID').'|'.env('STRIPE_YEARLY_PRICE_ID'),
          "longest"=>env('STRIPE_PRODUCT_ID').'|'.env('STRIPE_LONGEST_ID')
     ];

     

     
      
     return view('plans',compact('prices'));
     
    }

}
    


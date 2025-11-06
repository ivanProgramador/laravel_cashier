<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
          "monthly"=> Crypt::encryptString(env('STRIPE_PRODUCT_ID').'|'.env('STRIPE_MONTHLY_PRICE_ID')),
          "yearly"=> Crypt::encryptString(env('STRIPE_PRODUCT_ID').'|'.env('STRIPE_YEARLY_PRICE_ID')),
          "longest"=> Crypt::encryptString(env('STRIPE_PRODUCT_ID').'|'.env('STRIPE_LONGEST_ID'))  
     ];

     

     
      
     return view('plans',compact('prices'));
     
    }
    public function planSelected($id){

      //testando se o id que veio e valido
      $plan = Crypt::decryptString($id);

      if(!$plan){
          return redirect()->route('planos');
      }
      
      //se estiver
      
      $plan = explode('|', $plan);
      $default = $plan[0];
      $price_id = $plan[1];

       //abaixo estou chamando as funções diponiveis dentro do Billable
       // depois que esse metodo é executado ele vai para uma apgina interna do stripe 
       //que vai pedir a numerção do cartão e confirmação de pagamento 
       //dados de teste 
       
       /*
         Número do Cartão: 4242 4242 4242 4242
         Data de Validade (MM/AA): Qualquer data futura (ex: 12/34)
         CVC: Qualquer sequência de 3 dígitos (para American Express, use 4 dígitos)   
       */
        return auth()->user()
        ->newSubscription('default',$price_id)
        ->trialDays(5)
        ->allowPromotionCodes()
        ->checkout([
            'success_url' => route('subscription.success'),
            'cancel_url' => route('planos'),
        ]);


      
      
    }
    public function subscriptionSuccess(){
       echo"inscrição feita com sucesso ";
    }

    
    public function dashboard(){
       echo "dashboard ";
    }

}
    


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\fichas;
use App\partida;

class ControladorPrincipal extends Controller
{
    //
    //logea usuario y devuelve token
    public function login(Request $request)
    {
        //

        $email = $request->input('email');
        $pass = $request->input('password');


        if (Auth::attempt(['email'=>$email,'password'=>$pass])) {
            // Authentication passed...

            $rand_part = str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789".uniqid());

            $user = User::where('email','=',$email)->first();
            $user->token = $rand_part;
            $user->save();

            return $user->token;
            
        }else{
            return "error al loggear";
        }
        
    }


    //deslogea al usuario
    public function logout(Request $request)
    {

        $email = $request->input('email');
        $pass = $request->input('password');


        Auth::logout();
        return "Logout +1";

    }


    //devuelve una lista de usuarios que no están en partida
    public function espera(Request $request)
    {  
        $enPartida = $this->comprobarPartidas();
        //hace una sentencia sql para devolver todos los usuarios que no están en partida
        return User::select()->whereNotIn('id',$enPartida)->get();
 
    }





    public function jugar(Request $request)
    {

        try{

         $newPartida = new Partida;

         $user1 = $request->input('usuarioCrea');
         $user2 = $request->input('usuarioAcepta');
        
         $aleatorio = rand(0,1);


         //si aleatorio es 0 empieza las blancas
         if($aleatorio === 0){
            $newPartida->blancas = 1;
         }
         //si aleatorio es 1 empiezan las negras
         else{
            $newPartida->negras = 1;
         }

         $newPartida->user1 = $user1;
         $newPartida->user2 = $user2;

         $newPartida->save();

         return partida::select('id')->where('user1','=',$user1)->get();
         }
         catch (\Exception $e){
            return $e->getMessage();

         }

    }



    //funcion que devuelve una array con los usuarios que están en partida
    private function comprobarPartidas(){
        $usuarios = User::all();
        $partidas = Partida::all();

        $enPartida = [];
         //recorre todos los usuarios que hay
        foreach($usuarios as $user){
            //Recorre todas las partidas que hay
            foreach($partidas as $partida){

                //comprueba si el id del usuario está en el campo user1 o user2 
                //de la partida y lo guarda en una array
                if($user->id == $partida->user1 || $user->id == $partida->user2){ 
                        array_push($enPartida,$user->id);
                    
                }
            }
        }
        return $enPartida;
    }






}





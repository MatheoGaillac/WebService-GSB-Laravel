<?php

namespace App\Http\Controllers;

use App\dao\ServiceLogin;
use Illuminate\Http\Request;

class ControllerLogin extends Controller
{
    public function signIn(Request $request){
        try{
            if ($request->isJson()){
                $data = $request->json()->all();
                $login_visiteur = $data['login_visiteur'];
                $pwd_visiteur = $data['pwd_visiteur'];
                $unService = new ServiceLogin();
                $visiteur = $unService->getConnexion($login_visiteur, $pwd_visiteur);
                return json_encode($visiteur);
            } else {
                $response=array(
                    'status' => '415',
                    'message' => 'La requete doit etre de type JSON'
                );
                return json_encode($response);
            }
        } catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Visiteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Vérifiez si la requête est en JSON
        if ($request->isJson()) {
            $data = $request->json()->all();
            // Validation des données reçues, il faut un login et un password
            $request->validate([
                'login' => 'required',
                'password' => 'required',
            ]);
            // Correspondance pour la validation des données
            $credentials = ['login_visiteur' => $data['login'], 'password' =>
                $data['password']];
            // Auth valide que l'email et le password existe dans la table users
            if (!Auth::attempt($credentials)) {
                return response()->json(['error' => 'The provided credentials are
incorrect.'], 401);
            }
            // on récupère les infos du user
            $visiteur = $request->user();
            // Création et sauvegarde du token user
            $tokenResult2 = $visiteur->createToken('Personal Access Token');
            $token = $tokenResult2->plainTextToken;
            $visiteur->remember_token = $token;
            $visiteur->save();
            // On retourne un JSON pour Angular
            return response()->json([
                'visiteur' => [
                    'id_visiteur' => $visiteur->id_visiteur,
                    'nom_visiteur' => $visiteur->nom_visiteur,
                    'prenom_visiteur' => $visiteur->prenom_visiteur,
                    'type_visiteur' => $visiteur->type_visiteur,
                ],
                'access_token' => $token,
                'token_type' => 'bearer',
            ]);
        }
        // Gestion des erreurs si la requête n'est pas en JSON
        return response()->json(['error' => 'Request must be JSON.'], 415);
    }

    public function logout(Request $request){
        $visiteur = $request->user();
        $visiteur->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\dao\ServiceVisiteur;
use App\Exceptions\MonException;
use Illuminate\Http\Request;

class VisiteurController extends Controller
{
    public function getVisiteurVille($ville_visiteur){
        try{
            $unService = new ServiceVisiteur();
            $response = $unService->getVisiteurVille($ville_visiteur);
            return response()->json($response);
        } catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }

    public function getVisiteurNom($nom){
        try{
            $unService = new ServiceVisiteur();
            $response = $unService->getVisiteurNom($nom);
            return response()->json($response);
        } catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }
}

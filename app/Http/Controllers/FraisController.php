<?php

namespace App\Http\Controllers;

use App\dao\ServiceFrais;
use App\Exceptions\MonException;
use App\Models\Visiteur;
use Request;
use Illuminate\Support\Facades\Session;
Use App\Models\User;
use Exception;

class FraisController extends Controller
{
    public function getFraisVisiteur($id_visiteur){
        try{
            $unService = new ServiceFrais();
            $response = $unService->getFraisVisiteur($id_visiteur);
            return $response;
        } catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }

    public function getFraisMois($mois){
        try{
            $unService = new ServiceFrais();
            $response = $unService->getFraisMois($mois);
            return response()->json($response);
        } catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }

    public function addFrais(){
        try {
            $json = file_get_contents('php://input');
            $fraisJson = json_decode($json);
            if ($fraisJson != null){
                $anneeMois = $fraisJson->anneemois;
                $dateModification = $fraisJson->datemodification;
                $montanValide = $fraisJson->montantvalide;
                $nbJustificatifs = $fraisJson->nbjustificatifs;
                $idVisiteur = $fraisJson->id_visiteur;
                $etat = $fraisJson->id_etat;
                $unService = new ServiceFrais();
                $response = $unService->addFrais($anneeMois, $dateModification, $montanValide, $nbJustificatifs, $idVisiteur, $etat);
                return response()->json($response);
            }
        }  catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur, 201);
        }
    }

    public function updateFrais(){
        try {
            $json = file_get_contents('php://input');
            $fraisJson = json_decode($json);
            if ($fraisJson != null){
                $idfrais = $fraisJson->id_frais;
                $anneeMois = $fraisJson->anneemois;
                $dateModification = $fraisJson->datemodification;
                $montanValide = $fraisJson->montantvalide;
                $nbJustificatifs = $fraisJson->nbjustificatifs;
                $idVisiteur = $fraisJson->id_visiteur;
                $etat = $fraisJson->id_etat;
                $unService = new ServiceFrais();
                $response = $unService->updateFrais($idfrais, $anneeMois, $dateModification, $montanValide, $nbJustificatifs, $idVisiteur, $etat);
                return response()->json($response);
            }
        }  catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur, 201);
        }
    }

    public function deleteFrais(){
        try{
            $json = file_get_contents('php://input');
            $fraisJson = json_decode($json);
            if ($fraisJson != null){
                $idfrais = $fraisJson->id_frais;
                $unService = new ServiceFrais();
                $response = $unService->deleteFrais($idfrais);
                return response()->json($response);
            }
        }   catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur, 201);
        }
    }

    public function getSumFraisMois($mois){
        try{
            $unService = new ServiceFrais();
            $response = $unService->getSumFraisMois($mois);
            return response()->json($response);
        } catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur, 201);
        }
    }

    public function getNbHFParFrais($id_frais){
        try{
            $unService = new ServiceFrais();
            $response = $unService->getNbHFParFrais($id_frais);
            return response()->json($response);
        } catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur, 201);
        }
    }
}

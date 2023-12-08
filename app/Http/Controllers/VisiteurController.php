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

    public function addVisiteur(){
        try {
            $json = file_get_contents('php://input');
            $visiteurJson = json_decode($json);
            if ($visiteurJson != null){
                $id_laboratoire = $visiteurJson->id_laboratoire;
                $id_secteur = $visiteurJson->id_secteur;
                $nom_visiteur = $visiteurJson->nom_visiteur;
                $prenom_visiteur = $visiteurJson->prenom_visiteur;
                $adresse_visiteur = $visiteurJson->adresse_visiteur;
                $cp_visiteur = $visiteurJson->cp_visiteur;
                $ville_visiteur = $visiteurJson->ville_visiteur;
                $date_embauche = $visiteurJson->date_embauche;
                $login_visiteur = $visiteurJson->login_visiteur;
                $pwd_visiteur = $visiteurJson->pwd_visiteur;
                $type_visiteur = $visiteurJson->type_visiteur;
                $unService = new ServiceVisiteur();
                $response = $unService->addVisiteur($id_laboratoire, $id_secteur, $nom_visiteur, $prenom_visiteur, $adresse_visiteur, $cp_visiteur, $ville_visiteur, $date_embauche, $login_visiteur, $pwd_visiteur, $type_visiteur);
                return response()->json($response);
            }
        }  catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur, 201);
        }
    }

    public function updateVisiteur(){
        try {
            $json = file_get_contents('php://input');
            $visiteurJson = json_decode($json);
            if ($visiteurJson != null){
                $id_visiteur = $visiteurJson->id_visiteur;
                $id_laboratoire = $visiteurJson->id_laboratoire;
                $id_secteur = $visiteurJson->id_secteur;
                $nom_visiteur = $visiteurJson->nom_visiteur;
                $prenom_visiteur = $visiteurJson->prenom_visiteur;
                $adresse_visiteur = $visiteurJson->adresse_visiteur;
                $cp_visiteur = $visiteurJson->cp_visiteur;
                $ville_visiteur = $visiteurJson->ville_visiteur;
                $date_embauche = $visiteurJson->date_embauche;
                $login_visiteur = $visiteurJson->login_visiteur;
                $pwd_visiteur = $visiteurJson->pwd_visiteur;
                $type_visiteur = $visiteurJson->type_visiteur;
                $unService = new ServiceVisiteur();
                $response = $unService->updateVisiteur($id_visiteur, $id_laboratoire, $id_secteur, $nom_visiteur, $prenom_visiteur, $adresse_visiteur, $cp_visiteur, $ville_visiteur, $date_embauche, $login_visiteur, $pwd_visiteur, $type_visiteur);
                return response()->json($response);
            }
        }  catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur, 201);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\dao\ServicePraticien;
use App\Exceptions\MonException;
use Illuminate\Http\Request;

class PraticienController extends Controller
{
    public function getPraticienByNom($nom_praticien){
        try{
            $unService = new ServicePraticien();
            $response = $unService->getPraticienByNom($nom_praticien);
            return response()->json($response);
        } catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur, 201);
        }
    }

    public function getPraticienByID($id_praticien){
        try{
            $unService = new ServicePraticien();
            $response = $unService->getPraticienByID($id_praticien);
            return $response;
        } catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }

    public function getInvitationPraticien($id_praticien){
        try{
            $unService = new ServicePraticien();
            $response = $unService->getInvitationPraticien($id_praticien);
            return $response;
        } catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }

    public function getPraticienByType($id_type_praticien){
        try{
            $unService = new ServicePraticien();
            $response = $unService->getPraticienByType($id_type_praticien);
            return $response;
        } catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }

    public function search($critere = null)
    {
        $servicePraticien = new ServicePraticien();

        try {
            $praticiens = $servicePraticien->searchPraticiens($critere);

            return $praticiens;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getUneInvitation($id_praticien, $id_activite_compl){
        try{
            $unService = new ServicePraticien();
            $response = $unService->getUneInvitation($id_praticien, $id_activite_compl);
            return $response;
        } catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }

    public function addInvitation(){
        try {
            $json = file_get_contents('php://input');
            $inviterJson = json_decode($json);
            if ($inviterJson != null){
                $id_activite_compl = $inviterJson->id_activite_compl;
                $id_praticien = $inviterJson->id_praticien;
                $specialiste = $inviterJson->specialiste;
                $unService = new ServicePraticien();
                $response = $unService->addInvitation($id_activite_compl, $id_praticien, $specialiste);
                return response()->json($response);
            }
        }  catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur, 201);
        }
    }

    public function updateInvitation(){
        try {
            $json = file_get_contents('php://input');
            $inviterJson = json_decode($json);
            if ($inviterJson != null){
                $id_activite_compl = $inviterJson->id_activite_compl;
                $id_praticien = $inviterJson->id_praticien;
                $old_id_activite_compl = $inviterJson->old_id_activite_compl;
                $unService = new ServicePraticien();
                $response = $unService->updateInvitation($id_activite_compl, $id_praticien, $old_id_activite_compl);
                return response()->json($response);
            }
        }  catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur, 201);
        }
    }

    public function deleteInvitation(){
        try{
            $json = file_get_contents('php://input');
            $inviterJson = json_decode($json);
            if ($inviterJson != null){
                $id_activite_compl = $inviterJson->id_activite_compl;
                $id_praticien = $inviterJson->id_praticien;
                $unService = new ServicePraticien();
                $response = $unService->deleteInvitation($id_activite_compl, $id_praticien);
                return response()->json($response);
            }
        }   catch (MonException $e){
            $erreur = $e->getMessage();
            return response()->json($erreur, 201);
        }
    }
}

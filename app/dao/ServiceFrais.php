<?php

namespace App\dao;

use App\Models\Frais;
use App\Models\Visiteur;

class ServiceFrais
{
    function getFraisVisiteur($id_visiteur){
        return response()->json(Visiteur::find($id_visiteur)->Frais()->get());
    }

    function addFrais($anneeMois, $dateModification, $montanValide, $nbJustificatifs, $idVisiteur, $etat){
        $frais = new Frais();
        $frais->anneemois = $anneeMois;
        $frais->datemodification = $dateModification;
        $frais->montantvalide = $montanValide;
        $frais->nbjustificatifs = $nbJustificatifs;
        $frais->id_visiteur = $idVisiteur;
        $frais->id_etat = $etat;
        $frais->save();
        return response()->json($frais);
    }

}

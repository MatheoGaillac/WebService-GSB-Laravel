<?php

namespace App\dao;

use App\Models\Etat;
use App\Models\Frais;
use App\Models\Fraishorsforfait;
use App\Models\Visiteur;

class ServiceFrais
{
    function getFraisVisiteur($id_visiteur){
        return response()->json(Visiteur::find($id_visiteur)->Frais()->join('etat', 'frais.id_etat', '=', 'etat.id_etat')->get());
    }

    function getUnFrais($id_frais){
        return response()->json(Frais::where('id_frais', '=', $id_frais)->join('etat', 'frais.id_etat', '=', 'etat.id_etat')->first());
    }

    function getEtats(){
        $fraisData = Etat::all();
        return response()->json($fraisData);
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
        return response()->json(['statuts' => "Insertion réalisée"], 200);
    }

    function updateFrais($idfrais, $anneeMois, $dateModification, $montanValide, $nbJustificatifs, $idVisiteur, $etat){
        $frais = Frais::find($idfrais);
        $frais->anneemois = $anneeMois;
        $frais->datemodification = $dateModification;
        $frais->montantvalide = $montanValide;
        $frais->nbjustificatifs = $nbJustificatifs;
        $frais->id_visiteur = $idVisiteur;
        $frais->id_etat = $etat;
        $frais->save();
        return response()->json(['statuts' => "Modification réalisée"], 200);
    }

    function deleteFrais($id_frais){
        Frais::destroy($id_frais);
        return response()->json(['statuts' => "Suppression réalisée"], 200);
    }

    function getFraisMois($mois){
        $mois = '%-' . $mois;
        return response()->json(Frais::where('anneemois', 'LIKE', $mois)->get());
    }

    function getSumFraisMois($mois){
        $mois = '%-' . $mois;
        return response()->json(Frais::where('anneemois', 'LIKE', $mois)->sum('montantvalide'));
    }

    function getNbHFParFrais($id_frais){
        return response()->json(Fraishorsforfait::where('id_frais', '=', $id_frais)->count('id_fraishorsforfait'));
    }
}

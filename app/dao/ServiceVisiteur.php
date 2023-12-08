<?php

namespace App\dao;

use App\Models\Visiteur;
use Illuminate\Support\Facades\Hash;

class ServiceVisiteur
{
    function getVisiteurVille($ville_visiteur){
        return response()->json(Visiteur::where('ville_visiteur', '=', $ville_visiteur)->get());
    }

    function getVisiteurNom($nom){
        $nom = '%' . $nom . '%';
        return response()->json(Visiteur::where('nom_visiteur', 'LIKE', $nom)->get());
    }

    function addVisiteur($id_laboratoire, $id_secteur, $nom_visiteur, $prenom_visiteur, $adresse_visiteur, $cp_visiteur, $ville_visiteur, $date_embauche, $login_visiteur, $pwd_visiteur, $type_visiteur){
        $visiteur = new Visiteur();
        $visiteur->id_laboratoire = $id_laboratoire;
        $visiteur->id_secteur = $id_secteur;
        $visiteur->nom_visiteur = $nom_visiteur;
        $visiteur->prenom_visiteur = $prenom_visiteur;
        $visiteur->adresse_visiteur = $adresse_visiteur;
        $visiteur->cp_visiteur = $cp_visiteur;
        $visiteur->ville_visiteur = $ville_visiteur;
        $visiteur->date_embauche = $date_embauche;
        $visiteur->login_visiteur = $login_visiteur;
        $visiteur->pwd_visiteur = Hash::make($pwd_visiteur, );
        $visiteur->type_visiteur = $type_visiteur;
        $visiteur->save();
        return response()->json(['statuts' => "Insertion réalisée"], 200);
    }
}

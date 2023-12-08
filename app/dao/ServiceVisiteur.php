<?php

namespace App\dao;

use App\Models\Visiteur;

class ServiceVisiteur
{
    function getVisiteurVille($ville_visiteur){
        return response()->json(Visiteur::where('ville_visiteur', '=', $ville_visiteur)->get());
    }
}

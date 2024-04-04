<?php

namespace App\dao;

use App\Models\Inviter;
use App\Models\Praticien;

class ServicePraticien
{
    function getPraticienByNom($nom_praticien)
    {
        return response()->json(Praticien::where('nom_praticien', '=', $nom_praticien)->get());
    }

    function getPraticienByType($id_type_praticien)
    {
        return response()->json(Praticien::where('praticien.id_type_praticien', '=', $id_type_praticien)->join('type_praticien', 'praticien.id_type_praticien', '=', 'type_praticien.id_type_praticien')->get());
    }

    function addInvitation($id_activite_compl, $id_praticien, $specialiste)
    {
        $inviter = new Inviter();
        $inviter->id_activite_compl = $id_activite_compl;
        $inviter->id_praticien = $id_praticien;
        $inviter->specialiste = $specialiste;
        $inviter->save();
        return response()->json(['statuts' => "Insertion réalisée"], 200);
    }
}

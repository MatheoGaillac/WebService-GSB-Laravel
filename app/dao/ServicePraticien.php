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

    function updateInvitation($id_activite_compl, $id_praticien, $old_id_activite_compl)
    {
        $inviter = Inviter::where('id_praticien', $id_praticien)
            ->where('id_activite_compl', $old_id_activite_compl)
            ->update([
                'id_praticien' => $id_praticien,
                'id_activite_compl' => $id_activite_compl,
                'specialiste' => ""
            ]);
        return response()->json(['status' => "Invitation modifiée avec succès", 200]);
    }

    function deleteInvitation($id_activite_compl, $id_praticien){
        Inviter::where('id_activite_compl', $id_activite_compl)
            ->where('id_praticien', $id_praticien)
            ->delete();
        return response()->json(['status' => "Suppression réalisée"], 200);
    }
}

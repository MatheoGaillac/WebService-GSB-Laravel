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

    function getPraticienByID($id_praticien)
    {
        return response()->json(Praticien::where('id_praticien', '=', $id_praticien)->first());
    }

    function getInvitationPraticien($id_praticien)
    {
        return response()->json(Inviter::where('inviter.id_praticien', '=', $id_praticien)->join('activite_compl', 'inviter.id_activite_compl', '=', 'activite_compl.id_activite_compl')->get());
    }

    function getPraticienByType($id_type_praticien)
    {
        return response()->json(Praticien::where('praticien.id_type_praticien', '=', $id_type_praticien)->join('type_praticien', 'praticien.id_type_praticien', '=', 'type_praticien.id_type_praticien')->get());
    }

    public function searchPraticiens($critere = null)
    {
        try {
            $query = Praticien::query()->with('type_praticien');

            if ($critere !== null) {
                $query->where('nom_praticien', 'LIKE', "$critere%")
                    ->orWhereHas('type_praticien', function ($query) use ($critere) {
                        $query->where('lib_type_praticien', 'LIKE', "%$critere%");
                    });
            }

            $praticiens = $query->get();

            return response()->json($praticiens);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    function getUneInvitation($id_praticien, $id_activite_compl){
        return response()->json(Inviter::where('id_praticien', '=', $id_praticien)->where('id_activite_compl', '=', $id_activite_compl)->first());
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

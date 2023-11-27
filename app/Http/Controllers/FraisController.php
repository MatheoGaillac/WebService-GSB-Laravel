<?php

namespace App\Http\Controllers;

use App\metier\Frais;
use App\Models\Visiteur;
use Request;
use Illuminate\Support\Facades\Session;
Use App\Models\User;
use Exception;

class FraisController extends Controller
{
    function getFraisVisiteur($id){
        return response()->json(Visiteur::find($id)->Frais()->get());
    }
}

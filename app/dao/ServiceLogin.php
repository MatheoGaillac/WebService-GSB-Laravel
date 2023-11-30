<?php

namespace App\dao;

use App\Exceptions\MonException;
use App\Models\Visiteur;
use Doctrine\DBAL\Query\QueryException;

class ServiceLogin
{
    public function getConnexion($login_visiteur, $pwd_visiteur)
    {
        $visiteur = null;
        if ($login_visiteur != null) {
            try {
                $visiteur = Visiteur::where('login_visiteur', $login_visiteur)->first();

                if ($visiteur != null && $visiteur->pwd_visiteur == $pwd_visiteur) {
                    $response = $visiteur;
                } else {
                    $response = array(
                        'status' => '401',
                        'message' => 'Authentification incorrecte'
                    );
                }
            } catch (QueryException $e) {
                throw new MonException($e->getMessage());
            }
        }
        return $response;
    }
}

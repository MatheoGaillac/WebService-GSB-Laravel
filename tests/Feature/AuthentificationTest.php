<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthentificationTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_liste_pas_affichee_si_pas_connecte(): void
    {
        $response = $this->get('/getListeFrais/');

        $response->assertStatus(401);
    }
}

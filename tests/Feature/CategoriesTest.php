<?php

namespace App\Http\Controllers\Api\Auth;

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;

class CategoriesTest extends TestCase
{
    // use RefreshDatabase;

    protected $token;

    protected function setUp(): void
    {
        parent::setUp();

        // Persiapkan token bearer di sini
        $this->token = 'Bearer ' . $this->getToken('adminperqara@gmail.com', 'perqara123');
    }

    protected function getToken($email, $password)
    {
        $credentials = ['email' => $email, 'password' => $password];

        //check jika "email" dan "password" tidak sesuai
        if (!$token = auth()->guard('api')->attempt($credentials)) {

            //response login "failed"
            return null;
        }

        return $token;
    }

    public function testStore()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => $this->token,
        ])->postJson('/api/admin/categories', [
            'name' => 'Investasi', // => ganti value parameter name
        ]);

        $response->assertStatus(201);
    }
}

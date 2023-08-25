<?php

namespace Tests\Feature;


// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use DatabaseTransactions;


class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response = $this->get('/anagrafiche');
      
    }

 
    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get(uri:'/products');
        $response->assertStatus(200);
        $response->assertSee('Magazzino');
        
    }

 /*   public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'test2',
            'email' => 'test2@email.it',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);
 
        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
   */ 

}

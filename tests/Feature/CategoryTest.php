<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->loginWithFakeUser(1);
        $response = $this->get(route('categories.index'));
        $response->assertStatus(200);
        
        $this->loginWithFakeUser(0);
        $response = $this->get(route('categories.index'));
        $response->assertRedirect(route('dashboard'));
    }
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateOrUpdate()
    {
        $this->loginWithFakeUser(1);
        $response = $this->json('POST', route('categories.store'), 
                [
                    'name' => strtotime('now')
                ]);
        $response->assertStatus(422);
        
        $name = 'New Cat' . strtotime('now');
        $response = $this->json('POST', route('categories.store'), 
                [
                    'name' => $name,
                    'slug' => $name,
                    
                ]);
        $response->assertStatus(302);
        
        $this->loginWithFakeUser(0);
        $response = $this->json('POST', route('categories.store'), 
                [
                    'name' => strtotime('now'),
                    'description' => 'Testsing'
                ]);
        $response->assertRedirect(route('dashboard'));
        
    }
    
    public function loginWithFakeUser($isAdmin)
    {
        $user = new User([
            'id' => 1,
            'name' => 'Test',
            'is_admin' => $isAdmin
        ]);

        $this->be($user);
    }
}

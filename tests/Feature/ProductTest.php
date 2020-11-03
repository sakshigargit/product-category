<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->loginWithFakeUser(1);
        $response = $this->get(route('products.index'));
        $response->assertStatus(200);
        
        $this->loginWithFakeUser(0);
        $response = $this->get(route('products.index'));
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
        $response = $this->json('POST', route('products.store'), 
                [
                    'name' => strtotime('now')
                ]);
        $response->assertStatus(422);
        
        $response = $this->json('POST', route('products.store'), 
                [
                    'name' => strtotime('now'),
                    'description' => 'Testing',
                    'price' => floatval('1.01'),
                    'qty' => 20,
                    
                ]);
        $response->assertStatus(422);
        $response = $this->get(route('categories.index'));
        $categories = $response->original->getData()['categories'];
        
        Storage::fake('images');
        $name = strtotime('now');
        $response = $this->json('POST', route('products.store'), 
                [
                    'name' => $name,
                    'slug' => $name,
                    'description' => 'Testing ' . $name,
                    'price' => floatval('1.01'),
                    'qty' => 20,
                    'category_id' => !empty($categories[0]) ? $categories[0]['id'] : 0,
                    'image' => UploadedFile::fake()->image('avatar.jpg'),
                    'is_active' => 0
                    
                ]);
        $response->assertStatus(302);
        
        $this->loginWithFakeUser(0);
        $response = $this->json('POST', route('products.store'), 
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

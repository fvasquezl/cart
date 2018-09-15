<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProductsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_user_can_not_create_products()
    {
        $response = $this->postJson(route('admin.products.store'),$this->productData());
        $response->assertStatus(401);
    }

    /** @test */
    public function client_user_can_not_create_products()
    {
        $client = $this->clientUser();
        $this->actingAs($client);
        $response = $this->postJson(route('admin.products.store'),$this->productData());
        $response->assertStatus(401);
    }

    /** @test **/
    public function admin_user_can_create_products()
    {
        $this->withoutExceptionHandling();
        // 1.Given
        $admin = $this->adminUser();
        $this->actingAs($admin);
        // 2.When
        $response = $this->postJson(route('admin.products.store'),$this->productData());
        // 3.Then

        $response->assertJson([
            'data'=>$this->productData()
        ]);
        $this->assertDatabaseHas('products',$this->productData());
    }

    /** @test **/
    public function the_product_requires_a_name()
    {
        // 1.Given
        $admin = $this->adminUser();
        $this->actingAs($admin);
        // 2.When
        $response = $this->postJson(route('admin.products.store'),$this->productData(['name'=>'']));
        // 3.Then
        //dd($response->getContent());
        $response->assertStatus(422); //HTTP_UNPROCESSABLE_ENTITY
        $response->assertJsonStructure([
            'message','errors'=> ['name']
        ]);
    }

    /** @test **/
    public function the_product_name_must_be_string()
    {
        // 1.Given
        $admin = $this->adminUser();
        $this->actingAs($admin);
        // 2.When
        $response = $this->postJson(route('admin.products.store'),$this->productData(['name'=>12345]));
        // 3.Then
        $response->assertStatus(422); //HTTP_UNPROCESSABLE_ENTITY
        $response->assertJsonStructure([
            'message','errors'=> ['name']
        ]);
    }

    /** @test **/
    public function the_product_name_must_not_be_greater_than_60_or_less_than_5_characters()
    {
        // 1.Given
        $admin = $this->adminUser();
        $this->actingAs($admin);
        // 2.When
        $response = $this->postJson(route('admin.products.store'),$this->productData(['name'=>str_random(61)]));
        // 3.Then
        $response->assertStatus(422); //HTTP_UNPROCESSABLE_ENTITY
        $response->assertJsonStructure([
            'message','errors'=> ['name']
        ]);

        $response = $this->postJson(route('admin.products.store'),$this->productData(['name'=>'asdf']));
        // 3.Then
        $response->assertStatus(422); //HTTP_UNPROCESSABLE_ENTITY
        $response->assertJsonStructure([
            'message','errors'=> ['name']
        ]);

    }


    /** @test **/
    public function the_product_requires_a_description()
    {
        // 1.Given
        $admin = $this->adminUser();
        $this->actingAs($admin);
        // 2.When
        $response = $this->postJson(route('admin.products.store'),$this->productData(['description'=>'']));
        // 3.Then
        //dd($response->getContent());
        $response->assertStatus(422); //HTTP_UNPROCESSABLE_ENTITY
        $response->assertJsonStructure([
            'message','errors'=> ['description']
        ]);
    }


    /** @test **/
    public function the_product_requires_a_price()
    {
        // 1.Given
        $admin = $this->adminUser();
        $this->actingAs($admin);
        // 2.When
        $response = $this->postJson(route('admin.products.store'),$this->productData(['price'=>'asdf']));
        // 3.Then
        //dd($response->getContent());
        $response->assertStatus(422); //HTTP_UNPROCESSABLE_ENTITY
        $response->assertJsonStructure([
            'message','errors'=> ['price']
        ]);
    }


    protected function productData($overrides =[]): array
    {
       return  array_merge([
            'name' => 'Mi primer Producto',
            'description' => 'Descripcion del primer producto',
            'price' => 100.00
        ],$overrides);
    }





}

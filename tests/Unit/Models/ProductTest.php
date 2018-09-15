<?php

namespace Tests\Unit\Models;

use App\Models\Product;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function a_product_belongs_to_user()
    {
        $product = factory(Product::class)->create();
        $this->assertInstanceOf(User::class,$product->user);
    }
    
}

<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductResourceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_product_resource_must_have_the_necessary_fields()
    {
        $product = factory(Product::class)->create();
        $productResource = ProductResource::make($product)->resolve();
        $this->assertEquals(
            $product->id,
            $productResource['id']
        );
        $this->assertEquals(
            $product->name,
            $productResource['name']
        );
        $this->assertEquals(
            $product->price,
            $productResource['price']
        );
        $this->assertInstanceOf(
            UserResource::class,
            $productResource['user']
        );

        $this->assertTrue(true);
    }
}

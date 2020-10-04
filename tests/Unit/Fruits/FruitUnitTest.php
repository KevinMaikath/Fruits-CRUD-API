<?php

namespace Tests\Unit\Fruits;

use App\Fruit;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FruitUnitTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function createFruitTest()
    {
        $fruit = factory(Fruit::class)->make();
        $data = [
            'name' => $fruit->name,
            'size' => $fruit->size,
            'colour' => $fruit->colour
        ];

        $response = $this
            ->withoutMiddleware()
            ->post('/api/fruits', $data);

        $sizeLetter = Fruit::getSizeLetter($fruit->size);

        $response->assertStatus(201);
        $this->assertDatabaseHas('fruits', [
            'name' => $fruit->name,
            'size' => $sizeLetter,
            'colour' => $fruit->colour
        ]);
    }

    /** @test */
    public function updateFruitCompleteTest()
    {
        $fruit = factory(Fruit::class)->create();
        $fruitSizeLetter = Fruit::getSizeLetter($fruit->size);

        $data = [
            'name' => $this->faker->name,
            'size' => array_values(Fruit::SIZES)[$this->faker->numberBetween(0, 2)],
            'colour' => $this->faker->colorName
        ];
        $dataSizeLetter = Fruit::getSizeLetter($data['size']);

        $response = $this
            ->withoutMiddleware()
            ->put('/api/fruits/' . $fruit->id, $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('fruits', [
            'name' => $data['name'],
            'size' => $dataSizeLetter,
            'colour' => $data['colour']
        ]);
        $this->assertDatabaseMissing('fruits', [
            'name' => $fruit->name,
            'size' => $fruitSizeLetter,
            'colour' => $fruit->colour
        ]);
    }

    /** @test */
    public function updateFruitOnlyNameTest()
    {
        $fruit = factory(Fruit::class)->create();
        $fruitSizeLetter = Fruit::getSizeLetter($fruit->size);

        $data = [
            'name' => $this->faker->name
        ];

        $response = $this
            ->withoutMiddleware()
            ->put('/api/fruits/' . $fruit->id, $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('fruits', [
            'name' => $data['name'],
            'size' => $fruitSizeLetter,
            'colour' => $fruit->colour
        ]);
        $this->assertDatabaseMissing('fruits', [
            'name' => $fruit->name
        ]);
    }

    /** @test */
    public function updateFruitWrongSizeTest()
    {
        $fruit = factory(Fruit::class)->create();
        $fruitSizeLetter = Fruit::getSizeLetter($fruit->size);

        $data = [
            'size' => $this->faker->name
        ];

        $response = $this
            ->withoutMiddleware()
            ->put('/api/fruits/' . $fruit->id, $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('fruits', [
            'name' => $fruit->name,
            'size' => $fruitSizeLetter,
            'colour' => $fruit->colour
        ]);
        $this->assertDatabaseMissing('fruits', [
            'size' => $data['size']
        ]);
    }

    /** @test */
    public function deleteFruitTest()
    {
        $fruit = factory(Fruit::class)->create();

        $response = $this
            ->withoutMiddleware()
            ->delete('/api/fruits/' . $fruit->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('fruits', [
            'name' => $fruit->name,
        ]);
    }

    /** @test */
    public function getFruitTest()
    {
        $fruit = factory(Fruit::class)->create();

        $response = $this
            ->withoutMiddleware()
            ->get('/api/fruits/' . $fruit->id);

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $fruit->id,
            'name' => $fruit->name,
            'size' => $fruit->size,
            'colour' => $fruit->colour
        ]);
    }

    /** @test */
    public function showFruitsTest()
    {
        $fruits = factory(Fruit::class, 3)->create();

        $response = $this
            ->withoutMiddleware()
            ->get('/api/fruits');

        $response->assertStatus(200);
        $response->assertJson([
            [
                'id' => $fruits[0]->id,
                'name' => $fruits[0]->name,
                'size' => $fruits[0]->size,
                'colour' => $fruits[0]->colour
            ]
            , [
                'id' => $fruits[1]->id,
                'name' => $fruits[1]->name,
                'size' => $fruits[1]->size,
                'colour' => $fruits[1]->colour
            ], [
                'id' => $fruits[2]->id,
                'name' => $fruits[2]->name,
                'size' => $fruits[2]->size,
                'colour' => $fruits[2]->colour
            ]
        ]);
    }

}

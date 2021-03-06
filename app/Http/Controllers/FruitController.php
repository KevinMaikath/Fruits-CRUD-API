<?php

namespace App\Http\Controllers;

use App\Fruit;
use Illuminate\Http\Request;

class FruitController extends Controller
{
    /**
     * Return a list with all the fruits.
     */
    public function index()
    {
        $fruits = Fruit::all();
        return response($fruits, 200);
    }


    /**
     * Store a new fruit in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'size' => 'required'
        ]);

        $fruit = new Fruit;
        $fruit->name = $request->get('name');
        $fruit->colour = $request->get('colour');

        $size = $request->get('size');
        $possible_sizes = array_values(Fruit::SIZES);
        if (in_array($size, $possible_sizes)) {
            $fruit->size = $size;
        } else {
            $response = ['message' => 'Invalid fruit size.'];
            return response($response, 400);
        }

        $fruit->save();
        return response($fruit, 201);
    }

    /**
     * Display a fruit given it's id;
     */
    public function show($id)
    {
        $fruit = Fruit::all()->where('id', '=', $id)->first();
        if ($fruit) {
            return response($fruit, 200);
        } else {
            $response = ['message' => 'Fruit with id: ' . $id . ' could not be found.'];
            return response($response, 400);
        }
    }

    /**
     * Update a fruit given it's id.
     */
    public function update(Request $request, $id)
    {
        $fruit = Fruit::all()->where('id', '=', $id)->first();
        if (!$fruit) {
            $response = ['message' => 'Fruit with id: ' . $id . ' could not be found.'];
            return response($response, 400);
        }

        $fruit->update($request->toArray());
        return response($fruit, 200);
    }

    /**
     * Remove a fruit given it's id.
     */
    public function destroy($id)
    {
        $fruit = Fruit::all()->where('id', '=', $id)->first();
        if ($fruit) {
            $fruit->delete();
            $response = ['message' => 'Fruit with id: ' . $id . ' has been succesfully deleted.'];
            return response($response, 200);
        } else {
            $response = ['message' => 'Fruit with id: ' . $id . ' could not be found.'];
            return response($response, 400);
        }
    }
}

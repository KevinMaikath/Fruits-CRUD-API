<?php

namespace App\Http\Controllers;

use App\Fruit;
use Illuminate\Http\Request;

class FruitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = ['message' => 'index function'];
        return response($response, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'size' => 'required'
        ]);

        $params = $request->all();

        $fruit = new Fruit;
        $fruit->name = $params['name'];
        $fruit->size = $params['size'];
        $fruit->colour = $params['colour'];
        $fruit->save();

        return $fruit;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $response = ['message' => 'show function'];
        return response($response, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $response = ['message' => 'update function'];
        return response($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $response = ['message' => 'destroy function'];
        return response($response, 200);
    }
}

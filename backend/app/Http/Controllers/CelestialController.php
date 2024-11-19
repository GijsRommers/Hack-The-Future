<?php

namespace App\Http\Controllers;

use App\Models\Celestial;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CelestialController extends Controller
{
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Celestial::all();
    }

    public function show($id)
    {
        return Celestial::findOrFail($id);
    }

    public function store(Request $request)
    {
        $celestial = Celestial::create($request->all());
        return response()->json($celestial, 201);
    }

    public function update(Request $request, $id)
    {
        $celestial = Celestial::findOrFail($id);
        $celestial->update($request->all());
        return response()->json($celestial, 200);
    }

    public function delete($id)
    {
        Celestial::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}

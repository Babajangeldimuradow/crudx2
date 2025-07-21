<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car; // Modeliň import edilmegi möhümdir

class CarController extends Controller
{
 

    // Maglumat goşmak üçin (POST /create)
    public function create(Request $request)
{
    $request->validate([
        'make' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'produced_on' => 'required|date',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
    ]);

    $car = new Car();
    $car->make = $request->make;
    $car->model = $request->model;
    $car->produced_on = $request->produced_on;

    if ($request->hasFile('image')) {
        $filename = $request->file('image')->store('cars', 'public');
        $car->image = $filename;
    }

    $car->save();

    return redirect()->route('cars.show')->with('success', 'Car created successfully!');
}

    public function edit($carId)
    {
        $car = Car::findOrFail($carId);
        return view('edit', ['car' => $car]);
    }
public function update(Request $request, $id)
{
    $request->validate([
        'make' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'produced_on' => 'required|date',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
    ]);

    $car = Car::findOrFail($id);
    $car->make = $request->make;
    $car->model = $request->model;
    $car->produced_on = $request->produced_on;

    if ($request->hasFile('image')) {
        // Köne suraty pozmak isleseň, şu setir goşup bolýar:
        // Storage::delete('public/' . $car->image);

        $filename = $request->file('image')->store('cars', 'public');
        $car->image = $filename;
    }

    $car->save();

    return redirect()->route('cars.show')->with('success', 'Car updated successfully!');
}



public function destroy($id)
{
    $car = Car::findOrFail($id);
    $car->delete();

    return redirect()->route('cars.show')->with('success', 'Car deleted successfully!');
}
public function show(Request $request)
{
    $query = Car::query();

    // 🔍 Gözleg bölümi
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where('make', 'like', "%$search%")
              ->orWhere('model', 'like', "%$search%");
    }

    // ✅ Tertipleme (sort) bölümi
    $sort = $request->get('sort', 'make_asc'); // Default sort

    switch ($sort) {
        case 'make_desc':
            $query->orderBy('make', 'desc');
            break;
        case 'model_asc':
            $query->orderBy('model', 'asc');
            break;
        case 'model_desc':
            $query->orderBy('model', 'desc');
            break;
        case 'produced_on_asc':
            $query->orderBy('produced_on', 'asc');
            break;
        case 'produced_on_desc':
            $query->orderBy('produced_on', 'desc');
            break;
        default:
            $query->orderBy('make', 'asc'); // make_asc
    }

    // 📄 Paginasiýa bilen çykarmak
    $cars = $query->paginate(5);

    // Sort parametrini hem ugrat
    return view('index', compact('cars', 'sort'));
}
    



}

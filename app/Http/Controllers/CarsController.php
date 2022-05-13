<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $cars = CarModel::all();

        return Inertia::render('index', [
            'cars' => $cars,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return Inertia::render('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg|max:5048',
            'name' => 'required|min:2',
            'founded' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        //Continue when validation passed

        $image = $request->file('image')->store('images', 'public');

        $car = CarModel::create([
            'image_path' => $image,
            'name' => $request->input('name'),
            'founded' => $request->input('founded'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
        ]);

        return Redirect::route('cars.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $car = CarModel::find($id);

        return Inertia::render('show', [
            'id' => $car->id,
            'image' => asset('storage/' . $car->image_path),
            'name' => $car->name,
            'description' => $car->description,
            'founded' => $car->founded,
            'price' => $car->price,
        ]);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = CarModel::find($id);

        return Inertia::render('edit', [
            'id' => $car->id,
            'image' => asset('storage/' . $car->image_path),
            'name' => $car->name,
            'description' => $car->description,
            'founded' => $car->founded,
            'price' => $car->price,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:2',
            'founded' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        //Continue when validation passed

        $car = CarModel::where('id', $id);

        if ($request->hasFile('image')) {

            $car_id = CarModel::find($id);

            $destination = 'storage/' . $car_id->image_path;

            if (File::exists($destination)) {

                File::delete($destination);

            }

            $image = $request->file('image')->store('images', 'public');

            $car->update([
                'name' => $request->input('name'),
                'founded' => $request->input('founded'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'image_path' => $image,
            ]);

        } else {

            $car->update([
                'name' => $request->input('name'),
                'founded' => $request->input('founded'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
            ]);

        }

        return Redirect::route('cars.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarModel $car)
    {
        $car->delete();

        $destination = 'storage/' . $car->image_path;

        if (File::exists($destination)) {

            File::delete($destination);

        }

        return Redirect::route('cars.index');
    }
}

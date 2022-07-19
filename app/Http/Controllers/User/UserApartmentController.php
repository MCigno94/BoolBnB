<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\apartment;
use App\Models\service;
use Illuminate\Http\Request;

class UserApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::all()->where('user_id', Auth::id());
        //dd($apartments);

        return view('user.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        //dd($services);
        return view('user.apartments.create', compact('services'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_data =  $request->validate([
            'title' =>'required|string|min:3',
            'rooms_number' =>'required|numeric|min:1',
            'beds_number' =>'required|numeric|min:1',
            'bathrooms_number' =>'required|numeric|min:1',
            'square_meters' =>'required|numeric|min:9',
            'country' =>'required|string|min:3',
            'city' =>'required|string|min:3',
            'street' =>'required|string|min:3',
            'street_number' =>'required|numeric|min:9',
            'zip_code' =>'required|numeric|min:1',
            'img' =>'required|image|max:1000',
            'visibility' =>'required|numeric|min:0|max:1'
       ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();    

        $img_path = Storage::put('images', $data['img']);

        $data['img'] = $img_path;
        
        Apartment::create($data);
        return redirect()->route('user.apartments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(apartment $apartment)
    {
        return view('user.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(apartment $apartment)
    {
        $services = Service::all();
        return view('user.apartments.edit', compact('apartment', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, apartment $apartment)
    {

        $validated_data =  $request->validate([
            'title' =>'required|string|min:3',
            'rooms_number' =>'required|numeric|min:1',
            'beds_number' =>'required|numeric|min:1',
            'bathrooms_number' =>'required|numeric|min:1',
            'square_meters' =>'required|numeric|min:9',
            'country' =>'required|string|min:3',
            'city' =>'required|string|min:3',
            'street' =>'required|string|min:3',
            'street_number' =>'required|numeric|min:9',
            'zip_code' =>'required|numeric|min:1',
            'img' =>'required|image|max:1000',
            'visibility' =>'required|numeric|min:0|max:1'
      ]);

        Storage::delete($apartment->img);
        $data = $request->all();

        $img_path = Storage::put('images', $data['img']);

        $data['img'] = $img_path;

       

        $apartment->update($data);

        return redirect()->route('user.apartments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(apartment $apartment)
    {
        $apartment->delete();
        return redirect()->route('user.apartments.index');
    }
}

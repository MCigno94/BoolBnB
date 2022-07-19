<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\apartment;
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
        return view('user.apartments.create');
        
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
             'title' =>'required|min:3',
            //'rooms_number' =>'required',
            //'beds_number' =>'required',
            //'bathrooms_number' =>'required|min:3',
            //'square_meters' =>'required',
            // 'country' =>'required',
            // 'city' =>'required|min:3',
            // 'street' =>'required',
            // 'street_number' =>'required',
            // 'zip_code' =>'required|min:3',
            // 'img' =>'required',
            // 'visibility' =>'required',

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
        return view('user.apartments.edit', compact('apartment'));
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
            'title' =>'required|min:3',
           //'rooms_number' =>'required',
           //'beds_number' =>'required',
           //'bathrooms_number' =>'required|min:3',
           //'square_meters' =>'required',
           // 'country' =>'required',
           // 'city' =>'required|min:3',
           // 'street' =>'required',
           // 'street_number' =>'required',
           // 'zip_code' =>'required|min:3',
           // 'img' =>'required',
           // 'visibility' =>'required',

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

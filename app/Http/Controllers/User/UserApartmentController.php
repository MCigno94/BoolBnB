<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\apartment;
use App\Models\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::orderByDesc('id')->where('user_id', Auth::id())->get();
        //dd($apartments);

        return view('user.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(apartment $apartment, Request $request)
    {
        $services = Service::all();
        //dd($services);
        $servicesId = DB::table('apartment_service')->select('service_id')->where('apartment_id', $apartment->id)->get();

        $ids= [];

        foreach ($servicesId as $id) {
            $ids[]= $id->service_id;
        }

        $apartment->service()->detach($ids);
        $apartment->service()->attach($request->services);
        
        return view('user.apartments.create', compact('services', 'ids', 'apartment', ));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request);
        $validated_data =  $request->validate([
            'title' =>'required|string',
            'rooms_number' =>'required|numeric|min:1',
            'beds_number' =>'required|numeric|min:1',
            'bathrooms_number' =>'required|numeric|min:1',
            'square_meters' =>'required|numeric|min:1',
            'address' =>'required|string|min:1',
            'img' =>'required|image|max:1000',
        ]);

        $data = $request->all();
        
        if(!$request->has('visibility')) {
            $data['visibility'] = 'false';
        }

        $img_path = Storage::put('images', $data['img']);
    
        $data['img'] = $img_path;

        $data['user_id'] = Auth::id();

        $new_apartment = Apartment::create($data);
        $new_apartment->service()->attach($request->services);

        $servicesId = DB::table('apartment_service')->select('service_id')->where('apartment_id', $new_apartment->id)->get();

        $ids= [];

        foreach ($servicesId as $id) {
            $ids[]= $id->service_id;
        }

        $new_apartment->service()->detach($ids);
        $new_apartment->service()->attach($request->services);


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
        $services = Service::all();

        $servicesId = DB::table('apartment_service')->select('service_id')->where('apartment_id', $apartment->id)->get();

        //dd($servicesId);
        $ids= [];

        foreach ($servicesId as $id) {
            $ids[] = $id->service_id;
        }

        //dd($ids);

        return view('user.apartments.show', compact('apartment', 'services', 'ids'));
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

        $servicesId = DB::table('apartment_service')->select('service_id')->where('apartment_id', $apartment->id)->get();

        $ids= [];

        foreach ($servicesId as $id) {
            $ids[]= $id->service_id;
        }        

        return view('user.apartments.edit', compact('apartment', 'services', 'ids'));
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
            'title' =>'required|string',
            'rooms_number' =>'required|numeric|min:1',
            'beds_number' =>'required|numeric|min:1',
            'bathrooms_number' =>'required|numeric|min:1',
            'square_meters' =>'required|numeric|min:1',
            'address' =>'required|string|min:3',
            'img' =>'image|max:1000',
        ]);
        
        $data = $request->all();
        
        if(!$request->has('visibility')) {
            $data['visibility'] = 'false';
        }
        
        if($request->hasFile('img')) { 

            Storage::delete($apartment->img);

            $img_path = Storage::put('images', $data['img']);
    
            $data['img'] = $img_path;
        }

        //dd($data);
        
        $apartment->update($data);


        $servicesId = DB::table('apartment_service')->select('service_id')->where('apartment_id', $apartment->id)->get();

        $ids= [];

        foreach ($servicesId as $id) {
            $ids[]= $id->service_id;
        }

        $apartment->service()->detach($ids);
        $apartment->service()->attach($request->services);



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
        Storage::delete($apartment->img);
        $apartment->delete();
        return redirect()->route('user.apartments.index')->with('message', "$apartment->title deleted successfully");
    }
}

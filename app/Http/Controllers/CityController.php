<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $city = City::get();
        $country = Country::get();
        $arr = $country;
        return view('city', compact('city', 'country', 'arr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required',
            'country' => 'required'
        ]);
        //dd($request->all());
        $id = $request->all('country');
        $country = Country::where('country_id', $id)->first();

        $country_name = $country->name;


        $citys = City::get();
        $count = count($citys);

        $city = new City;
        $city->name = $request->input('name');
        $city->country_id = $request->input('country');
        $city->country_name = $country_name;
        $city->city_id = $count+1;
        $city->save();

        return redirect('/city')->with('success', 'Город добавлен успешно!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'city' => 'required'
        ]);


        $city = City::find($id);
        $city->name = $request->input('city');
        $city->save();

        return redirect('/city')->with('success', 'Город изменен успешно!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_city($id)
    {
        City::find($id)->delete();
        return redirect('/city')->with('success', 'Город удален!');
    }
}

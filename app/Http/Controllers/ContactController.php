<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Contact;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Sodium\compare;

class ContactController extends Controller
{
    //protected $fillable = ['name', 'phone', 'email', 'date', 'facebook', 'other_social', 'country', 'city', 'photo'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('modal');
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
        //dd($request->all());


        $country_id = $request->all('prefix');
        $city = $request->all('city');

        $country = Country::where('country_id', $country_id)->first();
        $country_name = $country->name;

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'data' => 'required',
            'facebook' => 'required',
            'prefix' => 'required',
            'city' => 'required',
            'photo' => 'required'
        ]);

        $all = $request->all();
        $count = count($all);

            if($count != 9){

                $ph = $count - 9;
                $social_arr = [];
                for($x = 1; $x <= $ph; $x++){
                    $more = 'other_social'.$x;
                    $socials = $request->$more;
                    array_push($social_arr, $socials);
                }
                $socials = implode(' | ', $social_arr);
            }

        $contact = new Contact;
        $contact->name = $request->input('name');
        $contact->phone = $request->input('phone');
        $contact->email = $request->input('email');
        $contact->data = $request->input('data');
        $contact->facebook = $request->input('facebook');
        if(isset($socials)){
        $contact->other_social = $socials;
        }
        $contact->country = $country_name;
        $contact->city = $request->input('city');

        //загрузка картинки по имени
        if(isset($all['photo'])){
            $image = $request->file('photo');
            $originalname = $image->getClientOriginalName();
            $path = $image->storeAs('public', $originalname);
            $contact->photo = $originalname;
        }else{
            $contact->photo = 'foto.png';
        }
        $contact->save();


        return redirect('/')->with('success', 'Контакт добавлен успешно!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id)->first();
        //dd($contact);
        //return view('modal', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destr($id)
    {
        $ids = Contact::find($id)->delete();
        return redirect('/')->with('success', 'Контакт Удален!');
    }
}

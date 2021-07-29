<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Contact;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{


    public function index(){
        $contact = Contact::get();
        $city = City::get();
        $country = Country::get();
        //dd($contact);
        return view('index', compact('contact','city', 'country'));
    }





}

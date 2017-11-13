<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Cinema;
use App\Model\City;
use App\Model\Film;
use App\Model\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::count();
        $films = Film::count();
        $cinemas = Cinema::count();
        $cities = City::count();
        return view('backend.home.index', compact(
            'users',
            'films',
            'cinemas',
            'cities'
        ));
    }

}

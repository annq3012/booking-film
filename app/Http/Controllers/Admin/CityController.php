<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Cinema;
use App\Model\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param City $city object off city
     *
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        $cinemas = Cinema::where('city_id', '=', $city->id)->get();
        return response()->json(['cinemas' => $cinemas], 200);
    }
}

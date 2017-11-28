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
     * @param \Illuminate\Http\Request $request request
     * @param City                     $city    object of city
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, City $city)
    {
        $cinemas = Cinema::where('city_id', '=', $city->id)->get();
        if ($request->ajax()) {
            return response()->json(['cinemas' => $cinemas], 200);
        }
    }
}

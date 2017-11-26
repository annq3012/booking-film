<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Cinema;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AjaxController extends Controller
{
    /**
     * Load cinemas from city.
     *
     * @param int $id id of city
     *
     * @return \Illuminate\Http\Response
     */
    public function loadCinemas($id)
    {
        $cinemas = Cinema::where('city_id', '=', $id)->get();
        return response()->json(['cinemas' => $cinemas], 200);
    }
}

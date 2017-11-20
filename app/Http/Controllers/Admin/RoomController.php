<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Cinema;
use App\Model\City;
use App\Model\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = [
            'id',
            'name',
            'cinema_id',
            'type',
            'max_seats',
        ];
        $rooms = Room::select($columns)
                    ->paginate(Room::ROW_LIMIT);
        return view('backend.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $columns = [
            'id',
            'name',
            'cinema_id',
            'type',
            'max_seats',
        ];
        $cities = City::select('id', 'city')->get();
        $rooms = Room::select($columns)->
                    get();
        /*$cinemas = Cinema::select('id', 'name', 'city_id')
                        ->with('city')
                        ->get();*/
        return view('backend.rooms.create', compact('rooms', 'cinemas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }
}

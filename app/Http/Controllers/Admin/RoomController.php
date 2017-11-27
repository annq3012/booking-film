<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
         $rooms = Room::search()
                        ->select($columns)
                        ->paginate(Room::ROW_LIMIT);
         return view('backend.rooms.index', compact('rooms'));
    }
}

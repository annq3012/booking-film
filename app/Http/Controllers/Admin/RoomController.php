<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoomRequest;
use App\Model\Cinema;
use App\Model\City;
use App\Model\Room;
use App\Model\Seat;
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
        $rooms = Room::select($columns)->with('seats')->
                    get();
        return view('backend.rooms.create', compact('rooms', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoomRequest $request)
    {
        //create room
        $rooms = new Room($request->except(['seats[]', 'city']));
        $result_room = $rooms->save();
        $array_seats = array();
        $array_list_seats = array();
        if (isset($request->seats)) {
            foreach ($request->seats as $key => $seat){
                $array_seats['y_axist'] = $key;
                foreach ($seat as $key => $value) {
                    $array_seats[$key] = $value;
                }
                $array_seats['room_id'] = $rooms['id'];
                array_push($array_list_seats, $array_seats);
                $array_seats = array();
            }
        }
        foreach ($array_list_seats as $seats => $value) {
                var_dump($value['x_axist']);

            for($i = 1; $i <= $value['x_axist']; $i++) {
                $seat = new Seat();
                $seat->y_axist = $value['y_axist'];
                $seat->x_axist = $i;
                $seat->type = $value['type'];
                $seat->room_id = $value['room_id'];
                $result_seat = $seat->save();
            }
        }
        if ($result_room && $result_seat){
            flash(__('Create success'))->success();
           return redirect()->route('rooms.index');
        } else {
            flash(__('Create failure'))->error();
            return redirect()->back()->withInput();
        }
    }
}

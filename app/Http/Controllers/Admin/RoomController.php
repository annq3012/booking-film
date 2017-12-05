<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Model\Cinema;
use App\Model\City;
use App\Model\Room;
use App\Model\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        try {
         //create room
            $rooms = new Room($request->except(['seats[]', 'city']));
            $resultRoom = $rooms->save();

        //create seats of room
            $arraySeats = [];
            $arrayListSeats = [];
            if ($request->has('seats')) {
                foreach ($request->seats as $yAxist => $seat) {
                    $arraySeats['y_axist'] = $yAxist;
                    foreach ($seat as $attribute => $value) {
                        $arraySeats[$attribute] = $value;
                    }
                    $arraySeats['room_id'] = $rooms['id'];
                    array_push($arrayListSeats, $arraySeats);
                    $arraySeats = [];
                }
            }
            foreach ($arrayListSeats as $seats) {
                for ($i = 1; $i <= $seats['x_axist']; $i++) {
                    $seat = new Seat();
                    $seat->y_axist = $seats['y_axist'];
                    $seat->x_axist = $i;
                    $seat->type = $seats['type'];
                    $seat->room_id = $seats['room_id'];
                    $resultSeat = $seat->save();
                }
            }
            if ($resultRoom && $resultSeat) {
                DB::commit();
                flash(__('Create success'))->success();
                return redirect()->route('rooms.index');
            }
        } catch (Exception $e) {
            DB::rollback();
            flash(__('Create failure'))->error();
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $room object of rooms
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        if ($room->delete()) {
            flash(__('Deletion successful!'))->success();
        } else {
            flash(__('Deletion failed!'))->error();
        }
        return redirect()->back()->withInput();
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param int $room object of room
    *
    * @return \Illuminate\Http\Response
    */
    public function edit(Room $room)
    {
        $seats = Seat::select('id','y_axist', 'type', \DB::raw('count("y_axist") as count_seats'))
                     ->where('room_id', $room->id)
                     ->groupBy('y_axist')
                     ->get();
        $cinemas = Cinema::select('cinemas.id', 'cinemas.name', 'cinemas.city_id')
                         ->join('cities', 'cities.id', 'city_id')
                         ->join('rooms', 'cinema_id', 'cinemas.id')
                         ->where('rooms.id', $room->id)
                         -> get();
        return view('backend.rooms.update', compact('room', 'seats', 'cinemas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\UpdateRequest $request request to update
     * @param int                            $user    object of user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        DB::beginTransaction();
        try {
         //update room
            $arraySeats = [];
            $arrayListSeats = [];
            if ($request->has('seats')) {
                foreach ($request->seats as $yAxist => $seat) {
                    $arraySeats['y_axist'] = $yAxist;
                    foreach ($seat as $attribute => $value) {
                        $arraySeats[$attribute] = $value;
                    }
                    $arraySeats['room_id'] = $room['id'];
                    array_push($arrayListSeats, $arraySeats);
                    $arraySeats = [];
                }
            }
            // dd($arrayListSeats);
            Seat::where('room_id', $room->id)->forceDelete();
            foreach ($arrayListSeats as $seats) {
                for ($i = 1; $i <= $seats['x_axist']; $i++) {
                    $seat = new Seat();
                    $seat->y_axist = $seats['y_axist'];
                    $seat->x_axist = $i;
                    $seat->type = $seats['type'];
                    $seat->room_id = $seats['room_id'];
                    $resultSeat = $seat->save();
                }
            }
            $resultRoom = $room->update($request->except(['seats[]']));
            if ($resultRoom && $resultSeat) {
                DB::commit();
                flash(__('Create success'))->success();
                return redirect()->route('rooms.index');
            }
        } catch (Exception $e) {
            DB::rollback();
            flash(__('Create failure'))->error();
            return redirect()->back()->withInput();
        }
    }
}

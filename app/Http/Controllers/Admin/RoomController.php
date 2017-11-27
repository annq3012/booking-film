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
         $rooms = Room::select($columns)
                    ->paginate(Room::ROW_LIMIT);
         return view('backend.rooms.index', compact('rooms'));
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
}

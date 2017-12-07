<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $films = Film::select()
                      ->paginate(Film::ROW_LIMIT);
         return view('backend.films.index', compact('films'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $film object of film
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        if ($film->image != null) {
            unlink(assert('images/films'.$film->image));
        }
        if ($film->delete()) {
            flash(__('Deletion successful!'))->success();
        } else {
            flash(__('Deletion failed!'))->error();
        }
        return redirect()->route('films.index');
    }
}

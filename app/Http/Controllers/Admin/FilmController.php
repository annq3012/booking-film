<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFilmRequest;
use App\Model\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $film = new Film();
        $filmPara = $film->getParameter();
        return view('backend.films.create',compact('filmPara'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFilmRequest $request)
    {
        $films = new Film($request->all());
        if ($request->hasFile('image')) {
            $films->image = config('image.name_prefix') .'-'. $request->image->hashName();
            $request->file('image')->move(config('image.films.path_upload'), $films->image);
        }
        if ($films->save()) {
            flash(__('Creation successful!'))->success();
        } else {
            flash(__('Creation failed!'))->error();
        }
        return redirect()->route('films.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFilmRequest;
use App\Http\Requests\UpdateFilmRequest;
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
        $technologies = Film::$technologies;
        $rated = Film::$rated;
        $actived = Film::STATUS_ACTIVED;
        $disabled = Film::STATUS_DISABLED;
         return view(
             'backend.films.index',
             compact(
                 'technologies',
                 'rated',
                 'actived',
                 'disabled',
                 'films'
             )
         );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param int $film object of film
    *
    * @return \Illuminate\Http\Response
    */
    public function edit(Film $film)
    {
        $technologies = $film::$technologies;
        $rated = $film::$rated;
        $actived = $film::STATUS_ACTIVED;
        $disabled = $film::STATUS_DISABLED;
        return view(
            'backend.films.update',
            compact(
                'technologies',
                'rated',
                'actived',
                'disabled',
                'film'
            )
        );
    }

     /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\UpdateRequest $request request to update
     * @param int                            $film    object of film
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFilmRequest $request, film $film)
    {
        $input = $request->all();
        $oldImg = $film->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = config('image.name_prefix') . "-" . $file->hashName();
            $file->move(config('image.films.path_upload'), $fileName);
            $film['image'] = $fileName;
        }
        if ($film->save()) {
            if ($input['image'] != null && $oldImg != $input['image']
                && file_exists(base_path('public/images/film/'.$oldImg))) {
                unlink(base_path('public/images/film/'.$oldImg));
            }
            flash(__('Update successful!'))->success();
        } else {
            flash(__('Update failed!'))->error();
        }
        return redirect()->route('films.index');
    }

    /**
     * Update role of film.
     *
     * @param int $film object of film
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Film $film)
    {
        if ($film->status == Film::STATUS_ACTIVED) {
            $film->update(['status' => Film::STATUS_DISABLED]);
        } else {
            $film->update(['status' => Film::STATUS_ACTIVED]);
        }
        return redirect()->route('films.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technologies = Film::$technologies;
        $rated = Film::$rated;
        $actived = Film::STATUS_ACTIVED;
        $disabled = Film::STATUS_DISABLED;
        return view(
            'backend.films.create',
            compact(
                'technologies',
                'rated',
                'actived',
                'disabled'
            )
        );
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

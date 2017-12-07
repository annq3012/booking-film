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
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\UpdateRequest $request request to update
     * @param int                            $film    object of film
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFilmRequest $request, film $film)
    {
        /*$input = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = config('image.name_prefix') . "-" . $file->hashName();
            $file->move(config('image.films.path_upload'), $fileName);
            $input['image'] = $fileName;
        }
        if ($film->update($input)) {
            flash(__('Update successful!'))->success();
            return redirect()->route('users.index');
        } else {
            flash(__('Update failed!'))->error();
            return redirect()->back()->withInput();
        }*/
    }
}

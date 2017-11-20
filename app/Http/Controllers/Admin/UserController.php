<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Model\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
            'email',
            'fullname',
            'birthday',
            'address',
            'image',
            'is_admin',
        ];
        $users = User::select($columns)->paginate(User::ROW_LIMIT);
        return view('backend.users.index', compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $user object of user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Auth::user()->id == $user->id) {
            flash(__('User is logging! Can\'t delete this user!'))->warning();
            return redirect()->back()->withInput();
        } else {
            if ($user->delete()) {
                flash(__('Deletion successful!'))->success();
            } else {
                flash(__('Deletion failed!'))->error();
            }
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $users = new User($request->all());
        if ($request->hasFile('image')) {
            $users->image = config('image.name_prefix') .'-'. $request->image->hashName();
            $request->file('image')->move(config('image.users.path'), $users->image);
        }
        if ($users->save()) {
            flash(__('Creation successful!'))->success();
        } else {
            flash(__('Creation failed!'))->error();
        }
        return redirect()->route('users.index');
    }
}

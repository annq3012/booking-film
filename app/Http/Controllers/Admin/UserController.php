<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\UpdateUserRequest;
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
        $users = User::search()
                     ->select($columns)->paginate(User::ROW_LIMIT);
        $users->appends(['search' => request('search')]);
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
        return redirect()->route('users.index');
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param int $user object of user
    *
    * @return \Illuminate\Http\Response
    */
    public function edit(User $user)
    {
        return view('backend.users.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\UpdateRequest $request request to update
     * @param int                            $user    object of user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $input = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = config('image.name_prefix') . "-" . $file->hashName();
            $file->move(config('image.users.path_upload'), $fileName);
            $input['image'] = $fileName;
        }
        if ($user->update($input)) {
            flash(__('Update successful!'))->success();
            return redirect()->route('users.index');
        } else {
            flash(__('Update failed!'))->error();
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update role of user.
     *
     * @param int $user object of user
     *
     * @return \Illuminate\Http\Response
     */
    public function updateRole(User $user)
    {
         if (Auth::user()->id == $user->id) {
            flash(__('User is logging! Can\'t change permission!'))->warning();
            return redirect()->back()->withInput();
        } else {
            if ($user->is_admin == User::ROLE_ADMIN) {
                $user->update(['is_admin' => User::ROLE_USER]);
            } else {
                $user->update(['is_admin' => User::ROLE_ADMIN]);
            }
        }
        return redirect()->route('users.index');
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
            $request->file('image')->move(config('image.users.path_upload'), $users->image);
        }
        if ($users->save()) {
            flash(__('Creation successful!'))->success();
        } else {
            flash(__('Creation failed!'))->error();
        }
        return redirect()->route('users.index');
    }
}

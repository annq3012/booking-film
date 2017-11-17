<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Model\User;

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
     * Show the form for editing the specified resource.
     *
     * @param int $id id of user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\UpdateRequest $request request to update
     * @param int                            $id      id of user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = config('image.name_prefix') . "-" . $file->hashName();
            $file->move(config('image.users.path_uplo'), $fileName);
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
     * @param int $id id of user
     *
     * @return \Illuminate\Http\Response
     */
    public function updateRole($id)
    {
        $user = User::findOrFail($id);
        if ($user->is_admin == User::ROLE_ADMIN) {
            $user->update(['is_admin' => User::ROLE_USER]);
        } else {
            $user->update(['is_admin' => User::ROLE_ADMIN]);
        }
        /*flash(__('Change role successful!'))->success();*/
        return redirect()->route('users.index');
    }
}

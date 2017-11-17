<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;
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
     * @param int $id id of user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->id == $id) {
            flash(__('User is logging! Can\'t delete this user!'))->warning();
        } else {
            $user = User::findOrFail($id);
            if ($user->delete()) {
                flash(__('Deletion successful!'))->success();
            } else {
                flash(__('Deletion failed!'))->error();
            }
        }
        
        return redirect()->route('users.index');
    }
}

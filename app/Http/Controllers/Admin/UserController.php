<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;

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
            'images',
            'is_admin',
        ];
        $users = User::select($columns)->orderby('id')->paginate(User::ROW_LIMIT);
        return view('backend.users.index', compact('users'));
    }
}

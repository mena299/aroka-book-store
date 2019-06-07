<?php

namespace App\Http\Controllers\cms;

use App\Http\Requests\Register;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function register()
    {
        return view('cms.user.register');
    }

    public function createNewUser(Register $register)
    {

        return   $register->input();
    }
}

<?php

namespace App\Http\Controllers\cms;

use App\Http\Requests\Login;
use App\Http\Requests\Register;
use App\Model\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function login()
    {
        return view('cms.user.login');
    }

    public function auth(Login $request)
    {
        $username = $request->input('username');

        $user = User::whereUsername($username)->first();

        if (!$user) {
            return response()->json(['status' => 'fail', 'messages' => 'Username not found'], 422);
        } elseif ($user && Hash::check($request->input('password'), $user->password)) {
            $user->last_login = Carbon::now();
            $user->save();

            return response()->json(['status' => 'success', 'messages' => 'Login success'], 200);
        }


        return response()->json(['status' => 'fail', 'messages' => 'Login fail'], 422);
    }


    public function register()
    {
        return view('cms.user.register');
    }

    public function createNewUser(Register $request)
    {

        $username = $request->input('username');
        $user = User::whereUsername($username)->first();

        if ($user) {
            return response()->json(['status' => 'fail', 'messages' => 'Username is duplicate'], 422);
        }

        try {
            $user = new User();
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->status = 'Y';
            $user->created_at = Carbon::now();
            $user->updated_at = Carbon::now();
            $user->save();

        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['status' => 'fail', 'message' => 'Can not create new user'], 422);
        }

        return response()->json(['status' => 'success', 'message' => 'Create new User Success'], 200);
    }
}

<?php

namespace App\Http\Controllers\cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect('cms/login');
        }

        return view('cms.dashboard');
    }
}

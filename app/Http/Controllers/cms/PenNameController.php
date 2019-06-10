<?php

namespace App\Http\Controllers\cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenNameController extends Controller
{
    public function index()
    {


        return view('cms.authors.penname');
    }
}

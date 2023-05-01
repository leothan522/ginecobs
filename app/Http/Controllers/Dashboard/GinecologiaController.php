<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GinecologiaController extends Controller
{
    public function index()
    {
        return view('dashboard.ginecologia.index');
    }
}

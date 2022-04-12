<?php

namespace App\Http\Controllers\Admin;

use App\Models\Verweise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerweiseController extends Controller
{
    public function index()
    {
        $verweises = Verweise::paginate();

        return view('verweises.index', compact('verweises'));
    }
}

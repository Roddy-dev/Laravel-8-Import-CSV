<?php

namespace App\Http\Controllers;

use App\Models\Verweise;
use Illuminate\Http\Request;

class VerweiseController extends Controller
{
    public function index()
    {
        $verweises = Verweise::paginate();

        return view('verweises.index', compact('verweises'));
    }
}

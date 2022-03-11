<?php

namespace App\Http\Controllers;

use App\Models\Lebenslauf;
use Illuminate\Http\Request;

class LebenslaufController extends Controller
{
    public function index()
    {
        $lebenslaufs = Lebenslauf::paginate();

        return view('lebenslaufs.index', compact('lebenslaufs'));
    }
}

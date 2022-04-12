<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lebenslauf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LebenslaufController extends Controller
{
    public function index()
    {
        $lebenslaufs = Lebenslauf::paginate();

        return view('lebenslaufs.index', compact('lebenslaufs'));
    }
}

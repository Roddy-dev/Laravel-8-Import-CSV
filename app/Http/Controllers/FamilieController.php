<?php

namespace App\Http\Controllers;

use App\Models\Familie;
use Illuminate\Http\Request;

class FamilieController extends Controller
{
    public function index()
    {
        $families = Familie::paginate();

        return view('families.index', compact('families'));
    }
}

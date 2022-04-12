<?php

namespace App\Http\Controllers\Admin;

use App\Models\Familie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FamilieController extends Controller
{
    public function index()
    {
        $families = Familie::paginate();

        return view('families.index', compact('families'));
    }
}

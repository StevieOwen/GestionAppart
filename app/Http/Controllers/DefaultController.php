<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appartment;
use Illuminate\Support\Facades\DB;


class DefaultController extends Controller
{
    public function index()
    {
        $appartments=Appartment::with(['building', 'images'])->get();

        $user=auth()->user();

        return view('welcome')
        ->with('appartments',$appartments)
        ->with('user',$user);
    }

}

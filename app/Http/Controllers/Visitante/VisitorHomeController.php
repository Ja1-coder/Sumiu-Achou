<?php

namespace App\Http\Controllers\Visitante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VisitorHomeController extends Controller
{
    public function index()
    {
        return view('visitante.home');
    }
}

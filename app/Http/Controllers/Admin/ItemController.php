<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return view('admin.item.cadastrar-item');
    }

    public function showListItem()
    {
        return view('admin.item.listar-item');
    }
}

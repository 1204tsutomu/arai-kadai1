<?php

namespace App\Http\Controllers;

use App\Models\Author;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::simplePaginate(7);
        return view('index', ['authors' => $authors]);
    }
    //
}

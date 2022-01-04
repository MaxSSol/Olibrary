<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Books;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $users = User::whereNotIn('id', [$request->user()->id])->get();
        $books = Books::all();
        $authors = Author::all();
        return view('admin.dashboard', compact('users', 'books', 'authors'));
    }
}

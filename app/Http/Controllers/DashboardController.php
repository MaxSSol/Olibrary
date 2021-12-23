<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Books;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $users = User::whereNotIn('id', [$request->user()->id])->get();
        $books = Books::with(['authors'])->get();
        $authors = Authors::all();
        $roles = Role::all();
        return view('admin.dashboard', compact('users', 'books', 'authors', 'roles'));
    }
}

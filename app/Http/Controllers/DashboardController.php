<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('dashboard');
        $users = User::whereNotIn('id', [$request->user()->id])->get();
        $books = Book::all();
        $authors = Author::all();
        return view('admin.dashboard', compact('users', 'books', 'authors'));
    }
}

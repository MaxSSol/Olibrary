<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Books;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthorController extends Controller
{
    public function create()
    {
        Gate::authorize('create-author');
        return view('admin.author-create', ['books' => Books::all()]);
    }

    public function edit($id)
    {
        Gate::authorize('edit-author');
        $author = Author::with('books')->findOrFail($id);
        $books = Books::all();
        return view('admin.author-update', ['author' => $author, 'books' => $books]);
    }

    public function update(UpdateAuthorRequest $request, $id)
    {
        $this->authorize('update');
        $author = Author::findOrFail($id);
        $author->fill($request->only(['first_name', 'last_name', 'biography']));
        $author->books()->detach();
        $author->books()->attach($request->books);
        return redirect()->back();
    }

    public function store(CreateAuthorRequest $request)
    {
        $author = Author::create($request->only(['first_name', 'last_name', 'biography']));
        $this->authorize('create');
        if ($request->books) {
            $author->books()->attach($request->books);
        }
        return redirect(route('admin.dashboard'));
    }

    public function delete($id)
    {
        $author = Author::findOrFail($id)->delete();
        return redirect(route('admin.dashboard'));
    }
}

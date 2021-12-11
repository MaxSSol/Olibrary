<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function addToFavorite(Request $request)
    {
        if ($request->ajax()) {
            $user = $request->user();
            $user->favorites()->attach($request->only('book'));
        }
    }

    public function removeFromFavorite(Request $request)
    {
        if ($request->ajax()) {
            $user = $request->user();
            $user->favorites()->detach($request->only('book'), $request->user());
            dd($user);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function wishlist()
    {
        $user = Auth::user()->id;
        $favorites = Favorite::where('user_id', '=', $user)->get();
        $courses = Course::all();
        return view('wishlist', ['favorites' => $favorites, 'courses' => $courses]);
    }
    public function favoriteStore($id)
    {
        $favorites = Favorite::where('user_id', '=', Auth::user()->id)
            ->where('course_id', '=', $id)->get();
        if (!empty($favorites)) {
            $create = Favorite::create([
                'user_id' => Auth::user()->id,
                'course_id' => $id
            ]);
        }
        return back();
    }
    public function destroy($id)
    {
        Favorite::find($id)->delete();

        return redirect()->route('wishlist');
    }
}

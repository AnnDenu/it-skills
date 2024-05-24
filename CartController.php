<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Chapter;
use App\Models\Review;
use App\Models\Shedule;
use App\Models\Theme;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class CartController extends Controller
{
    public function cart(string $id)
    {
        $shedules = Shedule::all();
        $themes = Theme::orderBy('order')->get();
        $course = Course::find($id);
        $reviews = Review::all();

        $chapters = Chapter::where('course_id', '=', $id)->get();
        if(Auth::check()){
            $user = Auth::user();
            $favourite = $course->favourites()->where('user_id', $user->id)->exists();
            $userCourse = $course->userCourses()->where('user_id', $user->id)->exists();
                return view('course', [
                    'course' => $course,
                    'chapters' => $chapters,
                    'reviews' => $reviews,
                    'shedules' => $shedules,
                    'themes'=>$themes,
                    'favourite'=>$favourite,
                    'userCourse'=>$userCourse
                ]);
        }
        return view('course', [
            'course' => $course,
            'chapters' => $chapters,
            'reviews' => $reviews,
            'shedules' => $shedules,
            'themes'=>$themes
        ]);
    }
    public function destroy(string $id)
    {
        $delete = Review::find($id);
        try {
            $delete->delete();
            return back();
        } catch (\Exception $e) {
            return back()->withErrors('Error', $e->getMessage());
        }
        ;
    }
}

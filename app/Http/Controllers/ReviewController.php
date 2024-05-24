<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //Отображение всех отзывов
    public function reviewList()
    {
        $reviews = Review::all();
         return view('reviewList', [
            'reviews'=>$reviews
         ]);
    }
//    Выборка отзывов по курсу
    public function showReviewsByCourse(Request $request)
    {
        $selectedCourse = $request->input('course_id');

        $courses = Course::all();
        $reviews = Review::query();
        if ($selectedCourse) {
            $reviews->where('course_id', $selectedCourse);
        }
        $reviews = $reviews->get();

        return view('reviewList', [
            'reviews' => $reviews,
            'courses' => $courses,
            'selectedCourse' => $selectedCourse,
        ]);
    }

    //Вывод всех отзывов
    public function store()
    {
        $reviews = Review::all();

        return view('store', [
            'reviews' => $reviews,
        ]);
    }

    //функция отправки комментария(создание)
    public function reviewCourse(Request $request, $course_id)
    {
        $review = new Review();
        $review->text = $request->text;
        $review->course_id = $course_id;
        $review->user_id = Auth::id();
        $review->save();

        return back();
    }

    //Изменение данных
    public function update(Request $request, Review $review)
    {
        // Проверяем, что пользователь имеет право на редактирование отзыва
        if ($request->user()->id !== $review->user_id && $request->user()->role !== 'admin'&& $request->user()->role !== 'teacher') {
            abort(403, 'Unauthorized action.');
        }
        $update = Review::findOrFail($request->id);
        $update->text = $request->text;
        $update->save();
    
        // Возвращаем пользователя обратно на страницу, где он мог видеть отзыв
        return redirect()->back()->with('success', 'Отзыв успешно обновлен.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review, string $id)
    {
        $review = Review::find($id);
        $review->delete();
        return back();
    }
}

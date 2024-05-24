<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Course;
use App\Models\Review;
use App\Models\Shedule;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    //Для перехода на страницу welcome
    public function index()
    {
        $courses = Course::all();
        $categories = Category::all();
        $reviews = Review::inRandomOrder()->take(3)->get();//Здесь нужно ограничить количество выводимых отзывов

        return view('welcome', [
            'courses' => $courses,
            'categories' => $categories,
            'reviews' => $reviews
        ]);
    }
    //реализация поиска и показ всех курсов
    public function courseShow($categoryId = 0)
    {
        $reviews = Review::all();
        if (request('search')) {
            $courses = Course::where('name', 'like', '%' . request('search') . '%');
        } else {
            $courses = Course::with('category');
        }
        //распределние курсов по категориям с помощью id
        if ($categoryId) {
            $courses->where('category_id', $categoryId);
        }
        if (request('search')) {
            $categories = Category::where('name', 'like', '%' . request('search') . '%')->get();
        } else {
            $categories = Category::all();
        }
        
        return view('dashboardCourse', [
            'courses' => $courses->get(),
            'categories' => $categories,
            'reviews' => $reviews
        ]);
    }
    //Вывод курсов у преподавателя
    public function storeCourse($categoryId = 0)
    {
        $shedules = Shedule::all();
        $courses = Course::with('user')->get();
        $categories = Category::all();
        $users = User::where('role', 'teacher')->get();
        if ($categoryId) {
            $courses->where('category_id', $categoryId);
        }
//       dd($request);
        return view('storeCourse', [
            'courses' => $courses,
            'categories' => $categories,
            'users' => $users,
            'shedules'=>$shedules
        ]);
    }
    //Добавление курса в систему
    public function create(Request $request)
    {
        //Картинки курсов
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/images');
            $image->move($destinationPath, $name);
            $courses = 'images/' . $name;
        }
        $create = Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $courses,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ]);
        return back();
    }
    //Изменение курса
    public function update(Request $request, string $id)
    {
        $update = Course::findOrFail($request->id);
        $update->name = $request->name;
        $update->description = $request->description;
        $update->image = $request->image;
        $update->category_id = $request->category_id;
        $update->user_id = $request->user_id;
        $update->save();
        return back();
    }

    //Удаление курсов
    public function destroy(string $id)
    {
        $course = Course::find($id);
        try {
            $course->delete();
            return back()->with('success', 'Курс удален');
        }catch(\Exception $e){
            return back()->withErrors(['error' => 'Ошибка удаления курса']);
        };
    }


}

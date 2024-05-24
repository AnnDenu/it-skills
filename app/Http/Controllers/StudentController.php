<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Shedule;
use App\Models\Theme;
use App\Models\User;
use App\Models\UserCourse;
use App\Models\Work;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //Функция перехода в личный кабинет
    public function index()
    {
        $courses = auth()->user()->courses;

        $courses = Course::all();
        return view('courseCheckout', ['courses' => $courses]);
    }
    //Функция для того, чтобы курс в лк отображался
    public function courseLK(string $id)
    {
        $course = Course::findOrFail($id);
        $themes = Theme::orderBy('order')->get();
        $chapters = Chapter::where('course_id', '=', $id)->get();
        $shedules = Shedule::all();
        return view('courseLK', ['course' => $course, 'chapters' => $chapters, 'themes' => $themes, 'shedules' => $shedules]);
    }

    public function themeLK(string $themeId)
    {
        $theme = Theme::findOrFail($themeId);
        $shedules = Shedule::all();
        $work = Work::all();
        return view('themeLK', ['theme' => $theme, 'shedules' => $shedules, 'work' => $work,'themeId'=>$themeId]);
    }
    public function upload(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,jpg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip|max:2048',
        ]);

        $theme = Theme::findOrFail($id);
        // dd($theme);
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName, 'public');
        $file_path = '/storage' . $filePath;
        $user_id = auth()->user()->id;

        $work = new Work();
        $work->file = $file_path;
        $work->user_id = $user_id;
        $work->theme_id = $theme->id;
        $work->content = $request->input('content');
        $work->save();

        return back()->with('success', 'Задание успешно загружено.');
    }
    //Добавление курса в обучение в ЛК
    public function addCourseToCart($id)
    {
        $course = Course::findOrFail($id);

        // Проверяем, существует ли уже связь между пользователем и курсом
        if (auth()->user()->courses()->where('course_id', $course->id)->exists()) {
            return redirect()->back()->with('error', 'Вы уже добавили этот курс.');
        }

        auth()->user()->courses()->attach($course);

        return redirect()->back()->with('success', 'Успешно добавили');
    }

    //Функция удаления курса из добавленных
    public function destroy(Request $request, Course $course)
    {
        // Удаляем связь между пользователем и курсом
        $request->user()->courses()->detach($course);

        // Возвращаем пользователя на предыдущую страницу с сообщением об успешном удалении
        return redirect()->back()->with('success', 'Курс успешно удален из личного кабинета пользователя.');
    }
}

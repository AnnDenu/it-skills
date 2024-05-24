<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChapterRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Chapter;

class ChapterController extends Controller
{
    // Отображение разделов курса
    public function storeChapter(Request $request)
    {
        $search = $request->input('search');
        $selectedCourseId = $request->input('course_id');

        // Получаем текущего пользователя
        $currentUser = Auth::user();

        // Фильтруем курсы в зависимости от роли пользователя
        if ($currentUser->role === 'teacher') {
            // Преподавателю показываем только те курсы, которые он ведет
            $courses = Course::where('user_id', $currentUser->id)->get();
        } else {
            // Администратору показываем все курсы
            $courses = Course::all();
        }

        // Фильтрация разделов по курсу, если указан course_id
        $chapters = Chapter::query();
        if ($selectedCourseId) {
            $chapters = $chapters->where('course_id', $selectedCourseId);
        }

        if ($search) {
            $chapters = $chapters->where('name', 'like', '%' . $search . '%');
        }

        $chapters = $chapters->get();
        $users = User::all();

        return view('storeChapter', [
            'chapters' => $chapters,
            'users' => $users,
            'courses' => $courses
        ]);
    }

    // Добавление разделов
    public function create_chapter(Request $request)
    {
        $request->merge(['creator' => Auth::id()]); // Устанавливаем создателя как текущего пользователя
        $chapters = Chapter::create($request->all());
        return back()->with("success", "Вы успешно добавили раздел");
    }

    // Редактирование разделов
    public function update_chapter(ChapterRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $chapter = Chapter::find($id)->update($validatedData);
        return back();
    }

    // Удаление раздела
    public function chapter_destroy(string $id)
    {
        $delete = Chapter::find($id);
        try {
            $delete->delete();
            return back()->with('success', 'Раздел удалён');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Ошибка удаления']);
        }
    }
}
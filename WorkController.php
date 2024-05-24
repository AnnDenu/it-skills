<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\Work;
use Illuminate\Http\Request;
use URL;

class WorkController extends Controller
{
    public function show()
    {
        return view('works');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,jpg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip|max:2048',
        ]);

        // Получаем id темы из параметров маршрута
        $themeId = $request->route('id');

        // Ищем тему по id или возвращаем ошибку, если не найдена
        $theme = Theme::findOrFail($themeId);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName, 'public');
        $file_path = '/storage' . $filePath;
        $user_id = auth()->user()->id;

        $work = new Work();
        $work->file_path = $file_path;
        $work->user_id = $user_id;
        $work->theme_id = $theme->id;
        $work->content = $request->input('content');
        $work->save();

        return back();
    }
    public function getWork(Request $request)
    {
        $themeId = $request->input('theme_id');
        $works = Work::whereHas('theme', function ($query) use ($themeId) {
            $query->where('id', $themeId);
        })->get();

        $themes = Theme::all();

        return view('work', ['works' => $works, 'themes' => $themes]);
    }
    public function updateWork(Request $request, Work $work)
    {
    }
    public function destroyWork(Request $request, $id)
    {
        $user_id = auth()->user()->id;
        $work = Work::find($id);
        try {
            $work->delete();
            return back()->with('success', 'Категория удалена');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Ошибка удаления категории']);
        }
        ;
    }
}

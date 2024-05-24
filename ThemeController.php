<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThemeRequest;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\Chapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ThemeController extends Controller
{
    //Отображение тем курса
    public function storeTheme(): View
    {
        $themes = Theme::with('chapter')->get();
        $chapters = Chapter::all();
        return view('storeTheme', [
            'themes' => $themes,
            'chapters' => $chapters,
        ]);
    }

    //создание тем
    public function create_theme(Request $request)
{
    $request->validate([
        'document' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:2048',
    ]);

    /** @var UploadedFile $file */
    $file = $request->file('document');
    
    $filePath = 'documents/' . $file->getClientOriginalName();

    Storage::putFileAs('public', $file, $filePath);

    $theme = Theme::create([
        "chapter_id" => $request->chapter_id,
        "name" => $request->name,
        "type_of_activity" => $request->type_of_activity,
        "content" => $request->content,
        "document" => $filePath,
    ]);

    return back()->with("success", "Вы успешно добавили тему");
}

    //редактирование тем
    public function update(ThemeRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $theme = Theme::find($id)->update($validatedData);
        return back()->with("success", "Вы успешно обновили");
    }

    //удаление тем
    public function destroy(String $id)
    {
        $delete = Theme::find($id);
        try{
            $delete->delete();
            return back()->with('success', 'Тема удалена');
        }catch(\Exception $e){
            return back()->withErrors(['error' => 'Ошибка удаления']);
        };
    }
    
    public function downloadDocument($id)
    {
        $theme = Theme::findOrFail($id);
    
        $filePath = 'storage/' . $theme->document;
        $file = public_path($filePath);
    
        if (file_exists($file)) {
            return response()->download($file, pathinfo($theme->document, PATHINFO_BASENAME));
        } else {
            abort(404);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    //Вывод категорий
    public function storeCategory()
    {
        $categories = Category::all();
        if (request('search')) {
            $categories = Category::where('name', 'like', '%' . request('search') . '%')->get();
        } else {
            $categories = Category::all();
        }
        return view('storeCategory', [
            'categories' => $categories
        ]);
    }
    //Добавление категорий
    public function createСategory(CategoryRequest $request)
    {
        $validatedData = $request->validated();
        $category = Category::create($validatedData);
        return back();
    }

    //Изменение данных
    public function update(string $id, CategoryRequest $request)
    {
        $validatedData = $request->validated();
        $category = Category::find($id)->update($validatedData);
        return back();
    }

    //Удаление категории
    public function destroy(String $id)
    {
        $category = Category::find($id);
        try {
            $category->delete();
            return back()->with('success', 'Категория удалена');
        }catch(\Exception $e){
            return back()->withErrors(['error' => 'Ошибка удаления']);
        };
    }
}

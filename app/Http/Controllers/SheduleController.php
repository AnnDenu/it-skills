<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Shedule;
use App\Models\Theme;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class SheduleController extends Controller
{
    //Отображение
    public function show()
    {
        $currentDateTime = Date::now();
        $user = Auth::user();
        //Проверка на то, что является ли пользователь админом, если нет, то будет выводится только расписания пользователя.
        if ($user->role === 'admin') {
            $shedules = Shedule::where('date', '>=', $currentDateTime)->orderBy('date')->get();
        } else {
            $shedules = Shedule::where('user_id', $user->id)->where('date', '>=', $currentDateTime)->orderBy('date')->get();
        }
        $themes = Theme::all();
        $courses = Course::all();
        $users = User::where('role', 'teacher')->get();

        return view('calendar',[
            "themes"=>$themes,
            "users"=>$users,
            "courses"=>$courses,
            "shedules"=>$shedules->map(function ($shedule) {
                $shedule->date = Carbon::parse($shedule->date)->formatLocalized('%d %B %Y');
                return $shedule;
            })
        ]);
    }
    public function create_shedule(Request $request){

        // // Проверяем, что дата не раньше текущей даты
        // $date = Carbon::parse($request->input('date'));
        // if ($date->lt(Carbon::now())) {
        //     return redirect()->back()->withErrors(['date' => 'Нельзя добавлять расписание на прошлые даты.'])->withInput();
        // }
    // Если все проверки пройдены, создаем расписание

    $shedules = Shedule::create($request->all());
    return back()->with("success", "Вы успешно добавили");
}
    //Добавление
    public function store(Request $request)
    {
        $user = Auth::user();
        $create = Course::create([
            'sunrise' => $request->sunrise,
            'date' => $request->date,
            'content' =>$request->content,
            'user_id' => $request->user_id,
            'theme_id' => $request->theme_id,
        ]);
        Shedule::create($create);
        return back();
    }
public function update_shedule(Request $request){

    $user = Auth::user(); // Get the authenticated user

    $shedule = Shedule::where('id', $request->id)->where('user_id', $user->id)->firstOrFail();

    $shedule = Shedule::find($request->id);
        $shedule->sunrise = $request->sunrise;
        $shedule->date = $request->date;
        $shedule->content = $request->content;
        $shedule->user_id = $request->user_id;
        $shedule->theme_id = $request->theme_id;
        $shedule->save();

        return back();
    }
    public function shedule_destroy(Request $request, string $id)
    {
        $user = Auth::user();
        $shedule = Shedule::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        $shedule = Shedule::find($id)->delete();
        return back();
    }

}

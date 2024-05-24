<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Image;

class UserController extends Controller
{
    public function create(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=>$request->role,
        ]);
        return back()->with("success", "Вы успешно добавили пользователя");
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $users = User::where('name', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->get();

        return view('storeUser', [
            'users' => $users,
            'search' => $search,
        ]);
    }

    public function showUser()
    {

            $users = User::all();
        return view('storeUser',['users'=>$users]);
    }
    //Редактирование
    public function update(Request $request, string $id)
    {
        $user = User::find($id)->update($request->all());
        return back();
    }
    //Удаление пользователей
    public function destroy(string $id)
    {
        $user = User::find($id)->delete();
        return back();
    }

    public function updateAvatar(Request $request, User $user)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $name = time() . '.' . $avatar->getClientOriginalExtension();
            $destinationPath = public_path('/storage/avatars');
            $avatar->move($destinationPath, $name);
            $user->avatar = 'avatars/' . $name;
            $user->save();
        }

        return redirect()->route('profile.edit', $user);
    }

}

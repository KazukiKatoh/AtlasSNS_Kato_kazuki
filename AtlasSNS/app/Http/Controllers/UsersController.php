<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    //
    public function profile(Request $request)
    {
        $post = $request->input('profile');
        return view('users.profile');
    }
    public function profileedit(Request $request)
    {
        $id = Auth::id();
        $rules = [
            "username" => "required|string|min:2|max:12",
            "mail" => "required|string|email|between:5,40|unique:users,mail," . $id,
            "password" => "string|regex:/^[a-zA-Z0-9]{8,20}+$/|confirmed",
            "bio" => "max:150",
            "images" => "file|mines:jpg,png,gif,svg,bmp"
        ];
        $validator = Validator::make($request->all(), $rules)->validate();
        $user = User::find($id);
        $user->username = $request->input('username');
        $user->mail = $request->input('mail');
        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->bio = $request->input('bio');
        if ($request->hasFile('imgpath')) {
            $user->images = $request->imgpath->getClientOriginalName();
            $request->imgpath->storeAs('public', $user->images);
        }
        $user->save();
        return redirect('/top');
    }

    public function search(Request $request)
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('users.search', compact('users'));
    }
    public function searchresult(Request $request)
    {
        $keyword = $request->input('keyword');
        $users = User::where('id', '!=', auth()->id())
            ->when($keyword, function ($query, $keyword) {
                return $query->where('username', 'LIKE', '%' . $keyword . '%');
            })
            ->get();
        return view('users.search', compact('users', 'keyword'));
    }

    public function otherprofile($id)
    {
        $user = User::find($id);
        if (!$user || $user->id == auth()->id()) {
            return redirect()->back();
        }
        return view('users.otherprofile', [
            'user' => $user,
            'posts' => $user->posts()->latest()->get()
        ]);
    }
}

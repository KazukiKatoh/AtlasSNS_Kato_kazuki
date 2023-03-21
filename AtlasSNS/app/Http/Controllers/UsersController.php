<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\User;

use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    //
    public function profile(Request $request){
        $post = $request->input('profile');
        return view('users.profile');
    }
    public function profileedit(Request $request){
        $id = Auth::id();
        $rules = [
            "username" => "required|string|min:2|max:12",
            "mail" => "required|string|email|between:5,40|unique:users,mail,".$id,
            "password" => "string|regex:/^[a-zA-Z0-9]{8,20}+$/|confirmed",
            "bio" => "max:150",
            "images" => "file|mines:jpg,png,gif,svg,bmp"
        ];
        $validator = Validator::make($request->all(), $rules);
        $username = $request->input('username');
        $mail = $request->input('mail');
        $password = $request->input('password');
        $bio = $request->input('bio');

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->hasFile('imgpath')) {
            $filename = $request->file('imgpath')->getClientOriginalName();
            $images = $request->file('imgpath')->storeAs('public/images', $filename);
            User::where('id', $id)->update([
                'username' => $request->input('username'),
                'mail' => $request->input('mail'),
                'password' => bcrypt($request->input('password')),
                'bio' => $request->input('bio'),
                'images' => $images
            ]);
        } else {
            User::where('id', $id)->update([
                'username' => $request->input('username'),
                'mail' => $request->input('mail'),
                'password' => bcrypt($request->input('password')),
                'bio' => $request->input('bio')
            ]);
        }
            return redirect('/top');
    }
    public function search(Request $request){
        $users = User::where('id', '!=', Auth::user()->id)->get();
        $post = $request->input('search');
        return view('users.search',['users' => $users]);
    }
    public function searchresult(Request $request){
        $loggedInUserId = auth()->user()->id;
        $keyword = $request->input('keyword');
        $users = User::whereNotIn('id', [$loggedInUserId]);
        if($keyword){
            $users = $users->where('username', 'LIKE', '%'.$keyword.'%')->get();
        } else {
            $users = $users->get();
        }
        return view('users.search',['users' => $users, 'keyword'=>$keyword]);
    }
}

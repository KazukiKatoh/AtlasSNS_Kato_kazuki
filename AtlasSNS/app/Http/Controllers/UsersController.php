<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class UsersController extends Controller
{
    //
    public function profile(Request $request){
        $post = $request->input('profile');
        return view('users.profile');
    }
    public function search(Request $request){
        $list = \DB::table('users')->get();
        $post = $request->input('search');
        return view('users.search',['list'=>$list]);
    }
    public function searchbox(Request $request){
        $keyword = $request->input('keyword');
        $list = \DB::table('users')->where('username','like','%'.$keyword.'%')
        ->get();
        return view('users.search',['list'=>$list]);
    }
}

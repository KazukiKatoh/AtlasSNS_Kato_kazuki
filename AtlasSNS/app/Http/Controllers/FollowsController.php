<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class FollowsController extends Controller
{
    //
    public function followList(){
        $user = auth()->user();
        $followingList = $user->following()->paginate(10);
        return view('follows.followList', compact('followingList'));
    }
    public function followerList(){
        return view('follows.followerList');
    }
    public function follow(Request $request){
        $post = $request->input('id');
        \DB::table('follows')->insert([
            'followed_id' => $post,
            'following_id' => Auth::user()->id
        ]);
            return back();
        }
        public function unFollow($id){
        \DB::table('follows')->where('following_id', Auth::user()->id)->where('followed_id', $id)->delete();
            return back();
        }

}

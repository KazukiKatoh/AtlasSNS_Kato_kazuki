<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Post;

class FollowsController extends Controller
{
    //
    public function followList(){
        $user = Auth()->user();
        $list = \DB::table('posts')
        ->latest('posts.updated_at')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.*', 'users.username', 'users.images')
        ->whereIn('user_id', function($query) use ($user) {
            $query->select('followed_id')
                ->from('follows')
                ->where('following_id', $user->id);
        })
        ->get();
        foreach ($list as $post) {
        $post->images = asset('/storage/images/' . $post->images);
    }
        return view('follows.followlist', ['list' => $list]);
    }
    public function followerList(){
        $user = Auth()->user();
        $list = \DB::table('posts')
        ->latest('posts.updated_at')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.*', 'users.username')
        ->whereIn('user_id', function($query) use ($user) {
            $query->select('following_id')
                ->from('follows')
                ->where('followed_id', $user->id);
        })
        ->get();
        return view('follows.followerlist', ['list' => $list]);
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

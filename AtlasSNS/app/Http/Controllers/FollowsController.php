<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class FollowsController extends Controller
{
    //
    public function followList()
    {
        $user = auth()->user();
        $list = \DB::table('posts')
            ->latest('updated_at')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username', 'users.images')
            ->whereIn('user_id', function ($query) use ($user) {
                $query->select('followed_id')
                    ->from('follows')
                    ->where('following_id', $user->id);
            })
            ->get()
            ->each(function ($post) {
                $post->images = asset('/storage/' . $post->images);
            });
        $followedUsers = \DB::table('follows')
            ->join('users', 'follows.followed_id', '=', 'users.id')
            ->select('users.id', 'users.images')
            ->where('following_id', $user->id)
            ->get();
        return view('follows.followlist', compact('list', 'followedUsers'));
    }

    public function followerList()
    {
        $user = auth()->user();
        $list = \DB::table('posts')
            ->latest('updated_at')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username', 'users.images')
            ->whereIn('user_id', function ($query) use ($user) {
                $query->select('following_id')
                    ->from('follows')
                    ->where('followed_id', $user->id);
            })
            ->where('user_id', '!=', $user->id)
            ->get()
            ->each(function ($post) {
                $post->images = asset('/storage/' . $post->images);
            });
        $followerUsers = \DB::table('follows')
            ->join('users', 'follows.following_id', '=', 'users.id')
            ->select('users.id', 'users.images')
            ->where('followed_id', $user->id)
            ->get();
        return view('follows.followerlist', compact('list', 'followerUsers'));
    }
    public function follow(Request $request)
    {
        $post = $request->input('id');
        \DB::table('follows')->insert([
            'followed_id' => $post,
            'following_id' => Auth::user()->id
        ]);
        return back();
    }
    public function unFollow($id)
    {
        \DB::table('follows')->where('following_id', Auth::user()->id)->where('followed_id', $id)->delete();
        return back();
    }
}

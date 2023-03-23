<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class FollowsController extends Controller
{
    //
    public function followList()
    {
        $user = Auth()->user();
        $list = \DB::table('posts')
            ->latest('posts.updated_at')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username', 'users.images')
            ->whereIn('user_id', function ($query) use ($user) {
                $query->select('followed_id')
                    ->from('follows')
                    ->where('following_id', $user->id);
            })
            ->get();
        $followedUsers = \DB::table('follows')
            ->join('users', 'follows.followed_id', '=', 'users.id')
            ->select('users.id', 'users.images')
            ->where('following_id', $user->id)
            ->get();
        foreach ($list as $post) {
            $post->images = asset('/storage/' . $post->images);
        }
        return view('follows.followlist', ['list' => $list, 'followedUsers' => $followedUsers]);
    }

    public function followerList()
    {
        $user = Auth()->user();
        $list = \DB::table('posts')
            ->latest('posts.updated_at')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username', 'users.images')
            ->whereIn('user_id', function ($query) use ($user) {
                $query->select('following_id')
                    ->from('follows')
                    ->where('followed_id', $user->id);
            })
            ->whereNotIn('user_id', [$user->id])
            ->get();
        $followerUsers = \DB::table('follows')
            ->join('users', 'follows.following_id', '=', 'users.id')
            ->select('users.id', 'users.images')
            ->where('followed_id', $user->id)
            ->get();
        foreach ($list as $post) {
            $post->images = asset('/storage/' . $post->images);
        }
        return view('follows.followerlist', ['list' => $list, 'followerUsers' => $followerUsers]);
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

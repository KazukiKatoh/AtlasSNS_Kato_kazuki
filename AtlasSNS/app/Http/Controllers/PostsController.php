<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Post;

class PostsController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = Auth()->user();
        $list = \DB::table('posts')
            ->latest('posts.created_at')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username', 'users.images')
            ->whereIn('user_id', function ($query) use ($user) {
                $query->select('followed_id')
                    ->from('follows')
                    ->where('following_id', $user->id);
            })
            ->orWhere('user_id', $user->id)
            ->get();
        return view('posts.index', ['list' => $list, 'user' => $user]);
    }

    public function create(Request $request)
    {
        $post = $request->input('createPost');
        if (empty($post)) {
            return redirect()->back()->withInput()->withErrors(['createPost' => '投稿内容が空欄です。']);
        }
        if (mb_strlen($post) > 150) {
            return redirect()->back()->withInput()->withErrors(['createPost' => '投稿内容は全角150文字以内で入力してください。']);
        }
        \DB::table('posts')->insert([
            'post' => $post,
            'user_id' => Auth::user()->id
        ]);
        return redirect('top');
    }
    public function edit(Request $request, $id)
    {
        $id = $_POST['id'];
        $post = $request->input('postEdit');
        if (empty($post)) {
            return redirect('top');
        }
        Post::where('id', $id)->update(['post' => $post]);
        return redirect('top');
    }

    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect('top');
    }
}

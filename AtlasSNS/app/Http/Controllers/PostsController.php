<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\User;

class PostsController extends Controller
{
    //
    public function index(Request $request){
        $list = \DB::table('posts')->get();
        return view('posts.index',['list'=>$list]);
    }
    public function create(Request $request){
        $post = $request->input('createPost');
        \DB::table('posts')->insert([
            'post' => $post,
            'user_id' => Auth::user()->id
        ]);
        return redirect('top');
    }
    public function edit(Request $request, $id){
        $id = $_POST['id'];
        $post = $request->input('postEdit');
        Post::where('id', $id)->update(['post' => $post]);
        return redirect('top');
    }
    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect('top');
    }
}
?>

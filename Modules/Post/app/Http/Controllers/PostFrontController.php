<?php

namespace Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Post\Models\Post;

class PostFrontController extends Controller
{
    public function posts () {
        $posts = Post::query()->where('status',Post::STATUS_VERIFIED)->whereNull('university_id')->take(12)->orderBy('id','DESC')->get();
        return view('post::posts',compact('posts'));
    }

    public function postsContent(Post $post)
    {
        $string = '<h2 class="text-center">'.$post->name.'</h2>';
        $string .= '<p class="my-4">'.$post->expert.'</p>';
        $string .= '<img src="'. asset($post->image['indexArray']['full']) .'" alt="">';
        $string .= '<p class="my-4">'.$post->des.'</p>';
        return $string;
    }

    public function morePosts(Request $request){
        $num = $request->num*12;
        $string = '';
        $posts = Post::query()->where('status',Post::STATUS_VERIFIED)->whereNull('university_id')->skip($num)->take(12)->orderBy('id','DESC')->get();
        if ($posts->count()) {
            foreach ($posts as $post) {
                if ($post->image) {
                    $string .= '<div class="post-container">
                        <img src="'. asset($post->image['indexArray']['medium']) .'" alt="">
                        <h3 class="my-2">'. $post->name .'</h3>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#postDes" lll="'. route('post.postsContent',$post->id) .'" onclick="setPost('. $post->id .',this)">
                            مشاهده خبر
                        </button>
                    </div>';
                } else {
                    $string .= '<div class="post-container">
                        <img src="" alt="">
                        <h3 class="my-2">'. $post->name .'</h3>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#postDes" lll="'. route('post.postsContent',$post->id) .'" onclick="setPost('. $post->id .',this)">
                            مشاهده خبر
                        </button>
                    </div>';
                }
            }
            return $string;
        } else {
            return false;
        }
    }
}

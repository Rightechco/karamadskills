<?php

namespace Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\Http\Services\Image\ImageService;
use Modules\Post\Http\Repositories\PostRepo;
use Modules\Post\Http\Requests\PostRequest;
use Modules\Post\Http\Requests\PostUpdateRequest;
use Modules\Post\Http\Services\PostService;
use Modules\Post\Models\Post;
use Modules\University\Models\University;
use Modules\Common\Http\Services\CommonServices;

class PostController extends Controller
{

    public function posts()
    {
        return view('post::panel.posts');
    }

    public function getPosts(Request $request)
    {
        return PostRepo::getPosts($request);
    }

    public function postCreate()
    {
        if (auth()->user()->can('PostPermission') || auth()->user()->universities->count()) {
            if (auth()->user()->can('PostPermission')) {
                $universities = University::query()->where('state', University::VAHED)->select('id', 'name')->get()->toArray();
            } else {
                $universities = University::query()->where('state', University::VAHED)->where(function ($query) {
                    $query->with('admins')->whereHas('admins', function ($q) {
                        $q->where('user_id', auth()->user()->id);
                    });
                })->select('id', 'name')->get()->toArray();
            }
            return view('post::panel.create',compact('universities'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function postStore(PostRequest $request,ImageService $imageService)
    {
        if (auth()->user()->can('PostPermission') || auth()->user()->universities->count()) {
            $input = $request->validated();
            if ($request->des && str_contains($request->des, 'base64')) {
                $des = CommonServices::saveSummerNote($request->des,'postDesImg');
                $input['des'] = $des;
            }
            if ($request->expert && str_contains($request->expert, 'base64')) {
                $expert = CommonServices::saveSummerNote($request->expert,'postExpertImg');
                $input['expert'] = $expert;
            }

            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'postImage');
                $resulCover = $imageService->createIndexAndSave($request->file('image'));
                if ($resulCover === false) {
                    $toasts = ['toast' => [
                        [
                            'message' => 'ذخیره تصویر با خطا مواجه شد',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return back()->with($toasts);
                }
            }
            $input['image'] = $resulCover ?? null;

            $post = PostService::create($input);
            $toasts = ['toast' => [
                [
                    'message' => 'مطلب با موفقیت ایجاد شد، در انتظار تایید توسط پشتیبانی باشید',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.post.posts')->with($toasts);
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function postEdit(Post $post)
    {
        if (auth()->user()->can('PostPermission') || in_array($post->university_id,array_column(auth()->user()->universities->toArray(),'id'))) {
            if (auth()->user()->can('PostPermission')) {
                $universities = University::query()->where('state', University::VAHED)->select('id', 'name')->get()->toArray();
            } else {
                $universities = University::query()->where('state', University::VAHED)->where(function ($query) {
                    $query->with('admins')->whereHas('admins', function ($q) {
                        $q->where('user_id', auth()->user()->id);
                    });
                })->select('id', 'name')->get()->toArray();
            }
            return view('post::panel.edit',compact('universities','post'));
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function postUpdate(Post $post,PostUpdateRequest $request,ImageService $imageService)
    {
        if (auth()->user()->can('PostPermission') || in_array($post->university_id,array_column(auth()->user()->universities->toArray(),'id'))) {
            $input = $request->validated();
            if ($request->des && str_contains($request->des, 'base64')) {
                $des = CommonServices::saveSummerNote($request->des,'postDesImg');
                $input['des'] = $des;
            }
            if ($request->expert && str_contains($request->expert, 'base64')) {
                $expert = CommonServices::saveSummerNote($request->expert,'postExpertImg');
                $input['expert'] = $expert;
            }

            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'postImage');
                $resulCover = $imageService->createIndexAndSave($request->file('image'));
                if ($resulCover === false) {
                    $toasts = ['toast' => [
                        [
                            'message' => 'ذخیره تصویر با خطا مواجه شد',
                            'alert-type' => 'error'
                        ]
                    ]];
                    return back()->with($toasts);
                }
            }
            $input['image'] = $resulCover ?? null;

            if(!auth()->user()->can('PostPermission')) {
                $input['status'] = $post::STATUS_WAIT;
            }
            
            $post = PostService::update($input,$post);
            $toasts = ['toast' => [
                [
                    'message' => 'بازدید با موفقیت ویرایش، در انتظار تایید توسط پشتیبانی باشید',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.post.posts')->with($toasts);
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function postDelete(Post $post)
    {
        if (auth()->user()->can('PostPermission') || in_array($post->university_id,array_column(auth()->user()->universities->toArray(),'id'))) {
            $post->delete();
            $toasts = ['toast' => [
                [
                    'message' => 'مطلب حذف شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.post.posts')->with($toasts);
        } else {
            $toasts = ['toast' => [
                [
                    'message' => 'دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }
}

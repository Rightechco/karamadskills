<?php

namespace Modules\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Comment\Http\Repositories\CommentRepo;
use Modules\Comment\Http\Services\CommentService;
use Modules\Comment\Models\Comment;

class CommentController extends Controller
{
    public function comments()
    {
        if (auth()->user()->can('CompanyPermission')) {
            return view('comment::panel.comments');
        }
        abort(403);
    }

    public function getComments(Request $request)
    {
        if (auth()->user()->can('CompanyPermission')) {
            return CommentRepo::getComments($request);
        }
        abort(403);
    }

    public function createComment(Request $request)
    {
        $rules = array(
            'commentable_id' => 'required|numeric',
            'commentable_type' => 'required|string|min:3|max:225',
            'body' => 'required|string|max:3500|min:3',
            'rating' => 'nullable|numeric'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()):
            $toasts = ['toast' => [
                [
                    'message' => 'وارد کردن متن نظر الزامی می باشد',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        endif;
        if (class_exists($request->commentable_type)) {
            CommentService::create($request);
            $toasts = ['toast' => [
                [
                    'message' => 'نظر شما ثبت شد و بعد از تایید ، نمایش داده می شود',
                    'alert-type' => 'success'
                ]
            ]];
            return back()->with($toasts);
        }
        abort(403);
    }

    public function getText(Comment $comment)
    {
        return '<p>'.$comment->body.'</p>';
    }

    public function reply(Request $request)
    {
        $rules = array(
            'id' => 'required|numeric|exists:comments,id',
            'reply' => 'required|string|max:3500|min:3',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()):
            $toasts = ['toast' => [
                [
                    'message' => 'وارد کردن متن پاسخ الزامی می باشد',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        endif;
        $comment = Comment::query()->where('id',$request->id)->first();
        if ($comment) {
            $reply = CommentService::reply($request,$comment);
            $toasts = ['toast' => [
                [
                    'message' => 'پاسخ ثبت شد',
                    'alert-type' => 'success'
                ]
            ]];
            return back()->with($toasts);
        }
        abort(404);
    }

    public function commentVerify(Comment $comment)
    {
        $comment->status = Comment::ACTIVE;
        $comment->save();
        $toasts = ['toast' => [
            [
                'message' => 'ثبت شد',
                'alert-type' => 'success'
            ]
        ]];
        return back()->with($toasts);
    }

    public function commentUnVerify(Comment $comment)
    {
        $comment->status = Comment::INACTIVE;
        $comment->save();
        $toasts = ['toast' => [
            [
                'message' => 'ثبت شد',
                'alert-type' => 'success'
            ]
        ]];
        return back()->with($toasts);
    }
}

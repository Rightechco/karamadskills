<?php

namespace Modules\Comment\Http\Services;

use Modules\Comment\Models\Comment;

class CommentService
{
    public static function create($request)
    {
        return Comment::query()->create([
           'title' => $request->title ?? null,
           'body' => $request->body,
            'rating' => $request->rating ?? null,
            'commentable_id' => $request->commentable_id,
            'commentable_type' => $request->commentable_type,
            'user_id' => auth()->user()->id
        ]);
    }

    public static function reply($request,$comment)
    {
        return Comment::query()->create([
            'body' => $request->reply,
            'commentable_id' => $comment->commentable_id,
            'commentable_type' => $comment->commentable_type,
            'user_id' => auth()->user()->id,
            'parent_id' => $comment->id,
            'status' => Comment::ACTIVE
        ]);
    }
}

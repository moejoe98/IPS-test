<?php

namespace Tests\Traits;

use App\Events\CommentWritten;
use App\Models\Comment;

trait AddsComment
{
    /**
     * Dispatch CommentWritten event
     */
    private function addComment()
    {
        $comment = new Comment([
            'user_id' => 1,
            'body' => 'Test'
        ]);

        CommentWritten::dispatch($comment);
    }
}
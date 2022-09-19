<?php

namespace App\Mail\Web\Blog;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewComment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $blogPost, $comment;
    
    public function __construct(BlogPost $blogPost, Comment $comment)
    {
        $this->blogPost = $blogPost;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nuevo comentario: '.$this->blogPost->name)->markdown('web.emails.post.new-comment', [
            'blogPost' => $this->blogPost,
            'comment' => $this->comment
        ]);
    }
}

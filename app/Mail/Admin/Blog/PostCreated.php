<?php

namespace App\Mail\Admin\Blog;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostCreated extends Mailable
{
    use Queueable, SerializesModels;

    private $blogPost;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($blogPost)
    {
        $this->blogPost = $blogPost;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nuevo post: '.$this->blogPost->name)->markdown('admin.emails.post.created', [
            'blogPost' => $this->blogPost,
        ]);
    }
}

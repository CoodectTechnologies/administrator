<?php

namespace App\Mail\Web\Product;

use App\Models\Comment;
use App\Models\Product;
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
    private $product, $comment;
    
    public function __construct(Product $product, Comment $comment)
    {
        $this->product = $product;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nuevo comentario: '.$this->product->name)->markdown('web.emails.product.new-comment', [
            'product' => $this->product,
            'comment' => $this->comment
        ]);
    }
}

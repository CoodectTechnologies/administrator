<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Comment\CommentCreate as NotificationCommentCreate;
use App\Mail\Comment\CommentCreate as MailCommentCreate;
use App\Models\Comment;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function index(){
        $model = Product::find(1);
        $comment = Comment::find(1);
        Notification::send(
            User::permission(['comentarios'])->get(),
            new NotificationCommentCreate($model, $comment)
        );
        Mail::to(config('contact.email'))
        ->bcc(
            User::permission(['comentarios'])
            ->whereNotIn('email', config('contact.email'))
            ->pluck('email'))
        ->send(new MailCommentCreate($model, $comment));
        dd('ps ya todo bien segun');
    }
}

<?php

namespace App\Http\Livewire\Ecommerce\Comment;


use App\Notifications\Comment\CommentCreate as NotificationCommentCreate;
use App\Mail\Comment\CommentCreate as MailCommentCreate;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Comment;
use App\Models\User;
use Exception;
use Livewire\Component;

class Form extends Component
{
    public $model;
    public $comment;

    public function mount($model, Comment $comment){
        $this->model = $model;
        $this->comment = $comment;
    }
    protected function rules(){
        return [
            'comment.name' => 'required',
            'comment.email' => 'required',
            'comment.stars' => 'required',
            'comment.body' => 'required'
        ];
    }
    public function render(){
        return view('livewire.ecommerce.comment.form');
    }
    public function store(){
        $this->validate();
        $this->comment->user_id = Auth::id() ?? null;
        $this->comment->name = Auth::check() ? Auth::user()->name : '';
        $this->comment->email = Auth::check() ? Auth::user()->email : '';
        $this->comment->approved = false;
        $this->comment = $this->model->comments()->create($this->comment->toArray());
        $this->notifyUsers();
        $this->comment = new Comment();
        session()->flash('alert-type', 'success');
        session()->flash('alert', __('The comment has been sent, for security reasons it will be reviewed before being published'));
    }
    private function notifyUsers(){
        Notification::send(
            User::permission(['comentarios'])->get(),
            new NotificationCommentCreate($this->model, $this->comment)
        );
        Mail::to(config('contact.email'))
        ->bcc(
            User::permission(['comentarios'])
            ->where('email', '<>', config('contact.email'))
            ->pluck('email'))
        ->send(new MailCommentCreate($this->model, $this->comment));
    }
}

<?php

namespace App\Observers;

use App\Mail\Admin\Blog\PostCreated;
use App\Models\BlogPost;
use App\Models\Subscriber;
use Exception;
use Illuminate\Support\Facades\Mail;

class BlogPostObserver
{
    /**
     * Handle the BlogPost "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        try{
            if($blogPost->status=='Publicado'):
                $this->sendEmail($blogPost);
            endif;
        }catch(Exception $e){
            
        }        
    }

    /**
     * Handle the BlogPost "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        try{
            if(!$blogPost->send_email && $blogPost->status=='Publicado'):
                $this->sendEmail($blogPost);
            endif;
        }catch(Exception $e){
            
        } 
    }

    /**
     * Handle the BlogPost "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }

    private function sendEmail($blogPost){
        $subscribers = Subscriber::all();
        foreach($subscribers as $subscriber):
            Mail::to($subscriber->email)->send(new PostCreated($blogPost));
        endforeach;
        $blogPost->send_email = true;
        $blogPost->save();
    }
}

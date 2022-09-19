<?php

namespace App\Providers;

use App\Listeners\MailSuccessfulDatabaseBackup;
use App\Models\BlogPost;
use App\Models\Image;
use App\Models\Order;
use App\Models\User;
use App\Observers\BlogPostObserver;
use App\Observers\ImageObserver;
use App\Observers\OrderObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Spatie\Backup\Events\BackupZipWasCreated;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        BackupZipWasCreated::class => [
            MailSuccessfulDatabaseBackup::class
        ],
    ];

    /**
     * The model observers for your application.
     *
     * @var array
     */

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Image::observe(ImageObserver::class);
        BlogPost::observe(BlogPostObserver::class);
        Order::observe(OrderObserver::class);
    }
}

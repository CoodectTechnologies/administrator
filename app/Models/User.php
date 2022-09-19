<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasRoles, HasFactory, Notifiable, LogsActivity, CausesActivity;

    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Logs
    protected static $logName = 'Usuario';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string{
        return "Un usuario ha sido {$eventName}";
    }
    public function sessions(){
        return $this->hasMany(Session::class);
    }
    public function session(){
        return $this->hasOne(Session::class)->latestOfMany();
    }
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
    public function blogPosts(){
        return $this->hasMany(BlogPost::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function orderInvoices(){
        return $this->hasMany(OrderInvoice::class);
    }
    public function shippingAddresses(){
        return $this->hasMany(ShippingAddress::class);
    }
    public function ordersCount(){
        return count($this->orders);
    }
    public function ordersIncome(){
        return $this->orders()->sum('total');
    }
    public function shippingAddressDefect(){
        return $this->shippingAddresses()->where('default', 1)->first();
    }
    public function isOnline(){
        $online = false;
        if($this->session):
            if(!$this->session->isExpired()):
                $online = true;
            endif;
        endif;
        return $online;
    }
    public function imagePreview(){
        $image = asset('assets/admin/media/avatars/blank.png');
        if($this->image):
            if(Storage::exists($this->image->url)):
                $image = Storage::url($this->image->url);
            else:
                $image = $this->image->url;
            endif;
        endif;
        return $image;
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}

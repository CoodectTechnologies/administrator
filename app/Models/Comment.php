<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Comment extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Comentario';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string {
        return "Un comentario ha sido {$eventName}";
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function commentable(){
        return $this->morphTo();
    }
    //Gets
    public function imageUserPreview(){
        $image = asset('assets/admin/media/avatars/blank.png');
        if($this->user):
            $image = $this->user->imagePreview();
        endif;
        return $image;
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
    public function getPercentage(){
        return ($this->stars * 100) / 5;
    }
    //Scope
    public function scopeValidate($query){
        return $query->where('approved', true);
    }
}

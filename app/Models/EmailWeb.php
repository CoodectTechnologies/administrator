<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class EmailWeb extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Correo web';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string {
        return "Un correo web ha sido {$eventName}";
    }
    public function conversionToString(){
        if($this->conversion == 'No'):
            return '<span class="badge badge-light-danger">'.$this->conversion.'</span>';
        elseif($this->conversion == 'Si'):
            return '<span class="badge badge-light-success">'.$this->conversion.'</span>';
        elseif($this->conversion == 'En espera'):
            return '<span class="badge badge-light-warning">'.$this->conversion.'</span>';
        else:
            return '<span class="badge badge-light-secondary">Desconocido</span>';
        endif;
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}

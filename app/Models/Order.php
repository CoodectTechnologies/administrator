<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Orden';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string {
        return "Una orden ha sido {$eventName}";
    }
    public function getRouteKeyName(){
        return 'number';
    }
    public function products(){
        return $this->belongsToMany(Product::class)->withTimestamps()->withPivot(['size', 'color', 'quantity', 'price', 'subtotal', 'created_at']);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function shippingAddress(){
        return $this->belongsTo(ShippingAddress::class);
    }
    public function orderInvoice(){
        return $this->hasOne(OrderInvoice::class);
    }
    public function totalToString(){
        return '$'.number_format($this->total, 2);
    }
    public function subtotalToString(){
        return '$'.number_format($this->subtotal, 2);
    }
    public function shippingPriceToString(){
        return '$'.number_format($this->shipping_price, 2);
    }
    public function statusToString(){
        $status = '';
        switch($this->status){
            case 'Procesando':
                $status = '<div class="badge badge-success">'.$this->status.'</div>';
                break;
            case 'Completado':
                $status = '<div class="badge badge-primary">'.$this->status.'</div>';
                break;
            case 'Cancelado':
                $status = '<div class="badge badge-danger">'.$this->status.'</div>';
                break;
            default: 
                $status = '<div class="badge badge-warning">Status no encontrado</div>';
                break;
        }
        return $status;
    }
    public function paymentStatusToString(){
        $paymentStatus = '';
        switch($this->payment_status){
            case 'Aprobado':
                $paymentStatus = '<div class="badge badge-success">'.$this->payment_status.'</div>';
                break;
            case 'Pendiente':
                $paymentStatus = '<div class="badge badge-warning">'.$this->payment_status.'</div>';
                break;
            case 'Rechazado':
                $paymentStatus = '<div class="badge badge-danger">'.$this->payment_status.'</div>';
                break;
            default: 
                $paymentStatus = '<div class="badge badge-warning">Status no encontrado</div>';
                break;
        }
        return $paymentStatus;
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}

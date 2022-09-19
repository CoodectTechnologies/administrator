<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingPrice extends Model
{
    use HasFactory;

    public static function getShippingPrice($stateId, $zipCode){
        $price = null;
        $shippingZones = ShippingZone::query()
        ->has('states')
        ->with('states')
        ->whereRelation('states', 'state_id', $stateId)
        ->cursor();
        $shoppingCart = [];
        foreach(Cart::content() as $item):
            $shoppingCart[] = [
                'shippingClassId' => $item->model->shippingClass ? $item->model->shippingClass->id : null,
                'qty' => $item->qty
            ];
        endforeach;
        foreach($shippingZones as $shippingZone):
            if($shippingZone->zip_codes):
                $shippingZonesExplodeWithComa = explode(',', $shippingZone->zip_codes);
                if(in_array($zipCode, $shippingZonesExplodeWithComa)):
                    $price = self::validateShippingPrice($shippingZone);
                    break;
                else:
                    foreach($shippingZonesExplodeWithComa as $shippingZoneExplodeWithComa):
                        $shippingZoneExplodeWithComa = trim($shippingZoneExplodeWithComa);
                        if(str_contains($shippingZoneExplodeWithComa, '...')):
                            $shippingZoneExplodeWithPoints = explode('...', $shippingZoneExplodeWithComa);
                            $zipCodeStart = $shippingZoneExplodeWithPoints[0];
                            $zipCodeEnd = $shippingZoneExplodeWithPoints[1];
                            if(
                                $zipCode >= $zipCodeStart && 
                                $zipCode <= $zipCodeEnd
                            ):
                                $price = self::validateShippingPrice($shippingZone);
                                break 2;
                            endif;
                        endif;    
                    endforeach;
                endif;
            else:
                $price = self::validateShippingPrice($shippingZone);
            endif;
        endforeach;
        if($price === null):
            $price = config('shipping.price_default');
        endif;
        return $price;
    }
    protected function validateShippingPrice($shippingZone){
        $priceWithShippingClassQty = 0;
        $priceWithShippingClass = 0;
        $priceWithoutShippingClass = 0;
        $shippingClassIdsRepeat = [];
        $shoppingCart = [];
        if(
            $shippingZone->free_shipping_over_to && 
            Cart::subtotal() >= $shippingZone->free_shipping_over_to
        ):
            return 0; //Free shipping price
        else:
            $shippingClassTemp = [];
            foreach($shippingZone->shippingClasses as $shippingClass):
                $shippingClassTemp[$shippingClass->id] = $shippingClass->pivot;
            endforeach;            
            foreach(Cart::content() as $item):
                $shoppingCart[] = [
                    'shippingClassId' => $item->model->shippingClass ? $item->model->shippingClass->id : null,
                    'qty' => $item->qty
                ];
            endforeach;
            foreach($shoppingCart as $cart):
                if(!$cart['shippingClassId']):
                    $priceWithoutShippingClass = $shippingZone->price;
                else:
                    if(isset($shippingClassTemp[$cart['shippingClassId']])):
                        $shippingClass = $shippingClassTemp[$cart['shippingClassId']];
                        if($shippingClass->multiply_quantity):
                            $priceWithShippingClassQty += ($shippingClass->price * $cart['qty']);
                        else:
                            if(!in_array($cart['shippingClassId'], $shippingClassIdsRepeat)):
                                array_push($shippingClassIdsRepeat, $cart['shippingClassId']);
                                $priceWithShippingClass += $shippingClass->price;
                            endif;                        
                        endif;
                    endif;
                endif;            
            endforeach;
            return ($priceWithShippingClassQty + $priceWithShippingClass + $priceWithoutShippingClass);
        endif;
    }
}

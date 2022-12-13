<?php

namespace App\Http\Livewire\Admin\Coupon;

use App\Models\Coupon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Form extends Component
{
    public $coupon;
    public $method;
    public $currenciesArray = [];
    public $search;
    protected $queryString = ['search' => ['except' => '']];

    protected function rules(){
        return [
            'coupon.code' => 'required|unique:coupons,code,'.$this->coupon->id,
            'coupon.percentage' => 'required|min:1|max:99',
            'coupon.date_end' => 'required|date',
            'coupon.minimum_expense' => 'nullable|integer',
            'coupon.exclude_promotion' => 'nullable',
            'coupon.limit_of_use' => 'nullable',
            'coupon.active' => 'required',
        ];
    }
    public function mount(Coupon $coupon, $method){
        $this->coupon = $coupon;
        $this->method = $method;
        $this->currenciesArray = $this->coupon->currencies()->pluck('currency_id')->toArray();
    }
    public function render(){
        $currencies = Cache::get('currencies') ?? [];
        return view('livewire.admin.coupon.form', compact('currencies'));
    }
    public function store(){
        $this->validate();
        $this->coupon->save();
        $this->saveCurrencies();
        $this->emit('alert', 'success', 'Cupón agregado con éxito');
        $this->emit('render');
        return Redirect::route('admin.coupon.index');
    }
    public function update(){
        $this->validate();
        $this->coupon->update();
        $this->saveCurrencies();
        $this->emit('alert', 'success', 'Cupón actualizado con éxito');
        $this->emit('render');
        return Redirect::route('admin.coupon.index');
    }
    private function saveCurrencies(){
        $this->coupon->currencies()->sync($this->currenciesArray);
    }
}

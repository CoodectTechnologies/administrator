<?php

namespace App\Http\Livewire\Admin\User\ShippingAddress;

use App\Models\Country;
use App\Models\ShippingAddress;
use App\Models\State;
use App\Models\User;
use Livewire\Component;

class Form extends Component
{
    public $user;
    public $shippingAddress;
    public $countryId;

    protected function rules(){
        return [
            'countryId' => 'required',
            'shippingAddress.state_id' => 'required',
            'shippingAddress.municipality' => 'required',
            'shippingAddress.colony' => 'required',
            'shippingAddress.zip_code' => 'required|min:5',
            'shippingAddress.street' => 'required',
            'shippingAddress.street_number_int' => 'required',
            'shippingAddress.street_number_ext' => 'nullable',
            'shippingAddress.street_between' => 'nullable',
            'shippingAddress.street_references' => 'nullable',
            'shippingAddress.company' => 'nullable',
            'shippingAddress.name' => 'required',
            'shippingAddress.phone' => 'nullable',
            'shippingAddress.email' => 'required|email',
            'shippingAddress.default' => 'nullable',
        ];
    }
    public function mount(User $user, ShippingAddress $shippingAddress, $method){
        $this->user = $user;
        $this->shippingAddress = $shippingAddress;
        $this->shippingAddress->load('state');
        $this->method = $method;
        $this->countryId = $this->shippingAddress->state ? $this->shippingAddress->state->country->id : 1 ; // 1 <- méxico
    }
    public function render(){
        $countries = Country::orderBy('id', 'desc')->where('status', true)->cursor();
        $states = State::orderBy('id');
        if($this->countryId):
            $states = $states->where('country_id', $this->countryId);
        endif;
        $states = $states->cursor();
        return view('livewire.admin.user.shipping-address.form', compact('countries', 'states'));
    }
    public function store(){
        $this->validate();
        $this->validateAddressDefault();
        $this->user->shippingAddresses()->create($this->shippingAddress->toArray());
        $this->shippingAddress = new ShippingAddress();
        $this->emit('alert', 'success', 'Dirección agregada con éxito');
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->validateAddressDefault();
        $this->shippingAddress->update();
        $this->emit('alert', 'success', 'Dirección actualizada con éxito');
        $this->emit('render');
    }
    public function validateAddressDefault(){
        if(!count($this->user->shippingAddresses)){
            $this->shippingAddress->default = true;
        }else{
            if($this->shippingAddress->default){
                $this->user->shippingAddresses()->update([
                    'default' => false
                ]);                
            }
        }
    }
}

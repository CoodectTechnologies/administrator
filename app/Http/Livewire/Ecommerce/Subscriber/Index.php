<?php

namespace App\Http\Livewire\Ecommerce\Subscriber;

use App\Models\Subscriber;
use App\Models\User;
use App\Notifications\Admin\Susbcriber\SubscriberNew;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class Index extends Component
{
    public $email;

    public function render(){
        return view('livewire.ecommerce.subscriber.index');
    }
    public function store(){
        $this->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);
        $subscriber = Subscriber::create([
            'email' => $this->email,
        ]);
        Notification::send(
            User::permission(['subscriptores'])->get(),
            new SubscriberNew($subscriber)
        );
        $this->reset('email');
        session()->flash('alert-type', 'success');
        session()->flash('alert', 'Excelente, ahora estarás al tanto de cuando haya alguna oferta.');
    }
}

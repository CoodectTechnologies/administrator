<?php

namespace App\Http\Livewire\Admin\Setting\Currency;

use App\Models\Currency;
use Exception;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perPage = 50;
    public $search;
    protected $queryString = ['search' => ['except' => '']];
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['render'];

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render(){
        if(Cache::has('currency')):
            $currencies = Cache::get('currency');
        else:
            $currencies = Currency::orderBy('name')->get();
            Cache::put('currency', $currencies);
        endif;
        if($this->search):
            $currencies = $currencies->where('code', 'LIKE', "%{$this->search}%");
        endif;
        return view('livewire.admin.setting.currency.index', compact('currencies'));
    }
    public function destroy(Currency $currency){
        try{
            $currency->delete();
            $this->emit('alert', 'success', 'Eliminación con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', 'Ocurrio un error en la eliminación: '.$e->getMessage());
        }
    }
}

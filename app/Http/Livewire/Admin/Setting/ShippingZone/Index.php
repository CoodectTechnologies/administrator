<?php

namespace App\Http\Livewire\Admin\Setting\ShippingZone;

use App\Models\ShippingZone;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
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
    public $shippingPriceDefault;

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render(){
        $this->shippingPriceDefault = config('shipping.price_default');
        $shippingZones = ShippingZone::query()->with(['states', 'shippingClasses'])->orderBy('id', 'desc');
        if($this->search){
            $shippingZones = $shippingZones->where('name', 'LIKE', "%{$this->search}%")
            ->orWhereRelation('states', 'name', 'LIKE', "%{$this->search}%");
        }        
        $shippingZones = $shippingZones->paginate($this->perPage);  
        return view('livewire.admin.setting.shipping-zone.index', compact('shippingZones'));
    }
    public function destroy(ShippingZone $shippingZone){
        try{
            $shippingZone->delete();
            $this->emit('alert', 'success', 'Eliminación con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', 'Ocurrio un error en la eliminación: '.$e->getMessage());
        }
    }
    public function updateShippingPriceDefault(){
        $this->validate([
            'shippingPriceDefault' => 'required|numeric',
        ]);
        DotenvEditor::setKey('SHIPPING_PRICE_DEFAULT', $this->shippingPriceDefault)->save();
        DotenvEditor::deleteBackups();
        if (file_exists(App::getCachedConfigPath())) {
            Artisan::call("config:cache");
        }
        $this->emit('alert', 'success', 'Precio por default cambiado con éxito');
        $this->emit('render');
    }
}

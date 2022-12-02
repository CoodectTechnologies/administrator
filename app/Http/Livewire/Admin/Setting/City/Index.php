<?php

namespace App\Http\Livewire\Admin\Setting\City;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perPage = 100;
    public $search;
    protected $queryString = ['search' => ['except' => '']];
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['render'];
    public $filterCountry;
    public $filterState;

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render(){
        $countries = Country::orderBy('name')->cursor();
        $states = $this->getStates();
        $cities = $this->getCities();
        return view('livewire.admin.setting.city.index', compact('cities', 'states', 'countries'));
    }
    private function getStates(){
        $states = [];
        if($this->filterCountry):
            $states = State::where('country_id', $this->filterCountry)->orderBy('id', 'desc')->cursor();
        endif;
        return $states;
    }
    private function getCities(){
        $cities = City::with(['state', 'country'])->orderBy('id', 'desc');
        if($this->filterCountry):
            $cities = $cities->whereRelation('country', 'countries.id', $this->filterCountry);
        endif;
        if($this->filterState):
            $cities = $cities->where('state_id', $this->filterState);
        endif;
        if($this->search):
            $cities = $cities->where('name', 'LIKE', "%{$this->search}%");
        endif;
        $cities = $cities->paginate($this->perPage);
        return $cities;
    }
    public function destroy(City $city){
        try{
            $city->delete();
            $this->emit('alert', 'success', 'Eliminación con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', 'Ocurrio un error en la eliminación: '.$e->getMessage());
        }
    }
}

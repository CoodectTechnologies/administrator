<?php

namespace App\Http\Livewire\Admin\Setting\State;

use App\Models\Country;
use App\Models\State;
use Exception;
use Illuminate\Support\Facades\Cache;
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

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render(){
        $states = $this->states();
        $countries = Country::orderBy('id', 'desc')->cursor();
        return view('livewire.admin.setting.state.index', compact('states', 'countries'));
    }
    private function states(){
        $states = State::query()->with('country')->orderBy('id', 'desc');
        if($this->search):
            $states = $states->where('name', 'LIKE', "%{$this->search}%")
            ->orWhereRelation('country', 'name', 'LIKE', "%{$this->search}%");
        endif;
        if($this->filterCountry):
            $states = $states->where('country_id', $this->filterCountry);
        endif;
        return $states->paginate($this->perPage);
    }
    public function destroy(State $state){
        try{
            $state->delete();
            $this->emit('alert', 'success', 'Eliminación con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', 'Ocurrio un error en la eliminación: '.$e->getMessage());
        }
    }
}

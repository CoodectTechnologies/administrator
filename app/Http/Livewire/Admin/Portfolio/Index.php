<?php

namespace App\Http\Livewire\Admin\Portfolio;

use App\Models\Portfolio;
use Exception;
use Illuminate\Support\Facades\Storage;
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
        $portfolio = Portfolio::with(['service'])->orderBy('id', 'desc');
        if($this->search):
            $portfolio = $portfolio->where('name', 'LIKE', "%{$this->search}%");
        endif;
        $portfolio = $portfolio->paginate($this->perPage);
        return view('livewire.admin.portfolio.index', compact('portfolio'));
    }   
    public function destroy(Portfolio $project){
        try{
            if($project->image):
                if(Storage::exists($project->image->url)):
                    Storage::delete($project->image->url);
                endif;
                $project->image()->delete();
            endif;
            $project->delete();
            $this->emit('alert', 'success', 'Eliminación con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', 'Ocurrio un error en la eliminación: '.$e->getMessage());
        }
    }
}

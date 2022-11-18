<?php

namespace App\Http\Livewire\Admin\Catalog\Category;

use App\Models\ProductCategory;
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
    public $categoryFhaterFilter;

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render(){
        $categoriesFather = ProductCategory::query()->whereNull('parent_id')->orderBy('id', 'desc')->cursor();

        $categories = ProductCategory::query()->with(['products', 'allChildrens'])->orderBy('id', 'desc');
        if($this->search):
            $categories = $categories->where('name', 'LIKE', "%{$this->search}%");
        endif;
        if($this->categoryFhaterFilter):
            $categories = $categories->allChildrens($this->categoryFhaterFilter);
        endif;
        $categories = $categories->paginate($this->perPage);

        return view('livewire.admin.catalog.category.index', compact('categories', 'categoriesFather'));
    }
    public function destroy(ProductCategory $category){
        try{
            if($category->image):
                if(Storage::exists($category->image->url)):
                    Storage::delete($category->image->url);
                endif;
                $category->image()->delete();
            endif;
            $category->delete();
            $this->emit('alert', 'success', 'Eliminación con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', 'Ocurrio un error en la eliminación: '.$e->getMessage());
        }
    }
}

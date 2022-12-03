<?php

namespace App\Http\Livewire\Admin\Catalog\Product\Product;

use App\Exports\Admin\Product\ProductExport;
use App\Imports\Admin\Product\ProductImport;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $perPage = 50;
    public $search;
    public $statusFilter;
    public $excelImportTmp, $fileTmpInputId;
    protected $queryString = ['search' => ['except' => '']];
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['render'];

    public function mount(){
        $this->loadRandomFileTmpInputId();
    }
    public function updatingSearch(){
        $this->resetPage();
    }
    public function render(){
        $products = Product::query()->with(['comments', 'image', 'images', 'productCategories'])->orderBy('id', 'desc');
        if($this->search):
            $products = $products->where('name', 'LIKE', "%{$this->search}%");
        endif;
        if($this->statusFilter):
            $products = $products->where('status', $this->statusFilter);
        endif;
        $products = $products->paginate($this->perPage);
        return view('livewire.admin.catalog.product.product.index', compact('products'));
    }
    public function destroy(Product $product){
        try{
            if($product->image):
                if(Storage::exists($product->image->url)):
                    Storage::delete($product->image->url);
                endif;
                $product->image()->delete();
            endif;
            if(count($product->images)):
                foreach($product->images as $img):
                    $img->delete();
                endforeach;
            endif;
            $product->delete();
            $this->emit('alert', 'success', 'Eliminación con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', 'Ocurrio un error en la eliminación: '.$e->getMessage());
        }
    }
    public function exportProducts(){
        $name = 'products-'.date('Y-m').'.xlsx';
        return Excel::download(new ProductExport, $name);
    }
    public function importProducts(){
        $this->validate(['excelImportTmp' => 'required']);
        try{
            Excel::import(new ProductImport, $this->excelImportTmp);
            $this->loadRandomFileTmpInputId();
            $this->reset('excelImportTmp');
            $this->emit('alert', 'success', 'Productos creados con éxito');
            $this->emit('render');
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
    protected function loadRandomFileTmpInputId(){
        $this->fileTmpInputId = rand(1, 1000);
    }
}

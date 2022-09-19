<?php

namespace App\Http\Livewire\Admin\Portfolio;

use App\Models\Image;
use App\Models\Portfolio;
use App\Models\Service;
use Exception;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $method;
    public $project;
    public $imageTmp, $imagesTmp = [], $imagesTmpInputId;

    protected $listeners = ['render'];

    public function mount(Portfolio $project, $method){
        $this->project = $project;
        $this->method = $method;
        $this->loadRandomImagesTmpInputId();
    }
    protected function rules(){
        return [
            'project.service_id' => 'nullable|exists:services,id',
            'project.name' => 'required|unique:portfolios,name,'.$this->project->id,
            'project.client' => 'nullable',
            'project.fragment' => 'required',
            'project.body' => 'required',
            'project.link' => 'nullable|url',
            'project.date' => 'nullable|date',
            'project.meta_title' => 'nullable',
            'project.meta_description' => 'nullable',
            'project.meta_keywords' => 'nullable',
            'imageTmp' => $this->project->image ? 'image|nullable' : 'image|required',
        ];
    }
    public function render(){
        $services = Service::orderBy('id', 'desc')->cursor();
        $projectImages = $this->project->images()->orderBy('id', 'desc')->get();
        return view('livewire.admin.portfolio.form', compact('services', 'projectImages'));
    }
    public function store(){
        $this->validate();
        $this->project->save();
        $this->saveImage();
        $this->saveImages();
        session()->flash('alert', 'Proyecto agregado con éxito');
        session()->flash('alert-type', 'success');
        return redirect()->route('admin.portfolio.show', $this->project);
    }
    public function update(){
        $this->validate();
        $this->project->update();
        $this->saveImage();
        $this->saveImages();
        session()->flash('alert', 'Proyecto actualizado con éxito');
        session()->flash('alert-type', 'success');
        return redirect()->route('admin.portfolio.show', $this->project);
    }
    protected function loadRandomImagesTmpInputId(){
        $this->imagesTmpInputId = rand(1, 1000).'-'.$this->project->id;
    }
    public function saveImage(){
        if($this->imageTmp):
            $url = $this->imageTmp->store('public/portfolio');
            imageManager($url, 900, $this->project);
        endif;
    }
    protected function saveImages(){
        if($this->imagesTmp):
            foreach ($this->imagesTmp as $imgTmp):
                $url = $imgTmp->store('public/portfolio');
                imagesManager($url, 600, $this->project);
            endforeach;
        endif;
    }
    public function removeImageTemp($key){
        if(array_splice($this->imagesTmp, $key, 1)):
            $this->emit('alert', 'success', 'Imagen eliminada con éxito');
        endif;
    }
    public function removeImageMain(){
        if($this->project->image):
            if(Storage::exists($this->project->image->url)):
                Storage::delete($this->project->image->url);
            endif;
            $this->project->image()->delete();
            $this->project->image = null;
        endif;
        $this->reset('imageTmp');
        $this->emit('alert', 'success', 'Imagen eliminada con éxito');
    }
    public function removeImage(Image $image){
        try{
            $image->delete();
            $this->emit('alert', 'success', 'Imagen eliminada con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'warning', $e->getMessage());
        }
    }
}

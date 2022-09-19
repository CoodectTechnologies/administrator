<?php

namespace App\Http\Livewire\Admin\Catalog\Product\General;

use App\Models\Comment as ModelsComment;
use Livewire\Component;

class Comment extends Component
{
    public $comment;

    public function mount(ModelsComment $comment){
        $this->comment = $comment;
    }
    public function render(){
        return view('livewire.admin.catalog.product.general.comment');
    }
    public function refused(){
        $this->comment->approved = false;
        $this->comment->update();
        $this->emit('alert', 'success', 'Comentario rechazado con éxito');
    }
    public function approved(){
        $this->comment->approved = true;
        $this->comment->update();
        $this->emit('alert', 'success', 'Comentario aprobado con éxito');
    }
    public function destroy(){
        $this->comment->delete();
        $this->emit('render');
        $this->emit('alert', 'success', 'Comentario eliminado con éxito');
    }
}

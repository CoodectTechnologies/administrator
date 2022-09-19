<?php

namespace App\Http\Livewire\Admin\QuestionAnswer;

use App\Models\QuestionAnswer;
use Exception;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public function render(){
        if(Cache::has('questionAnswers')):
            $questionAnswers = Cache::get('questionAnswers');
        else:
            $questionAnswers = QuestionAnswer::orderBy('id', 'desc')->get();
            Cache::put('questionAnswers', $questionAnswers);
        endif;
        return view('livewire.admin.question-answer.index', compact('questionAnswers'));
    }
    public function destroy(QuestionAnswer $questionAnswer){
        try{
            $questionAnswer->delete();
            Cache::forget('questionAnswers');
            $this->emit('alert', 'success', 'Eliminación con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', 'Ocurrio un error en la eliminación: '.$e->getMessage());
        }
    }
}

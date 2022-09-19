<?php

namespace App\Http\Livewire\Admin\Setting\Role;

use Exception;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    protected $listeners = ['render'];

    public function render(){
        $roles = Role::with('permissions')->orderBy('id', 'desc')->cursor();
        return view('livewire.admin.setting.role.index', compact('roles'));
    }
    public function destroy(Role $role){
        try{
            $role->delete();
            $this->emit('alert', 'success', 'Eliminación con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', 'Ocurrio un error en la eliminación: '.$e->getMessage());
        }
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class Main extends Component
{
    public $welcome = "Bienvenido a tus tareas"; /* La uso en la vista main.blade.php */


    #[On('taskSaved')]
    public function taskSaved($message)
    {
        session()->flash('message', $message);
    }

    public function render()
    {
        return view('livewire.main');
    }
}

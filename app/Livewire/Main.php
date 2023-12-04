<?php

namespace App\Livewire;

use Livewire\Component;

class Main extends Component
{
    public $welcome = "Bienvenido a tus tareas"; /* La uso en la vista main.blade.php */

    public function render()
    {
        return view('livewire.main');
    }
}

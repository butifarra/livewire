<?php

namespace App\Livewire;

use App\Models\Task as TaskModel;
use Livewire\Component;
use Livewire\Attributes\Rule;

class Task extends Component
{
    public $tasks;
    public $task;


    /* #[Rule(['required', 'max:20'])] public TaskModel $tarea; */
    #[Rule(['required', 'max:20'])] public $tarea;

    public function mount()
    {
        $this->tasks = TaskModel::orderBy('id', 'desc')->get();
        $this->tarea = "";
        $this->task = new TaskModel();
    }
    public function updatedTarea() //Esto se ejecuta cada vez que se actualiza la variable tarea, cada vez que se tipea
    {
        /* $this->validate(['tarea' => 'required|max:20']); */
        $this->validate(['tarea' => 'max:20']);
    }
    public function save()
    {
        /*    dd($this->task); */
        $this->validate();
        $this->task->text = $this->tarea;
        $this->task->save();
        /* dd($this->tarea); */
        /* $this->task = new TaskModel(); //Limpio la tarea para que luego de guardar se borre la caja de texto */
        $this->mount(); //llamo a mount que en un paso resetea la variable y recarga la lista
        //Vamos a usar eventos
        $this->dispatch('taskSaved', 'Tarea guardada'); //Envía el evento al componente padre, y el padre lo escucha con protected $listeners

    }
    public function render()
    {
        return view('livewire.task');
    }
}

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

    public function edit(TaskModel $task)
    {
        $this->task = $task; //asingo la task recibida a la task de mi clase que instancié en mount
        //Al asignar la propiedad automáticamente aparecen los datos en la caja ded texto porque ya está
        //enlazada. Como yo no usé el modelo del curso, agrego esto para que eso pase:
        $this->tarea = $task->text;
    }

    public function done(TaskModel $task)
    {
        $task->update(['done' => !$task->done]); //Acá pone lo contrario de lo que tiene, porque es boolean
        $this->mount(); //Hago mount porque no me molesta que reinicie la $task
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

    public function delete($id)
    {
        $task1 = TaskModel::find($id);
        //También podría ser: $task1 = TaskModel::find($id)->delete;
        if (!is_null($task1)) {
            $task1->delete();
        }
        $this->dispatch('taskSaved', 'Tarea eliminada');
        $this->mount();
    }

    public function render()

    {
        return view('livewire.task');
    }
}

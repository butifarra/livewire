<?php

namespace App\Livewire;

use App\Models\Task as TaskModel;
use Livewire\Component;
use Livewire\Attributes\Rule;

class Task extends Component
{
    public $tasks;


    /* #[Rule(['required', 'max:20'])] public TaskModel $tarea; */
    #[Rule(['required', 'max:20'])] public $tarea;

    public function mount()
    {
        $this->tasks = TaskModel::get();
        /* $this->task = new TaskModel(); */
    }
    public function save()
    {
        /*    dd($this->task); */
        dd($this->tarea);
    }
    public function render()
    {
        return view('livewire.task');
    }
}

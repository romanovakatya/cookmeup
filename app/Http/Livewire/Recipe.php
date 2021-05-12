<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Recipe extends Component
{
    public function render()
    {
        return view('livewire.recipe')
            ->extends('layouts.guest');
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class Photo extends Component
{
    use WithFileUploads;

    public $photo;

    //guardamos en BBDD el nombre de foto como el identificador único,
    //la sacamos luego por la sessión,
    public function save()
    {
        /*$this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);*/

        $name = md5($this->photo . microtime()).'.'.$this->photo->extension();

        $this->photo->storePubliclyAs('photos', $name);

        $photo = new \App\Models\Photo();
        $photo->session_id = request()->session()->getId();
        $photo->code =$name;
        $photo->save();

        //getting to next page with ingredients:

        $this->redirect('ingredients');
    }

    public function render()
    {
        return view('livewire.photo')
            ->extends('layouts.guest');
    }
}


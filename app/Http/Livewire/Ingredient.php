<?php

namespace App\Http\Livewire;

use App\Google\Vision\Client;
use Livewire\Component;

class Ingredient extends Component
{
    public $ingredients;
    public $newIngredient;
    public $ingredient;
    public $photo;

    //especificamos que el campo añadir un ingrediente no puede ser vacio,
    protected $rules = [
        'newIngredient' => ['required']
    ];

    protected $messages = [
        'newIngredient.required' => 'You have not written any new ingredients'
    ];

    /**
     * @throws \Google\ApiCore\ValidationException
     */
    //mount funciona como constructor, se ejecuta una vez antes de hacer render,
    public function mount()
    {
        //foto se guarda solo despues de pusal el botón detect ingredients,
        $this->photo = \App\Models\Session::find(request()->session()->getId())->photos()->latest()->first();
        //sacamos los ingredientes que ha detectado API Vision,
        $this->ingredients = Client::getIngredients($this->photo);

    }

    //función para añadir un ingrediente nuevo si falta algo,
    public function addIngredient()
    {
         $this->validate();

        if (!in_array(strtoupper($this->newIngredient), $this->ingredients)){
            array_push($this->ingredients, strtoupper($this->newIngredient));
        }
        $this->reset('newIngredient');
    }

    //función para eliminar un ingrediente en el caso si API ha detectado lo que no queremos cocinar,
    public function deleteIngredient($id)
    {
        foreach ($this->ingredients as $key => $ingredient) {
            if ($key == $id) {
                unset($this->ingredients[$key]);
                $this->ingredients = array_values($this->ingredients);
            }
        }
    }

    //el botón Make foto,
    public function backToPhoto()
    {
        $this->redirect('/');

    }

    //función que guarda en BBDD lista final de los ingredientes,
    //y redirecciona a la página con recetas,
    public function cookmeup()
    {
       foreach ($this->ingredients as $value){

            $ingredient = new \App\Models\Ingredient();
            $ingredient->photo_id = $this->photo->id;
            $ingredient->name =$value;
            $ingredient->save();
        }
       $this->redirect('recipes');
    }

    public function render()
    {
        //dd(Client::getIngredients($this->photo));
        // dd($this->ingredients);
        return view('livewire.ingredient')
            ->extends('layouts.guest');
    }
}

<?php

namespace App\Http\Livewire;

use App\Google\Vision\Client;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithPagination;

class Ingredient extends Component
{
    use WithPagination;

    public $ingredients;
    public $newIngredient;
    public $ingredient;
    public $photo;

    protected $rules = [
        'newIngredient' => 'required'
    ];

    protected $messages = [
        'newIngredient.required' => 'You have not written any new ingredients',
    ];

    /**
     * @throws \Google\ApiCore\ValidationException
     */
    public function mount()
    {
        $this->photo = \App\Models\Session::find(request()->session()->getId())->photos()->latest()->first();
        $this->ingredients = Client::getIngredients($this->photo);
    }

    public function addIngredient()
    {
        $this->validate();
        //array_push($this->ingredients, $this->newIngredient);
        $this->ingredients = Arr::add($this->ingredients, strtoupper($this->newIngredient), strtoupper($this->newIngredient));
        $this->reset('newIngredient');
    }

    public function deleteIngredient()
    {
        //dd($this->ingredient);
        $this->ingredients = Arr::except($this->ingredients, $this->ingredient);
        //unset($this->ingredients, $oldIngredient);
        // dd($this->ingredients);
    }

    public function backToPhoto()
    {
        $this->redirect('/');
        //return redirect('/');
    }

    public function cookmeup()
    {
        $this->redirect('/recipes');
        //return redirect('/');
    }

    public function hydrate()
    {
        foreach ($this->ingredients as $ingredient) {
            $this->ingredient = $ingredient;
        }
    }

    public function dehydrate()
    {

    }

    public function render()
    {
        //paginate no funciona
        //$collection = collect($this->ingredients);
        //dd(Client::getIngredients($this->photo));
        // dd($this->ingredients);
        return view('livewire.ingredient',
            [
                //'photo' => \App\Models\Session::find(request()->session()->getId())->photos()->latest()->first(),
                // $this->ingredients =  $this->setIngredients(),
                //'ingredients' => $collection->paginate(2),
            ])
            ->extends('layouts.guest');
    }
}

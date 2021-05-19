<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ShowRecipe extends Component
{
    public $idRecipe;
    public $recipe = [];

    public function mount($idRecipe)
    {
        $this->idRecipe = $idRecipe;
        $this->recipe = $this->getRecipeData();
    }

    //función que recibe datos de una receta por su Id,
    protected function getRecipeData()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->get('https://api.spoonacular.com/recipes/' . $this->idRecipe . '/information?', [
            'apiKey' => config('services.spoonacular.api_key')
        ]);

        //dd($response->json());
        return $response->json();
    }

    //botón make photo,
    public function backToPhoto()
    {
        $this->redirect('/');
    }

    //botón para volverse a las recetas,
    public function showAllRecipes(){
        $this->redirect('/recipes');
    }

    public function render()
    {
        //dd($this->idRecipe);
        return view('livewire.show-recipe')
            ->extends('layouts.guest');
    }
}

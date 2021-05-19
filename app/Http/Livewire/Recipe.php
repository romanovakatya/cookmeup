<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Recipe extends Component
{
    public $arrayIngredients;
    public $photo;
    public $stringIngredientsNames;
    private $arrayIngredientsNames = [];

    public $recipes = [];

    public function mount()
    {
        // por la sessión sacamos datos de última foto (que es nuestra),
        $this->photo = \App\Models\Session::find(request()->session()->getId())->photos()->latest()->first();
        //por id de photo sacamos de BBDD datos de todos ingredientes,
        $this->arrayIngredients = \App\Models\Ingredient::all()->where('photo_id', $this->photo->id);

        //en un array guardamos solo nombres de ingredientes,
        //para utilizarlos luego en petición hasta la API de recetas,
        foreach ($this->arrayIngredients as $ingredient) {
            array_push($this->arrayIngredientsNames, $ingredient->name);
        }

        //convierto array  con nombres de ingredientes en un String,
        $this->stringIngredientsNames = implode(',', $this->arrayIngredientsNames);

        $this->filterRecipesData();
    }

    //enviamos ingredientes a la API y recibimos respuesta en el formato json,
    protected function getAllRecipesData()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->get('https://api.spoonacular.com/recipes/findByIngredients?', [
            'apiKey' => config('services.spoonacular.api_key'),
            'ingredients' => $this->stringIngredientsNames
        ]);

        //dd($response->json());
        return $response->json();
    }

    //filtramos datos recibidos desde api para evitar duplicaciones,
    protected function filterRecipesData()
    {
        $recipesData = $this->getAllRecipesData();

        foreach ($recipesData as $key => $value) {
            $this->recipes[$key] = [];
            $this->recipes[$key]['id'] = $value['id'];
            $this->recipes[$key]['title'] = $value['title'];
            $this->recipes[$key]['image'] = $value['image'];
            $this->recipes[$key]['missedIngredients'] = [];
            $this->recipes[$key]['usedIngredients'] = [];

            foreach ($value['usedIngredients'] as $keyIngredient => $arrayUsedIngredients) {
                if (!in_array($arrayUsedIngredients['name'], $this->recipes[$key]['usedIngredients'])) {

                    $plural = substr($arrayUsedIngredients['name'], 0, strlen($arrayUsedIngredients['name']) - 1);
                    if (!in_array($plural, $this->recipes[$key]['usedIngredients'])) {

                        array_push($this->recipes[$key]['usedIngredients'], $arrayUsedIngredients['name']);
                    }
                }
            }

            foreach ($value['missedIngredients'] as $keyIngredient => $arrayMissedIngredients) {
                if (!in_array($arrayMissedIngredients['name'], $this->recipes[$key]['missedIngredients'])) {

                    $plural = substr($arrayMissedIngredients['name'], 0, strlen($arrayMissedIngredients['name']) - 1);
                    if (!in_array($plural, $this->recipes[$key]['missedIngredients'])) {

                        array_push($this->recipes[$key]['missedIngredients'], $arrayMissedIngredients['name']);
                    }
                }
            }
            //se ven bien en la pantalla solo 6 ingredientes,
            if (count($this->recipes[$key]['usedIngredients']) > 3) {
                $this->recipes[$key]['usedIngredients'] = array_slice($this->recipes[$key]['usedIngredients'], 0, 3);
            }

            $lengthMissedIngredients = 6 - count($this->recipes[$key]['usedIngredients']);

            if (count($this->recipes[$key]['missedIngredients']) > $lengthMissedIngredients) {
                $this->recipes[$key]['missedIngredients'] = array_slice($this->recipes[$key]['missedIngredients'], 0, $lengthMissedIngredients);
            }
        }
    }

    //función que muestra una reseta elegida,
    public function show($idRecipe)
    {
        $this->redirect('recipe/'. $idRecipe);
    }

    //botón Make photo
    public function backToPhoto()
    {
        $this->redirect('/');
        //return redirect('/');
    }

    public function render()
    {
        return view('livewire.recipe')
            ->extends('layouts.guest');
    }
}

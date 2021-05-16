<?php

namespace App\Http\Livewire;

use Illuminate\Support\Arr;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Recipe extends Component
{

    public $arrayIngredients;
    public $photo;
    private $arrayIngredientsNames = [];
    public $stringIngredientsNames;

    public $x;

    public $recipes = [
        /*     0 => [
                 'id' => '123455',
                 'title' => 'Apricot Glazed Apple Tart',
                 'img' => "https://spoonacular.com/recipeImages/632660-312x231.jpg",
                 'ingredients' => [
                     0 => 'cinnamon',
                     1 => 'butter',
                     2 => 'apricot preserves',
                     3 => 'red apples'
                 ]
             ],
             1 => [
                 'id' => '123455',
                 'title' => 'BEasy & Delish! ~ Apple Crumble',
                 'img' => "https://spoonacular.com/recipeImages/641803-312x231.jpg",
                 'ingredients' => [
                     0 => 'butter',
                     1 => 'cloves ground',
                     2 => 'lemon zest',
                     3 => 'apples'
                 ]
             ],
             2 => [
                 'id' => '123455',
                 'title' => 'Bocacha',
                 'img' => "https://tailwindcss.com/img/card-top.jpg",
                 'ingredients' => [
                     0 => 'milk',
                     1 => 'egg',
                     2 => 'flour',
                     3 => 'apples'
                 ]
             ],
             3 => [
                 'id' => '123455',
                 'title' => 'Apple Or Peach Strudel',
                 'img' => "https://spoonacular.com/recipeImages/73420-312x231.jpg",
                 'ingredients' => [
                     0 => 'baking powder',
                     1 => 'cinnamon',
                     2 => 'egg',
                     3 => 'apples'
                 ]
             ]*/
    ];

    public function mount()
    {
        $this->photo = \App\Models\Session::find(request()->session()->getId())->photos()->latest()->first();
        $this->arrayIngredients = \App\Models\Ingredient::all()->where('photo_id', $this->photo->id);

        foreach ($this->arrayIngredients as $ingredient) {
            array_push($this->arrayIngredientsNames, $ingredient->name);
        }

        $this->stringIngredientsNames = implode(',', $this->arrayIngredientsNames);

        //$this->arrayIngredientsNames = (object)$this->arrayIngredientsNames;

        //$this->recipes = $this->index();
        $this->filterRecipesData();

    }

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

    protected function filterRecipesData()
    {
        $recipesData = $this->getAllRecipesData();

        //dd($recipesData);
        foreach ($recipesData as $key => $value) {
            $this->recipes[$key] = [];
            $this->recipes[$key]['id'] = $value['id'];
            $this->recipes[$key]['title'] = $value['title'];
            $this->recipes[$key]['image'] = $value['image'];
            $this->recipes[$key]['missedIngredients'] = [];
            $this->recipes[$key]['usedIngredients'] = [];

           // $this->saveIngredients($value['usedIngredients'], $this->recipes[$key]['usedIngredients'], 3);

                foreach ($value['usedIngredients'] as $keyIngredient => $arrayUsedIngredients) {
                    if (!in_array($arrayUsedIngredients['name'], $this->recipes[$key]['usedIngredients'])) {

                        $plural = substr($arrayUsedIngredients['name'], 0, strlen($arrayUsedIngredients['name']) - 1);
                        if (!in_array($plural, $this->recipes[$key]['usedIngredients'])) {
                            // $this->recipes[$key]['usedIngredients'][$keyIngredient] = $arrayUsedIngredients['name'];
                            array_push($this->recipes[$key]['usedIngredients'], $arrayUsedIngredients['name']);
                        }
                    }
                }

            foreach ($value['missedIngredients'] as $keyIngredient => $arrayMissedIngredients) {
                if (!in_array($arrayMissedIngredients['name'], $this->recipes[$key]['missedIngredients'])) {

                    $plural = substr($arrayMissedIngredients['name'], 0, strlen($arrayMissedIngredients['name']) - 1);
                    if (!in_array($plural, $this->recipes[$key]['missedIngredients'])) {
                        //$this->recipes[$key]['missedIngredients'][$keyIngredient] = $arrayMissedIngredients['name'];
                        array_push($this->recipes[$key]['missedIngredients'], $arrayMissedIngredients['name']);
                    }
                }
            }
                if (count($this->recipes[$key]['usedIngredients']) > 3){
                    $this->recipes[$key]['usedIngredients'] = array_slice($this->recipes[$key]['usedIngredients'], 0, 3);
                }
            //se ven bien en ña pantalla solo 6 ingredientes,
            $lengthMissedIngredients = 6 - count($this->recipes[$key]['usedIngredients']);

            //$this->saveIngredients($value['missedIngredients'], $this->recipes[$key]['missedIngredients'], $lengthMissedIngredients);

            if (count($this->recipes[$key]['missedIngredients']) > $lengthMissedIngredients){
                $this->recipes[$key]['missedIngredients'] = array_slice($this->recipes[$key]['missedIngredients'], 0, $lengthMissedIngredients);
            }
        }
    }


    public function show($idRecipe)
    {

    }

    public function render()
    {

        /*dd($this->photo->id,
            $this->ingredientsNames);*/
        dd($this->recipes);

        //dd($this->ingredients);
        //dd($this->stringIngredientsNames);
        return view('livewire.recipe')
            ->extends('layouts.guest');
    }

    private function saveIngredients($arrayAPIIngredients, $arrayFinalIngredients, $length){
     //   if (count($arrayAPIIngredients) <= $length) {
            foreach ($arrayAPIIngredients as $key => $arrayIngredients) {
                if (!in_array($arrayIngredients['name'], $arrayFinalIngredients)) {

                    $plural = substr($arrayIngredients['name'], 0, strlen($arrayIngredients['name']) - 1);
                    if (!in_array($plural, $arrayFinalIngredients)) {
                        // $this->recipes[$key]['usedIngredients'][$keyIngredient] = $arrayUsedIngredients['name'];
                        array_push($arrayFinalIngredients, $arrayIngredients['name']);
                    }
                }
            }
    }
}

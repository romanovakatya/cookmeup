<?php

namespace App\Http\Livewire;

use Illuminate\Support\Arr;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Recipe extends Component
{
    public $arrayIngredients;
    public $photo;
    public $stringIngredientsNames;
    private $arrayIngredientsNames = [];

    public $recipes = [
        0 => [
            'id' => '632660',
            'title' => 'Apricot Glazed Apple Tart',
            'image' => "https://spoonacular.com/recipeImages/632660-312x231.jpg",
            'missedIngredients' => [
                0 => 'cinnamon',
                1 => 'butter',
                2 => 'apricot preserves',
            ],
            'usedIngredients' => [
                0 => 'apples',
                1 => 'eggs',
                2 => 'red apples'
            ]
        ],

        1 => [
            'id' => '123455',
            'title' => 'BEasy & Delish! ~ Apple Crumble',
            'image' => "https://spoonacular.com/recipeImages/641803-312x231.jpg",
            'missedIngredients' => [
                0 => 'butter',
                1 => 'cloves ground',
                2 => 'lemon zest'
            ],
            'usedIngredients' => [
                0 => 'apples',
                1 => 'vanilla extract',
                2 => 'baking soda'
            ]
        ],

        2 => [
            'id' => '55',
            'title' => 'Apple Cinnamon Blondies',
            'image' => "https://spoonacular.com/recipeImages/157103-312x231.jpg",
            'missedIngredients' => [
                0 => 'milk',
                1 => 'egg',
                2 => 'flour'
            ],
            'usedIngredients' => [
                0 => 'apples',
                1 => 'vanilla extract',
                2 => 'baking soda'
            ]
        ],
        3 => [
            'id' => '189',
            'title' => 'Apple Or Peach Strudel',
            'image' => "https://spoonacular.com/recipeImages/73420-312x231.jpg",
            'missedIngredients' => [
                0 => 'baking powder',
                1 => 'cinnamon',
                2 => 'egg'
            ],
            'usedIngredients' => [
                0 => 'apples',
                1 => 'vanilla extract',
                2 => 'milk'
            ]
        ],

        4 => [
            'id' => '345675',
            'title' => 'Easy Homemade Apple Fritters',
            'image' => "https://spoonacular.com/recipeImages/775666-312x231.jpg",
            'missedIngredients' => [
                0 => 'butter',
                1 => 'baking powder',
                2 => 'lemon zest'
            ],
            'usedIngredients' => [
                0 => 'apples',
                1 => 'vanilla extract',
                2 => 'baking soda'
            ]
        ],

        5 => [
            'id' => '670234',
            'title' => 'Baked Apple Pancake',
            'image' => "https://spoonacular.com/recipeImages/633428-312x231.jpg",
            'missedIngredients' => [
                0 => 'butter',
                1 => 'cloves ground',
                2 => 'nuts'
            ],
            'usedIngredients' => [
                0 => 'apples',
                1 => 'vanilla extract',
                2 => 'baking soda'
            ]
        ],

        6 => [
            'id' => '000000',
            'title' => 'Apple Cake',
            'image' => "https://spoonacular.com/recipeImages/632485-312x231.jpg",
            'missedIngredients' => [
                0 => 'butter',
                1 => 'cloves ground',
                2 => 'lemon zest'
            ],
            'usedIngredients' => [
                0 => 'apples',
                1 => 'vanilla extract',
                2 => 'baking soda'
            ]
        ],

        7 => [
            'id' => '224456',
            'title' => 'Flourless Apple Macadamia Cookies',
            'image' => "https://spoonacular.com/recipeImages/643119-312x231.jpg",
            'missedIngredients' => [
                0 => 'butter',
                1 => 'cloves ground',
                2 => 'lemon zest'
            ],
            'usedIngredients' => [
                0 => 'apples',
                1 => 'vanilla extract',
                2 => 'baking soda'
            ]
        ],

        8 => [
            'id' => '098674',
            'title' => 'BEasy & Delish! ~ Apple Crumble',
            'image' => "https://spoonacular.com/recipeImages/632463-312x231.jpg",
            'missedIngredients' => [
                0 => 'butter',
                1 => 'cloves ground',
                2 => 'lemon zest'
            ],
            'usedIngredients' => [
                0 => 'apples',
                1 => 'vanilla extract',
                2 => 'baking soda'
            ]
        ],

        9 => [
            'id' => '6102846',
            'title' => 'BEasy & Delish! ~ Apple Crumble',
            'image' => "https://spoonacular.com/recipeImages/632471-312x231.jpg",
            'missedIngredients' => [
                0 => 'butter',
                1 => 'cloves ground',
                2 => 'lemon zest'
            ],
            'usedIngredients' => [
                0 => 'apples',
                1 => 'vanilla extract',
                2 => 'baking soda'
            ]
        ]
    ];

    public function mount()
    {
        $this->photo = \App\Models\Session::find(request()->session()->getId())->photos()->latest()->first();
        $this->arrayIngredients = \App\Models\Ingredient::all()->where('photo_id', $this->photo->id);

        foreach ($this->arrayIngredients as $ingredient) {
            array_push($this->arrayIngredientsNames, $ingredient->name);
        }

        $this->stringIngredientsNames = implode(',', $this->arrayIngredientsNames);

        //$this->filterRecipesData();
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

            if (count($this->recipes[$key]['usedIngredients']) > 3) {
                $this->recipes[$key]['usedIngredients'] = array_slice($this->recipes[$key]['usedIngredients'], 0, 3);
            }
            //se ven bien en la pantalla solo 6 ingredientes,
            $lengthMissedIngredients = 6 - count($this->recipes[$key]['usedIngredients']);

            if (count($this->recipes[$key]['missedIngredients']) > $lengthMissedIngredients) {
                $this->recipes[$key]['missedIngredients'] = array_slice($this->recipes[$key]['missedIngredients'], 0, $lengthMissedIngredients);
            }
        }
    }

    public function show($idRecipe)
    {
        $this->redirect('recipe/'. $idRecipe);
    }

    public function render()
    {
        /*dd($this->photo->id,
            $this->ingredientsNames);*/
        //dd($this->recipes);

        //dd($this->ingredients);
        //dd($this->stringIngredientsNames);
        return view('livewire.recipe')
            ->extends('layouts.guest');
    }
}

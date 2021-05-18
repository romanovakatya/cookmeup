<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ShowRecipe extends Component
{
    public $idRecipe;
    public $recipe = [
        "title" => "Apricot Glazed Apple Tart",
        "image" => "https://spoonacular.com/recipeImages/632660-556x370.jpg",
        "extendedIngredients" => [
            0 => ["original" => "1 1/2 cups all-purpose flour, plus 1 tablespoon"],//original
            1 => ["original" => "Pinch of salt"],
            2 => ["original" => "1 1/2 sticks cold unsalted butter cold unsalted butter"],
            3 => ["original" => "cup ice water"],
            4 => ["original" => "3 1/2 tablespoons sugar"],
            5 => ["original" => "4 larges red apples, such as Golden Delicious, peeled, cored and cut into 1/4-inch-thick slices"],
            6 => ["original" => "2 teaspoons cinnamon"],
            7 => ["original" => "2 tablespoons apricot preserves, melted and strained"]
        ],
        "analyzedInstructions" =>
            [
                0 => [
                    "name" => "",
                    "steps" => [
                        0 => [
                            "number" => 1,
                            "step" => "In a food processor, pulse 1 1/2 cups of the flour with the salt."
                        ],
                        1 => [
                            "number" => 2,
                            "step" => "Add the cold butter and process just until the butter is the size of peas, about 5 seconds."
                        ],
                        2 => [
                            "number" => 3,
                            "step" => "Sprinkle the ice water over the mixture and process just until moistened, about 5 seconds."
                        ],
                        3 => [
                            "number" => 4,
                            "step" => "Transfer the dough to a lightly floured work surface and knead 2 or 3 times, just until it comes together.
                     Pat the dough into a disk. On a lightly floured work surface, roll out the dough into a 16- to 17-inch round about 1/4 inch thick."
                        ],
                        4 => [
                            "number" => 5,
                            "step" => "Line a large baking sheet with parchment paper."
                        ],
                        5 => [
                            "number" => 6,
                            "step" => "Roll the dough around the rolling pin and unroll it onto the prepared baking sheet."
                        ],
                        6 => [
                            "number" => 7,
                            "step" => "In a small bowl, combine 2 tablespoons of the sugar with the remaining 1 tablespoon of flour and sprinkle over the dough.
                    Arrange the apple slices on top in overlapping concentric circles to within 3 inches of the edge. Fold the dough over the apples in a free-form fashion.",
                        ],
                        7 => [
                            "number" => 8,
                            "step" => "Brush the apples with the melted butter and sprinkle with the remaining 1 1/2 tablespoons of sugar and cinnamon.
                    Refrigerate the unbaked tart until slightly chilled, about 10 minutes."
                        ],
                        8 => [
                            "number" => 9,
                            "step" => "Preheat the oven to 40"
                        ],
                        9 => [
                            "number" => 10,
                            "step" => "Bake the tart in the center of the oven for 1 hour, or until the apples are tender and golden and the crust is deep golden and cooked through.",
                        ],
                        10 => [
                            "number" => 11,
                            "step" => "Brush the apples with the melted preserves. Slide the parchment onto a wire rack and let the tart cool slightly before serving.",
                        ]
                    ]
                ]
            ]
    ];

    public function mount($idRecipe)
    {
        $this->idRecipe = $idRecipe;
        //$this->recipe = $this->getRecipeData();
    }

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

    public function backToPhoto()
    {
        $this->redirect('/');
    }

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

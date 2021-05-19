<?php

namespace App\Http\Livewire;

use App\Google\Vision\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Ingredient extends Component
{
  //  use WithPagination;

    public $ingredients;
    public $newIngredient;
    public $ingredient;
    public $photo;

    protected $rules = [
        'newIngredient' => ['required']
    ];

    protected $messages = [
        'newIngredient.required' => 'You have not written any new ingredients'
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

       /* $validatedIngredient = Validator::make(
            ['newIngredient' => $this->newIngredient],
            ['required' => 'You have not written any new ingredients'],
            [ Rule::notIn($this->ingredients)],
        )->validate();
        array_push($this->ingredients, $validatedIngredient);
       */

        if (!in_array(strtoupper($this->newIngredient), $this->ingredients)){
            array_push($this->ingredients, strtoupper($this->newIngredient));
        }
        //$this->ingredients = Arr::add($this->ingredients, strtoupper($this->newIngredient), strtoupper($this->newIngredient));
        $this->reset('newIngredient');
    }

    public function deleteIngredient($id)
    {
        foreach ($this->ingredients as $key => $ingredient) {
            if ($key == $id) {
                unset($this->ingredients[$key]);
                $this->ingredients = array_values($this->ingredients);
            }
        }
        //$this->ingredients = Arr::except($this->ingredients, $ingredient);

        // dd($this->ingredients);
    }

    public function backToPhoto()
    {
        $this->redirect('/');
        //return redirect('/');
    }
   /* public function __get($property)
    {
        return parent::__get($property);
    }*/

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

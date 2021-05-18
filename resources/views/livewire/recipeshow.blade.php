<div class="h-screen w-full flex flex-nowrap md:flex-wrap lg:flex-row flex-col justify-center items-center"
     xmlns:livewire="http://www.w3.org/1999/html">
    @forelse ( $recipes as $key => $recipe )

        <div wire:key="{{ $recipe['id'] }}"
             class="max-w-md w-full lg:flex shadow-lg rounded border-1 border-solid border-grey-light bg-white m-2">
            <div
                class="h-48 lg:h-auto lg:w-48 flex-none rounded  bg-cover text-center overflow-hidden"
                style="background-image: url({{ $recipe['image'] }})" title="{{ $recipe['title'] }}">
            </div>
            <div
                class=" p-4 flex flex-col justify-between rounded leading-normal">
                <div>
                    <div class="text-black font-bold text-xl mb-2">{{$recipe['title']}}</div>
                </div>
                <div class="flex items-center">
                    <div class="text-xs">
                        @foreach( $recipe['missedIngredients'] as $key => $ingredient )
                            <p class="text-black leading-none">{{ $ingredient }}</p>
                        @endforeach
                        @foreach( $recipe['usedIngredients'] as $key => $ingredient )
                            <p class="text-grey-dark">{{ $ingredient }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p>No recipes</p>
    @endforelse

</div>

<!--show-recipe.blade-->
<div wire:model="recipe" class="md:max-w-screen-lg max-w-xs rounded overflow-hidden shadow-lg my-2 ">
    <div class="flex justify-center self-center">
        <div class="py-4 mr-3 ">
            <button type="submit" wire:click="showAllRecipes"
                    class="block tracking-widest uppercase text-center shadow bg-indigo-600 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">
                Back to Recipes
            </button>
        </div>
        <div class="py-4 ">
            <a
                wire:click="backToPhoto"
                href="#"
                class="block tracking-widest uppercase text-center shadow bg-indigo-600 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded"
            >
                Make new photo
            </a>
        </div>
    </div>
<!-- <div class="px-6 py-4"><img class="" src="{{--$recipe['image']--}}" alt="{{--$recipe['title']--}}"></div> -->
    <div class="w-auto h-96 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden"
         style="background-image: url({{$recipe['image']}})" title="{{$recipe['title']}}">
    </div>
    <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2">{{$recipe['title']}}</div>
        @foreach($recipe["analyzedInstructions"] as $key => $instructions)
            @foreach($instructions['steps'] as $key => $step)
                <p class="text-grey-darker lg:text-base text-sm">
                    {{$step['number']}}. {{$step['step']}}
                </p>
            @endforeach
        @endforeach
    </div>
    <div class="px-6 py-4">
        @foreach($recipe["extendedIngredients"] as $key => $value)
            <span
                class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2"> # {{ $value['original']}}</span>
        @endforeach
    </div>
</div>

 <!-- recipe.blade-->
<div class="h-screen w-full flex md:flex-wrap md:flex-row flex-col justify-center items-center"
     xmlns:livewire="http://www.w3.org/1999/html"><!-- flex-nowrap-->
    @forelse ( $recipes as $key => $recipe )
        <div wire:key="{{ $recipe['id'] }}" wire:click="show({{ $recipe['id'] }})" class="max-w-xs rounded shadow-lg my-2 mx-2"><!-- sm:max-w-xs max-w-min-->
            <div>
                <img src="{{ $recipe['image'] }}" alt="Recipe" class="rounded overflow-hidden" title="{{$recipe['title']}}">
            </div>
            <div class="py-2 text-center mx-1 "><!--lg:px-6 px-2 -->
                <div class="font-bold md:text-lg sm:text-base text-xs">{{$recipe['title']}}</div><!--mb-2 -->
                <p class="text-grey-darker text-base">
                </p>
            </div>
            <div class="flex space-x-1 text-center"> <!--lg:px-6 px-2  -->
                @foreach( $recipe['missedIngredients'] as $key => $ingredient )
                    <span
                        class="flex-1 bg-grey-lighter rounded-full py-1.5 text-xs font-semibold text-grey-darker ">{{ $ingredient }}</span>
                @endforeach

                @foreach( $recipe['usedIngredients'] as $key => $ingredient )
                    <span
                        class="flex-1 bg-grey-lighter rounded-full py-1.5 text-xs font-semibold text-grey-darker ">{{ $ingredient }}</span>
            @endforeach

            <!--  <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker">Ingrediente 1</span> -->
            </div>
        </div>
    @empty
        <p>No recipes</p>
    @endforelse

</div>


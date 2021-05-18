<div class="h-screen w-full flex flex-nowrap md:flex-wrap lg:flex-row flex-col justify-center items-center"
     xmlns:livewire="http://www.w3.org/1999/html">

    <div wire:model="recipe" class="md:max-w-screen-lg max-w-xs rounded overflow-hidden shadow-lg my-2 ">
        <div>
            <div class="text-black font-bold text-xl mb-2 ml-2">{{$recipe['title']}}</div>

            <div
                class="border-l-0 border-t border-grey-light bg-white rounded-b rounded-b-none rounded-r flex flex-col justify-between leading-normal">

                <div class="flex items-center">
                    <img class="max-w-xs " src="{{$recipe['image']}}" title="{{$recipe['title']}}"
                         alt="{{$recipe['title']}}">
                    <div class="text-sm">
                        @foreach($recipe["extendedIngredients"] as $key => $value)
                            <p class="text-black leading-none"> # {{ $value['original']}}</p>
                        @endforeach
                    </div>
                </div>

                <div>
                    @foreach($recipe["analyzedInstructions"] as $key => $instructions)
                        @foreach($instructions['steps'] as $key => $step)
                            <p class="text-grey-darker lg:text-base text-sm">
                                {{$step['number']}}. {{$step['step']}}
                            </p>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
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
    <!--  <div class="justify-center self-center">

      </div>-->
</div>

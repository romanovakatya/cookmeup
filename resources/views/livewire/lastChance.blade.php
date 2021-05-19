<style>
    .w-70 {
        width: 20rem;
    }
</style>
<div class="h-screen w-full flex flex-nowrap md:flex-wrap lg:flex-row flex-col justify-center items-center font-mono"
     xmlns:livewire="http://www.w3.org/1999/html">

    <div wire:model="recipe" class="md:max-w-screen-lg max-w-xs rounded overflow-hidden shadow-lg my-2 ">
        <div>
            <div
                class="flex justify-start cursor-pointer shadow-md bg-indigo-500 hover:bg-indigo-700 text-white focus:shadow-outline focus:outline-none font-bold rounded-md px-1 py-1 my-2 text-xl">
                <div class="flex-grow font-medium font-bold px-2 py-3 hover:bg-indigo-700">  {{$recipe['title']}}</div>
            </div>
            <div
                class="border-l-0 border-t border-grey-light bg-white rounded-b rounded-b-none rounded-r flex flex-col justify-between leading-normal">

                <div class="flex items-center">
                    <div class="p-4 md:w-1/3 md:mb-0 mb-6 flex flex-col justify-center items-center max-w-sm mx-auto">
                        <div class="bg-gray-300 h-56 w-full rounded-lg shadow-md bg-cover bg-center"
                             style="background-image: url('{{$recipe['image']}}')"></div>
                    </div>
                    <div class="text-xs">
                        @foreach($recipe["extendedIngredients"] as $key => $value)
                            <div
                                class="flex justify-start cursor-pointer shadow-md bg-white hover:bg-indigo-700 hover:text-white focus:shadow-outline focus:outline-none text-indigo-600 font-bold rounded-md px-1 py-1 my-2 text-xs">
                                <span class="bg-white h-2 w-2 m-2 mt-4 rounded-full"></span>
                                <div
                                    class="flex-grow font-medium font-bold px-2 py-3 hover:bg-indigo-700">  {{ $value['original']}}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    @foreach($recipe["analyzedInstructions"] as $key => $instructions)

                        @foreach($instructions['steps'] as $key => $step)
                            <div
                                class="flex justify-start cursor-pointer shadow-md bg-white focus:shadow-outline focus:outline-none text-indigo-600 font-bold rounded-md px-1 py-1 my-2 text-xs">
                                <span class="bg-indigo-600 h-2 w-2 m-2 mt-4 rounded-full"></span>
                                <div
                                    class="flex-grow font-medium font-bold px-2 py-3 ">  {{$step['number']}}. {{$step['step']}}</div>
                            </div>

                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <section class="blog text-gray-700 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap w-full mb-20 flex-col items-center text-center">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900"> {{$recipe['title']}}</h1>
                <div class="title-post font-medium">Ingredients</div>
                <p class="lg:w-1/2 w-full leading-relaxed text-base">
                    @foreach($recipe["extendedIngredients"] as $key => $value)
                        # {{ $value['original']}}
                    @endforeach
                </p>
            </div>
            <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">
                <div class="p-4 md:w-1/3 md:mb-0 mb-6 flex flex-col justify-center items-center max-w-sm mx-auto">
                    <div class="bg-gray-300 h-56 w-full rounded-lg shadow-md bg-cover bg-center"
                         style="background-image: url('{{$recipe['image']}}')"></div>

                    <div class=" w-70 bg-white -mt-10 shadow-lg rounded-lg overflow-hidden p-5">

                        <div class="header-content inline-flex ">
                            <div class="category-badge flex-1  h-4 w-4 m rounded-full m-1 bg-purple-100">
                                <div class="h-2 w-2 rounded-full m-1 bg-indigo-500 "></div>
                            </div>
                            <div class="category-title flex-1 text-base"> Instructions</div>
                        </div>


                        <div class="summary-post text-sm text-justify">
                            @foreach($recipe["analyzedInstructions"] as $key => $instructions)
                                @foreach($instructions['steps'] as $key => $step)
                                    <p class="text-grey-darker lg:text-base text-sm">
                                        {{$step['number']}}. {{$step['step']}}
                                    </p>
                                @endforeach
                            @endforeach
                            <button class="bg-blue-100 text-blue-500 mt-4 block rounded p-2 text-sm "><span class="">Lire plus</span>
                            </button>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
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


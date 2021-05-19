<div class="h-screen w-full justify-center items-center font-mono"
     xmlns:livewire="http://www.w3.org/1999/html">

    <div class="bg-white">
        <nav class="border-b">
            <div class="container px-6 py-2 mx-auto md:flex md:justify-between md:items-center">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xl text-gray-800 font-semiblod md:text-3xl hover:text-gray-700">
                            {{$recipe['title']}}
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container px-6 mx-auto">

            <div class="flex flex-col sm:space-y-6 md:flex-row md:items-center md:space-x-6">
                <div class="flex items-center justify-center w-full md:w-1/2">
                    <img src="{{$recipe['image']}}"
                         alt="{{$recipe['title']}}" class="w-full h-full max-w-2xl rounded"/>
                </div>

            </div>
            <div class="mx-auto"><!--max-w-md  -->
                <div class="mt-5 leading-2 text-gray-600">
                    @foreach($recipe["analyzedInstructions"] as $key => $instructions)
                        @foreach($instructions['steps'] as $key => $step)
                            {{$step['number']}}. {{$step['step']}}. <br/>

                            <div class="max-w-lg">
                                <div class="grid gap-6 mt-2 sm:grid-cols-2">
                                    @foreach($step['ingredients'] as $key => $ingredient)
                                        <div class="flex items-center space-x-6 text-gray-800 text-xs">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M5 13l4 4L19 7"></path>
                                            </svg>

                                            <span> {{$ingredient['name']}}</span></div>
                                    @endforeach

                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container px-6 mx-auto">
            <div class="flex justify-center self-center sm:mt-5 space-x-6">
                <div class="py-4">
                    <a href="#" wire:click="showAllRecipes"
                       class="block tracking-widest font-medium uppercase text-center shadow bg-indigo-600 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">
                        Back to Recipes
                    </a>
                </div>
                <div class="py-4">
                    <a href="#" wire:click="backToPhoto"
                       class="block tracking-widest uppercase text-center shadow bg-indigo-600 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded"
                    >
                        Make new photo
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

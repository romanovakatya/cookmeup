<div class="h-screen w-full flex flex-col justify-center items-center font-mono" xmlns:livewire="http://www.w3.org/1999/html">
    {{--print_r($photo->id)--}}
    <div class="flex justify-center self-center">
        <div class="flex w-full h-auto items-center justify-center bg-grey-lighter">
            <div class="max-w-md flex flex-col items-center px-3 py-4 bg-white rounded-md shadow-lg tracking-wide border border-blue ">
            <img src="{{ url('photos') . '/' . $photo->code }}" alt="Ingredients" class="w-auto rounded-md">
            </div>
        </div>
    </div>

    <div class="w-full max-w-screen-xl mx-auto px-6">
        <div class="flex justify-center p-4 px-3 py-10">
            <div class="w-full max-w-md">
                <div class="bg-white shadow-md rounded-lg px-3 py-2 mb-4">
                    <div class="block text-gray-700 text-lg font-semibold py-2 px-2">
                        Detected ingredients
                    </div>
                    <div class="flex items-center rounded-md">
                        <input wire:model="newIngredient"
                            class="w-full bg-purple-white shadow rounded border-0 leading-tight focus:outline-none py-2 px-2"
                            id="newIngredient" type="text" placeholder="Add ingredient...">

                        <button wire:click="addIngredient" wire:loading.attr="disabled"
                            class="py-2 px-2 rounded tracking-widest uppercase text-center shadow bg-indigo-600 hover:bg-indigo-700 focus:bg-red-500 focus:shadow-outline focus:outline-none text-white text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </button>
                    </div>
                 @error('newIngredient') <span class="error flex items-center font-medium tracking-wide text-red-500 text-s mt-1 ml-1">{{ $message }}</span> @enderror

                    <div class="py-3 text-sm">
                        @foreach($ingredients as $key => $ingredient)
                            <div wire:key="{{ $key }}"
                                class="flex justify-start cursor-pointer uppercase shadow bg-indigo-600 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white font-bold rounded-md px-1 py-1 my-2 text-xs">
                                <span class="bg-white h-2 w-2 m-2 mt-4 rounded-full"></span>
                                <div wire:model="ingredient"
                                     class="flex-grow font-medium font-bold px-2 py-3 hover:bg-indigo-700">  {{ $ingredient }}</div>

                                <button wire:click="deleteIngredient({{ $key }})" wire:loading.attr="disabled"
                                    class="py-2 px-2 rounded tracking-widest uppercase text-center shadow bg-white focus:shadow-outline focus:outline-none text-indigo-600 focus:bg-red-500 focus:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <div class="block bg-gray-50 text-sm py-2 px-3 -mx-3 -mb-2 rounded-b-lg">
                        <div class="flex justify-center self-center">
                            <div class="py-4" wire:loading.remove wire:target="cookmeup">
                                <a
                                    wire:click="backToPhoto"
                                    href="#"
                                    class="block tracking-widest uppercase text-center shadow bg-white font-bold text-indigo-600 hover:bg-indigo-700 hover:text-white focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded"
                                >
                                    Change photo
                                </a>
                            </div>
                            <div class="py-4 ml-3">
                                <a href="#" wire:click="cookmeup"
                                    class="block tracking-widest uppercase text-center font-bold shadow bg-red-500 hover:bg-white hover:text-red-500 focus:shadow-outline focus:outline-none text-white py-3 px-10 text-xs rounded">
                                    <div wire:loading.remove wire:target="cookmeup"> Cookmeup</div>
                                    <div wire:loading wire:target="cookmeup">Cooking ...</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


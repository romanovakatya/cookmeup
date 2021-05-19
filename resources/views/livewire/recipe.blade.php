<div xmlns:livewire="http://www.w3.org/1999/html">
    @if(!empty($recipes))
        <div class="grid place-items-center min-h-screen bg-gray-100 p-5">

            <section class="grid grid-cols-1 lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-2 gap-4">

                @foreach ( $recipes as $key => $recipe )

                    <div wire:key="{{ $recipe['id'] }}" wire:click="show({{ $recipe['id'] }})"
                         class=" bg-white shadow-lg rounded p-3 tracking-widest text-center hover:bg-gray-100 focus:bg-indigo-500 focus:shadow-outline focus:outline-none ">
                        <div class="group relative">
                            <img src="{{ $recipe['image'] }}" alt="Recipe" class="w-full md:w-72 block rounded"
                                 title="{{$recipe['title']}}">

                            <div class="text-center text-red-900 mx-1 my-2"><!--lg:px-6 px-2 -->
                                <div class="font-bold md:text-lg sm:text-base text-s">{{$recipe['title']}}</div>
                                <!--mb-2 -->
                                <p class="text-grey-darker text-base">
                                </p>
                            </div>
                            <div class="grid grid-cols-3 gap-4 text-center text-xs text-red-900 font-semibold ">
                                @foreach( $recipe['missedIngredients'] as $key => $ingredient )
                                    <span
                                        class="bg-grey-lighter rounded-full px-1.5">{{ $ingredient }}</span>
                                @endforeach

                                @foreach( $recipe['usedIngredients'] as $key => $ingredient )
                                    <span
                                        class="bg-grey-lighter rounded-full px-1.5">{{ $ingredient }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>
        </div>
    @else
        <div class="h-screen w-full flex flex-col justify-center items-center">
            <div class="flex justify-center self-center">
                <div class="flex w-full h-auto items-center justify-center bg-grey-lighter">
                    <label
                        class="w-auto flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue
                        bg-indigo-600 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white">
                        <span class="mt-2 text-base leading-normal">I have not found any recipes</span>
                    </label>
                </div>
            </div>
            <div class="flex justify-center self-center">
                <div class="py-4 ">
                    <a
                        wire:click="backToPhoto"
                        href="#"
                        class="block tracking-widest uppercase text-center font-bold shadow bg-white hover:bg-red-500 hover:text-white border border-red-500 focus:shadow-outline focus:outline-none text-red-500 py-3 px-10 text-xs rounded"
                    >
                        Make new photo
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>


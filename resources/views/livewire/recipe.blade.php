<div class="grid place-items-center min-h-screen bg-gray-100 p-5"
     xmlns:livewire="http://www.w3.org/1999/html">
    <div>
        <section class="grid grid-cols-1 lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-2 gap-4">
            @forelse ( $recipes as $key => $recipe )

                <div wire:key="{{ $recipe['id'] }}" wire:click="show({{ $recipe['id'] }})"
                     class=" bg-white shadow-lg rounded p-3 tracking-widest text-center hover:bg-gray-100 focus:bg-indigo-500 focus:shadow-outline focus:outline-none ">
                    <div class="group relative">
                        <img src="{{ $recipe['image'] }}" alt="Recipe" class="w-full md:w-72 block rounded"
                             title="{{$recipe['title']}}">

                        <div class="text-center text-red-900 mx-1 my-2"><!--lg:px-6 px-2 -->
                            <div class="font-bold md:text-lg sm:text-base text-s">{{$recipe['title']}}</div><!--mb-2 -->
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
            @empty
                <p>No recipes</p>
            @endforelse
        </section>
    </div>
</div>


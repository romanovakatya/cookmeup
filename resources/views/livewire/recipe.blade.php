<div class="h-screen w-full flex flex-nowrap sm:flex-wrap lg:flex-row flex-col justify-center items-center"
     xmlns:livewire="http://www.w3.org/1999/html">
    @forelse ( $recipes as $key => $recipe )
        <div wire:key="{{ $recipe['id'] }}" class="sm:max-w-xs max-w-min rounded overflow-hidden shadow-lg my-2 mx-2">
            <!--   -->
            <img src="{{ $recipe['image'] }}" alt="Recipe">
            <div class="py-2 text-center mx-1"><!--lg:px-6 px-2 -->
                <div class="font-bold md:text-lg sm:text-base text-xs">{{$recipe['title']}}</div><!--mb-2 -->
                <p class="text-grey-darker text-base">
                </p>
            </div>
            <div class="flex space-x-1 text-center"> <!--lg:px-6 px-2  -->
                    @foreach( $recipe['missedIngredients'] as $key => $ingredient )
                        <span
                            class="flex-1 bg-grey-lighter rounded-full mx-2 py-1.5 text-xs font-semibold text-grey-darker ">{{ $ingredient['name'] }}</span>
                    @endforeach

                    @foreach( $recipe['usedIngredients'] as $key => $ingredient )
                        <span
                            class="flex-1 bg-grey-lighter rounded-full mx-2 py-1.5 text-xs font-semibold text-grey-darker ">{{ $ingredient['name'] }}</span>
                    @endforeach

            <!--  <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker">Ingrediente 1</span> -->
            </div>
        </div>
    @empty
        <p>No recipes</p>
    @endforelse
</div>


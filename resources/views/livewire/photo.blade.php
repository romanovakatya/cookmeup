
<div class="h-screen w-full flex flex-col justify-center items-center" xmlns:livewire="http://www.w3.org/1999/html">
    <div class="flex justify-center self-center">
        <div class="flex w-full h-auto items-center justify-center bg-grey-lighter">
            @if(isset($photo))
                <div class="max-w-md flex flex-col items-center px-3 py-4 bg-white rounded-md shadow-lg tracking-wide border border-blue ">
                    <img src="{{ $photo->temporaryUrl() }}" alt="product" class="w-auto rounded-md">
                </div>
            @else
                <label
                    class="w-auto flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue">
                    <span class="mt-2 text-base leading-normal">Make photo, get recipes!</span>
                </label>
            @endif
        </div>
    </div>
    <div class="flex justify-center self-center">
        <div class="py-4" wire:loading.remove wire:target="save">
            <label class="block tracking-widest uppercase text-center shadow bg-indigo-600 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">
                <div wire:loading.remove wire:target="photo"> Make photo</div>
                <input wire:model="photo" wire:loading.attr="disabled" id="photo" name="photo" type="file" accept="image/*"  class="hidden">
                <!-- para avisar el usuario que su foto está subiendo capture="camera"-->
                <div wire:loading wire:target="photo">Uploading the photo ...</div>
            </label>
        </div>
        @if (isset($photo))
        <div class="py-4 ml-3" wire:loading.remove wire:target="photo">
            <a
                wire:click="save"
                href="#"
                class="block tracking-widest uppercase text-center shadow bg-indigo-600 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded"
            >
                <div wire:loading.remove wire:target="save">Detect ingredients</div>
                <div wire:loading wire:target="save">Detecting the ingredients ...</div>
            </a>

        </div>
        @endif
    </div>
</div>



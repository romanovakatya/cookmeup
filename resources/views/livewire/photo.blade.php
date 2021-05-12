
<div class="h-screen w-full flex flex-col justify-center items-center" xmlns:livewire="http://www.w3.org/1999/html">
    <div class="flex justify-center self-center">
        <div class="flex w-full h-auto items-center justify-center bg-grey-lighter">
            @if(isset($photo))
                <img src="{{ $photo->temporaryUrl() }}" alt="product">
            @else
                <label
                    class="w-auto flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue ">
                    <span class="mt-2 text-base leading-normal">Make photo, get recipes!</span>
                </label>
            @endif
        </div>
    </div>
    <div class="flex justify-center self-center">
        <div class="py-4">
            <label class="block tracking-widest uppercase text-center shadow bg-indigo-600 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">
                <div wire:loading.remove wire:target="photo"> Make photo</div>
                <input wire:model="photo" wire:loading.attr="disabled" id="photo" name="photo" type="file" accept="image/*" capture="camera" class="hidden">
                <!-- para avisar el usuario que su foto está subiendo-->
                <div wire:loading wire:target="photo">Uploading the photo ...</div>
            </label>
        </div>
        @if (isset($photo))
        <div class="py-4 ml-3">
            <a
                wire:click="save"
                href="#"
                class="block tracking-widest uppercase text-center shadow bg-indigo-600 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded"
            >
                Detect ingredients
            </a>

        </div>
        @endif
    </div>
</div>



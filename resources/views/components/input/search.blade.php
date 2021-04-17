<div class="flex rounded-md shadow-sm">
        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
            <x-icon.search></x-icon.search>
        </span>

    <input {{ $attributes->merge(['class' => 'flex-1 form-input border-gray-300 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 rounded-none rounded-r-md']) }} type="search" />
</div>

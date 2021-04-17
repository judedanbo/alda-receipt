<div>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900">Office Details</h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-full flex justify-start border-b-2">
                        <div>
                            <h1 class="text-3xl">{{ $office->office_name }}</h1>
                            <p>Office Number {{ $office->office_id }}</p>
                        </div>
                        {{-- <div>
                            <x-button.link wire:click="create"> <x-icon.plus></x-icon.plus> Edit Staff Info</x-button.link>
                            <x-button.danger class="ml-5" wire:click="create"> <x-icon.trash></x-icon.trash> Delete Staff Info</x-button.danger>
                        </div> --}}
                    </div>
                    <div class="py-4 space-y-4">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

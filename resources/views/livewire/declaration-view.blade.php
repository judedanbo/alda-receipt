<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg ">
                    <div class="px-4 py-5 sm:px-6 w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Declaration Information
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Details and declaration.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-5 gap-4">
                    
                        <div class="border-t border-b border-gray-200 col-start-1 sm:col-span-4">
                            <dl>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Receipt Number
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $declaration->receipt_no }}   
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Date Submitted
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $declaration->declared_on_display }}   
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Full name
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $declaration->declarant_name }}   
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Post/Schedule
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $declaration->post }}  {{ $declaration->schedule ? ' / ' .$declaration->schedule : ''  }}   
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                    Office Location
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <p>{{ $declaration->office_location}}</p>
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                    Contact Information
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <p>{{ $declaration->address}}</p>
                                    <p>{{ $declaration->contact}}</p>
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                    Witness
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <p>{{ $declaration->witness}}</p>
                                        <p>{{ $declaration->witness_occupation}}</p>
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Person Submitting
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <p>{{ $declaration->person_submitting}}</p>
                                        <p>{{ $declaration->person_submitting_contact}}</p>                            </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Received by
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        @if ( $declaration->enteredBy !== null)
                                            @if ($declaration->enteredBy->staff !== null)
                                                <p>{{ Str::title($declaration->enteredBy->staff->full_name) }}</p>
                                            @else
                                            <p>{{ Str::title($declaration->enteredBy->username) }}</p>
                                            @endif
                                        @endif
                                        
                                </div>
                                {{-- <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Office
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <p>{{ $declaration->office}}</p>
                                   </dd>
                                </div> --}}
                            </dl>
                        </div>
                        <div class="col-start-1 sm:col-start-5 invisible sm:visible">
                            <div ">
                                @if ($declaration->synced === true)
                                <x-button class="bg-green-400" wire:click="sync">&nbsp Synced</x-button>
                                @else
                                <x-button class="bg-red-500 hover:bg-red-400"  wire:click="sync" title="click to synchronize">
                                    <x-icon.refresh wire:loading.class="animate-spin" wire:target='sync'></x-icon.refresh> 
                                    &nbsp Not Synced
                                </x-button>  
                                @endif
                            </div>
                            <x-button.primary wire:click="receipt" class="mr-5 px-2 mt-8" title="view Receipt">
                                <x-icon.receipt></x-icon.receipt> 
                                &nbsp  Show Receipt
                            </x-button.primary>
                            <x-button.primary wire:click="edit" class="mr-5 px-2  mt-8">
                                <x-icon.pencil></x-icon.pencil>
                                &nbsp  Edit Declaration
                            </x-button.primary>
                            <x-button.primary wire:click="new" class="mr-5 px-2  mt-8" title="Enter new Declaration">
                                <x-icon.pencil></x-icon.pencil>
                                &nbsp  New Declaration
                            </x-button.primary>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


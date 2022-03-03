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

                    <div class="grid grid-cols-1 gap-4">

                        <div class="border-t border-b border-gray-200 col-start-1">
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
                                        {{ $declaration->post }}
                                        {{ $declaration->schedule ? ' / ' . $declaration->schedule : '' }}
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Office Location
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <p>{{ $declaration->office_location }}</p>
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Contact Information
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <p>{{ $declaration->address }}</p>
                                        <p>{{ $declaration->contact }}</p>
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Witness
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <p>{{ $declaration->witness }}</p>
                                        <p>{{ $declaration->witness_occupation }}</p>
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Person Submitting
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <p>{{ $declaration->person_submitting }}</p>
                                        <p>{{ $declaration->person_submitting_contact }}</p>
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Received by
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        @if ($declaration->enteredBy !== null)
                                            @if ($declaration->enteredBy->staff !== null)
                                                <p>{{ Str::title($declaration->enteredBy->staff->full_name) }}</p>
                                            @else
                                                <p>{{ Str::title($declaration->enteredBy->username) }}</p>
                                            @endif
                                        @endif
                                        {{ $declaration->old_received_by }}
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
                        <div class="flex  flex-wrap gap-4 col-start-1 row-start-1 justify-around">
                            @if ($declaration->synced === true)
                                <x-button class="bg-green-400 max-w-min" wire:click="sync">Synced</x-button>
                            @else
                                <x-button
                                    class="bg-red-500 hover:bg-red-400 gap-3 focus:outline-none focus:border-red-900 focus:ring ring-reflex d-300 max-w-min"
                                    wire:click="sync" title="click to synchronize">
                                    <x-icon.refresh wire:loading.class="animate-spin" wire:target='sync' />
                                    Not Synced
                                </x-button>
                            @endif
                            @if ($declaration->qrcode == null)
                                <x-button wire:click="generateQrCode"
                                    class="bg-red-500 hover:bg-red-400 focus:outline-none focus:border-red-900 focus:ring ring-red-300 gap-3 max-w-min"
                                    title="Generate QR Code">
                                    <x-icon.qrcode></x-icon.qrcode>
                                    Generate Code
                                </x-button>
                            @else
                                <x-button.primary wire:click="receipt" class="flex gap-3 max-w-min"
                                    title="view Receipt">
                                    <x-icon.receipt></x-icon.receipt>
                                    Show Receipt
                                </x-button.primary>
                            @endif
                            <x-button.primary wire:click="edit" class="flex gap-3 max-w-min">
                                <x-icon.pencil></x-icon.pencil>
                                Edit Declaration
                            </x-button.primary>
                            <x-button.primary wire:click="new" class="flex gap-3 max-w-min"
                                title="Enter new Declaration">
                                <x-icon.pencil></x-icon.pencil>
                                New Declaration
                            </x-button.primary>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

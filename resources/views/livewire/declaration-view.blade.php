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
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Date Sumitted
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $current_declaration->declared_on_display }}   
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Full name
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $current_declaration->declarant_name }}   
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Post/Schedule
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $current_declaration->post }}  {{ $current_declaration->schedule ? ' / ' .$current_declaration->schedule : ''  }}   
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                    Office Location
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <p>{{ $current_declaration->office_location}}</p>
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                    Contact Information
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <p>{{ $current_declaration->address}}</p>
                                    <p>{{ $current_declaration->contact}}</p>
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                    Witness
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <p>{{ $current_declaration->witness}}</p>
                                        <p>{{ $current_declaration->witness_occupation}}</p>
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Person Submitting
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <p>{{ $current_declaration->person_submitting}}</p>
                                        <p>{{ $current_declaration->person_submitting_contact}}</p>                            </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Received by
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <p>{{ $current_declaration->enteredBy ?$current_declaration->enteredBy->username :'' }}</p>
                                </div>
                            </dl>
                        </div>
                        <div class="col-start-1 sm:col-start-5 invisible sm:visible">
                            <x-button.primary wire:click="receipt" class="mr-5 px-2 mt-8"><x-icon.receipt></x-icon.receipt> &nbsp  Show Receipt</x-button.primary>
                            <x-button.primary wire:click="edit" class="mr-5 px-2  mt-8"><x-icon.pencil></x-icon.pencil> &nbsp  Edit Declaration</x-button.primary>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900">
            {{ __('Add/Edit Declaration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <div class="w-full flex justify-center px-2 sm:px-10 pt-5 mb-10">
                    <div class="w-full">
                        <div class="flex justify-between">
                            <h2 class="text-2xl ">
                                {{ 'Add New Declaration'}} 
                            </h2>
                        </div>
                        <div>
                            <form wire:submit.prevent="save" method="POST">
                                {{-- Date of Declaration --}}
                                <div class="w-full sm:w-2/3 mt-4">
                                    <label for="declared_on" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2 w-full">
                                    Date of Declaration
                                    </label>
                                    <div class="w-full">
                                        
                                        <input type="date" wire:model.lazy='declaration.declared_on'  id="declared_on" min="1992-01-01" max='{{date('Y-m-d')}}' class="w-full">
                                        <x-input.error message="{{ $errors->first('declaration.declared_on') }}"></x-input.error>

                                    </div>
                                </div>

                                {{-- Name of Declarant --}}
                                <div class="mt-4">
                                <label for="declarant_name" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                    Name of Declarant
                                    </label>
                                    <x-input.text wire:model.lazy="declaration.declarant_name" id="declarant_name" required />
                                    <x-input.error message="{{ $errors->first('declaration.declarant_name') }}"></x-input.error>
                                </div>
                                
                                
                            <div class="grid gap-4 grid-col-1 sm:grid-cols-3 ">
                                <div class="col-start-1 sm:col-span-2 mt-4"> 
                                    {{-- Post of Declarant --}}
                                    <label for="post" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                    Post
                                    </label>
                                    <x-input.text wire:model.lazy="declaration.post" id="post" required />
                                    <x-input.error message="{{ $errors->first('declaration.post') }}"></x-input.error>
                                </div>

                                <div class="col-start-1 sm:col-start-3 mt-4"> 
                                {{-- Schedule of Declarant --}}
                                <label for="schedule" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                Schedule
                                </label>
                                    <x-input.text wire:model.lazy="declaration.schedule" id="schedule" />
                                    <x-input.error message="{{ $errors->first('declaration.schedule') }}"></x-input.error>
                                </div>
                            </div>

                            <div class="mt-4">
                                {{-- Address --}}
                                <label for="address" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                Address
                                </label>                   
                                <x-input.text wire:model.lazy="declaration.address" id="address" required />
                                <x-input.error message="{{ $errors->first('declaration.address') }}"></x-input.error>
                                
                            </div>
                            <div class="grid grid-cols-1 sm:grid-col-2 gap-4">
                                <div class="col-start-1 mt-4">
                                
                                    {{-- Office Location --}}
                                    <label for="office_location" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                    Office Location
                                    </label> 
                                
                                    <x-input.text wire:model.lazy="declaration.office_location" id="office_location"  />
                                    <x-input.error message="{{ $errors->first('declaration.office_location') }}"></x-input.error>
                                </div>
                                <div class="cols-start-1 sm:col-start-2 mt-4">
                                    <label for="contact" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                    Contact
                                    </label> 
                                    <x-input.text wire:model.lazy="declaration.contact" id="contact" />
                                    <x-input.error message="{{ $errors->first('declaration.contact') }}"></x-input.error>
                                </div>
                                
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="col-start-1 mt-4">
                                    {{-- Witness --}}
                                    <label for="witness" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                    Witness Name
                                    </label>
                                    <x-input.text wire:model.lazy="declaration.witness" id="witness" required />
                                    <x-input.error message="{{ $errors->first('declaration.witness') }}"></x-input.error>
                                </div>
                                <div class="col-start-1 sm:col-start-2 mt-4">
                                
                                    {{-- Witness Occupation --}}
                                    <label for="witness_occupation" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                    Witness Occupation
                                    </label>
                                    <x-input.text wire:model.lazy="declaration.witness_occupation" id="witness_occupation" />
                                    <x-input.error message="{{ $errors->first('declaration.witness_occupation') }}"></x-input.error>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="col-start-1 mt-4">
                                    {{-- Person Submitting --}}
                                    <label for="person_submitting" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                    Person Submitting
                                    </label>
                                    <x-input.text wire:model.lazy="declaration.person_submitting" id="person_submitting" />
                                    <x-input.error message="{{ $errors->first('declaration.person_submitting') }}"></x-input.error>
                                </div>
                                <div class="col-start-1 sm:col-start-2 mt-4"> 
                                    <label for="person_submitting_contact" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                    Contact of Person Submitting
                                    </label>
                                    {{-- Contact of Person Submitting --}}
                                    
                                    <x-input.text wire:model.lazy="declaration.person_submitting_contact" id="person_submitting_contact"  />
                                    <x-input.error message="{{ $errors->first('declaration.person_submitting_contact') }}"></x-input.error>
                                </div>
                            </div>

                                <div class="flex items-center justify-end mt-4">
                                    <x-button.primary >
                                        Add Declaration
                                    </x-button.primary>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
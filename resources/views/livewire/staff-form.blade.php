<div>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900">
            {{ __('Add/Edit Staff') }}
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
                                        {{ 'Add/Edit Staff'}} 
                                    </h2>
                                </div>
                                <div>
                                    <form wire:submit.prevent="save" class="pt-5" method="POST">
                    
                                        <div class="flex gap-4">
                                            {{-- Staff ID --}}
                                            <x-input.group label="Staff ID" for="staff_id" :error="$errors->first('staff.staff_id')">
                                                <x-input.text wire:model.lazy="staff.staff_id" id="staff_id" required autofocus />
                                            </x-input.group>
                                
                                            {{-- Staff Title --}}
                                            <x-input.group label="Staff Title" for="title" :error="$errors->first('staff.title')">
                                                <x-input.text wire:model.lazy="staff.title" id="staff_id"   />
                                            </x-input.group>
                                        </div>
                            
                                        {{-- Other Names --}}
                                        <x-input.group label="Other Names" for="other_names" :error="$errors->first('staff.other_names')">
                                            <x-input.text wire:model.lazy="staff.other_names" id="other_names" required />
                                        </x-input.group>
                                        
                                        {{-- Surname --}}
                                        <x-input.group label="Surname" for="surname" :error="$errors->first('staff.surname')">
                                            <x-input.text wire:model.lazy="staff.surname" id="surname" required />
                                        </x-input.group>
                    
                                        {{-- Email Address --}}
                                        <x-input.group label="Email Address" for="email" :error="$errors->first('staff.email')">
                                            <x-input.email wire:model.lazy="staff.email" id="email" required />
                                        </x-input.group>
                            
                            
                                        <div class="flex items-center justify-end mt-4">
                                            <x-button.primary >
                                                {{ isset($staff->id)?'Save':'Add' }} Staff
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
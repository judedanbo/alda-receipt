<div>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900">
            {{ __('Add/Edit Office') }}
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
                                        {{ 'Add/Edit Office'}} 
                                    </h2>
                                </div>
                                <div>
                                    <form wire:submit.prevent="save" method="POST">
                    
                                        {{-- Office ID --}}
                                        <x-input.group label="Office ID" for="office_id" :error="$errors->first('office.office_id')">
                                            <x-input.text wire:model.lazy="office.office_id" id="office_id" required autofocus />
                                        </x-input.group>
                                        
                                        {{-- Office name --}}
                                        <x-input.group label="Office Name" for="office_name" :error="$errors->first('office.office_name')">
                                            <x-input.text wire:model.lazy="office.office_name" id="office_name" required />
                                        </x-input.group>
                            
                                        <div class="flex items-center justify-end mt-4">
                                            <x-button.primary >
                                                {{ $office?'Save':'Add' }} Office
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
<div class="w-full flex justify-center px-10 pt-5 pb-10">
    <div class="w-4/5">
        <h2 class="text-2xl ">
            {{ isset($office->id) ? 'Edit Office Records': 'Add New Office'}}
         </h2>
        
        <form wire:submit.prevent="save">
            
            {{-- Office ID --}}
            <x-input.group label="Office ID" for="office_id" :error="$errors->first('office.office_id')">
                <x-input.text wire:model.lazy="office.office_id" id="office_id" required autofocus />
            </x-input.group>
            
            {{-- Office name --}}
            <x-input.group label="Surname" for="office_name" :error="$errors->first('office.office_name')">
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
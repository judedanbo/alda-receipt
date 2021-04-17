<div class="w-full flex justify-center px-10 pt-5 pb-10">
    <div class="w-4/5">
       <h2 class="text-2xl ">
           {{ isset($staff->id) ? 'Edit Staff Records': 'Add New Staff'}}
        </h2>
        
        <form wire:submit.prevent="save" class="pt-5">
            
            {{-- Staff ID --}}
            <x-input.group label="Staff ID" for="staff_id" :error="$errors->first('staff.staff_id')">
                <x-input.text wire:model.lazy="staff.staff_id" id="staff_id" required autofocus />
            </x-input.group>

            {{-- Staff Title --}}
            <x-input.group label="Staff Title" for="title" :error="$errors->first('staff.title')">
                <x-input.text wire:model.lazy="staff.title" id="staff_id"   />
            </x-input.group>

             {{-- Other Names --}}
            <x-input.group label="Other Names" for="other_names" :error="$errors->first('staff.other_names')">
                <x-input.text wire:model.lazy="staff.other_names" id="other_names" required />
            </x-input.group>
            
            {{-- Surname --}}
            <x-input.group label="Surname" for="surname" :error="$errors->first('staff.surname')">
                <x-input.text wire:model.lazy="staff.surname" id="surname" required />
            </x-input.group>


            <div class="flex items-center justify-end mt-4">
                <x-button.primary >
                    {{ isset($staff->id)?'Save':'Add' }} Staff
                </x-button.primary>
            </div>

            
        </form>
    </div>
</div>
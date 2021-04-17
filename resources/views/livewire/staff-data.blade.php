<div>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900">Staff</h1>
    </x-slot> 

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-full flex justify-between">
                        <div class="w-1/4">
                            <x-input.search placeholder="Search staff..." wire:model='search'  />
                        </div>
                        <x-button.primary wire:click="create"> <x-icon.plus></x-icon.plus> Add Staff</x-button.primary>
                    </div>
                    <div class="py-4 space-y-4">
                        <x-table class="mt-5">
                            <x-slot name="head">
                                 <x-table.heading sortable wire:click="sortBy('staff_id')"  :direction="$sortField === 'staff_id' ? $sortDirection : null">
                                    Staff Number
                                </x-table.heading>
                                 <x-table.heading sortable wire:click="sortBy('surname')"  :direction="$sortField === 'surname' ? $sortDirection : null">
                                    Staff
                                </x-table.heading>
                                 <x-table.heading sortable>
                                    Current Office
                                </x-table.heading>
                                 <x-table.heading sortable>
                                    User ID
                                </x-table.heading>
                                 <x-table.heading sortable>
                                    User Type
                                </x-table.heading>
                                 <x-table.heading>
                                    Action
                                </x-table.heading>
                            </x-slot>
                           
                            <x-slot name="body">
                                @forelse ($allStaff as $currentStaff)
                                    <x-table.row wire:loading.class="opacity-50">
                                        <x-table.cell>{{ $currentStaff->staff_id }}</x-table.cell>
                                        <x-table.cell>
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $currentStaff->full_name }}
                                              </div>
                                              <div class="text-sm text-gray-500">
                                                {{ $currentStaff->email }}
                                              </div>
                                            
                                        </x-table.cell>
                                        <x-table.cell></x-table.cell>
                                        <x-table.cell>
                                            {{ $currentStaff->user ? $currentStaff->user->username:'' }}
                                        </x-table.cell>
                                        <x-table.cell></x-table.cell>
                                        <x-table.cell class="flex justify-around">
                                            <x-button.link wire:click="show({{$currentStaff->id}})" class="flex" >
                                                <x-icon.view></x-icon.view> Details
                                            </x-button.link>
                                            <x-button.link wire:click="create({{ $currentStaff->id }})" class="flex items-center">
                                                <x-icon.edit></x-icon.edit> Edit
                                            </x-button.link>
                                            <x-button.danger wire:click="requestDelete({{$currentStaff->id}})" class="flex items-center">
                                                <x-icon.trash></x-icon.trash> Delete </x-button.danger>
                                        </x-table.cell>
                                    </x-table.row>
                                @empty
                                <x-table.cell colspan="6">
                                    <div class="flex justify-center items-center space-x-2">
                                        <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                        <span class="font-medium py-8 text-cool-gray-400 text-xl">No staff information found...</span>
                                    </div>
                                </x-table.cell>
                                @endforelse
                            </x-slot>
    
                        </x-table>
                    </div>

                    {{ $allStaff->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Staff Modal -->
    <form wire:submit.prevent="deleteSelected">
    <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Delete Staff</x-slot>

            <x-slot name="content">
                @if (isset($staff->id))
                    <div class="py-8 text-cool-gray-700">
                        This will delete the records of <strong>{{ $staff->full_name}}</strong> and all associated information
                    </div>
                    <div>Are you sure you want to continue ? </div> 
                @endif
            </x-slot>

            <x-slot name="footer">
                <x-button.link wire:click="$set('showDeleteModal', false)">Cancel</x-button.link>

                <x-button.danger type="submit">Delete</x-button.danger>
            </x-slot>
        </x-modal.confirmation>
    </form>

     <!-- Add/Edit Staff Modal -->
    <x-modal wire:model.defer="showFormModal">
        <div class="w-full flex justify-center px-5 pt-5 pb-10">
            <div class="w-4/5">
                <h2 class="text-2xl ">
                    {{ isset($staff->id) ? 'Edit Staff Records': 'Add New Staff'}}
                </h2>
                
                <form wire:submit.prevent="save" class="pt-5">
                    
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
    </x-modal>
</div>

  

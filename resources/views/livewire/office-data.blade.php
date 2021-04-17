<div>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900">
            {{ __('All Offices') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-full flex justify-between">
                        <div class="w-1/4">
                            <x-input.search placeholder="Search offices..." wire:model='search'  />
                        </div>
                        <x-button.primary wire:click="create"> <x-icon.plus></x-icon.plus> Add Office</x-button.primary>
                    </div>
                    <div class="py-4 space-y-4">
                        <x-table lass="mt-5">
                            <x-slot name="head">
                                <x-table.heading sortable wire:click="sortBy('office_id')"  :direction="$sortField === 'office_id' ? $sortDirection : null">
                                    Office Number
                                </x-table.heading>
                                <x-table.heading sortable wire:click="sortBy('office_name')"  :direction="$sortField === 'office_name' ? $sortDirection : null">
                                    Office Name
                                </x-table.heading>
                                <x-table.heading >
                                    Action
                                </x-table.heading>
                            </x-slot>
                        
                            <x-slot name="body">
                                @forelse ($offices as $current_office)
                                    <x-table.row>
                                        <x-table.cell>{{ $current_office->office_id }}</x-table.cell>
                                        <x-table.cell>{{ $current_office->office_name }}</x-table.cell>
                                        <x-table.cell  class="flex justify-center">
                                            <x-button.link wire:click="show({{$current_office->id}})" class="ml-2 flex" > 
                                                <x-icon.view></x-icon.view> Details
                                            </x-button.link>
                                            <x-button.link wire:click="create({{ $current_office->id }})" class="ml-2 flex items-center ">
                                                <x-icon.edit></x-icon.edit> Edit
                                            </x-button.link>
                                            <x-button.danger wire:click="requestDelete({{$current_office->id}})" class="ml-2 flex items-center ">
                                                <x-icon.trash></x-icon.trash> Delete </x-button.danger>
                                        </x-table.cell>
                                    </x-table.row>
                                @empty
                                <x-table.cell colspan="3">
                                    <div class="flex justify-center items-center space-x-2">
                                        <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                        <span class="font-medium py-8 text-cool-gray-400 text-xl">No Office information found...</span>
                                    </div>
                                </x-table.cell>
                                @endforelse
                            </x-slot>

                        </x-table>
                    </div>

                    {{ $offices->links() }}
                </div>
            </div>
        </div>
    </div>
     <!-- Delete Office Modal -->
     <form wire:submit.prevent="deleteSelected">
        <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Delete Office</x-slot>

            <x-slot name="content">
                @if (isset($office->id))
                    <div class="py-8 text-cool-gray-700">
                        This will delete the records of <strong>{{ $office->office_name}}</strong> and all associated information
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
      </x-modal>

</div>

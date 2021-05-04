<div>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900">
            {{ __('All Declarations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-full grid gap-4 grid-col-1 sm:grid-cols-5 grid-rows-2 sm:grid-rows-1">
                        <div class="col-start-1 sm:col-span-3 lg:col-span-2 row-start-2 sm:row-start-1">
                            <x-input.search placeholder="Search declarations..." wire:model='search'  />
                        </div>
                        <div class="col-start-1 sm:col-start-4 sm:col-span-2 row-start-1 sm:row-start-1 sm:text-right">
                            <x-button.primary wire:click="create"> <x-icon.plus></x-icon.plus> Add Declaration</x-button.primary>
                        </div>
                    </div>
                    <div class="py-4 space-y-4">
                        <x-table lass="mt-5">
                            <x-slot name="head">
                                <x-table.heading sortable wire:click="sortBy('synced')"  :direction="$sortField === 'synced' ? $sortDirection : null">
                                    Synced
                                </x-table.heading>
                                <x-table.heading sortable wire:click="sortBy('receipt_no')"  :direction="$sortField === 'receipt_no' ? $sortDirection : null">
                                    Receipt
                                </x-table.heading>
                                <x-table.heading sortable wire:click="sortBy('declared_on')"  :direction="$sortField === 'declared_on' ? $sortDirection : null">
                                    Date
                                </x-table.heading>
                                <x-table.heading sortable wire:click="sortBy('declarant_name')"  :direction="$sortField === 'declarant_name' ? $sortDirection : null">
                                   Name of Declarant
                                </x-table.heading>
                                <x-table.heading sortable wire:click="sortBy('post')"  :direction="$sortField === 'post' ? $sortDirection : null">
                                   Post/Schedule
                                </x-table.heading>
                                <x-table.heading sortable wire:click="sortBy('declaration_location')"  :direction="$sortField === 'declaration_location' ? $sortDirection : null">
                                   Office Location
                                </x-table.heading>
                                <x-table.heading sortable wire:click="sortBy('addrress')"  :direction="$sortField === 'address' ? $sortDirection : null">
                                   Address/ Contact
                                </x-table.heading>
                                <x-table.heading sortable wire:click="sortBy('witness')"  :direction="$sortField === 'witness' ? $sortDirection : null">
                                   Witness
                                </x-table.heading>
                                <x-table.heading sortable wire:click="sortBy('person_submitting')"  :direction="$sortField === 'person_submitting' ? $sortDirection : null">
                                  Person Submitting
                                </x-table.heading>
                                <!-- <x-table.heading >
                                    Action
                                </x-table.heading> -->
                            </x-slot>

                            <x-slot name="body">
                                @forelse ($declarations as $current_declaration)
                                    <x-table.row class="hover:bg-gray-100 cursor-pointer">
                                    <x-table.cell>
                                            <span 
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{$current_declaration->synced? ' bg-blue-400 ': ' bg-red-400 ' }}text-white" 
                                                wire:click.prevent="syncOne({{$current_declaration->id}})" 
                                                wire:loading.class.remove="bg-blue-400"
                                                wire:loading.class.remove="bg-red-400"
                                                wire:loading.class="bg-purple-400"
                                                wire:target="syncOne({{$current_declaration->id}})">
                                                <span wire:loading.class="hidden" wire:target="syncOne({{$current_declaration->id}})">
                                                    {{$current_declaration->synced? 'Yes': 'No'}}
                                                </span>
                                                <span wire:loading wire:target="syncOne({{$current_declaration->id}})">
                                                <x-icon.refresh class="animate-spin"></x-icon.refresh></span>
                                            </span>
                                        </x-table.cell>
                                        <x-table.cell wire:click="show({{$current_declaration->id}})">
                                            {{ $current_declaration->receipt_no }}
                                        </x-table.cell>
                                        <x-table.cell wire:click="show({{$current_declaration->id}})">
                                            {{ $current_declaration->declared_on_display }}
                                        </x-table.cell>
                                        <x-table.cell wire:click="show({{$current_declaration->id}})">
                                            {{ $current_declaration->declarant_name }}
                                        </x-table.cell>
                                        <x-table.cell wire:click="show({{$current_declaration->id}})">
                                            <p>{{ $current_declaration->post }} </p>
                                            @if($current_declaration->schedule)
                                                <p>{{$current_declaration->schedule}}</p>
                                            @endif
                                        </x-table.cell>
                                        <x-table.cell wire:click="show({{$current_declaration->id}})">
                                            {{ $current_declaration->office_location }}
                                        </x-table.cell>
                                        <x-table.cell wire:click="show({{$current_declaration->id}})">
                                            <p>{{$current_declaration->address}}</p>
                                            <p>{{$current_declaration->contact}}</p>
                                        </x-table.cell>
                                        <x-table.cell wire:click="show({{$current_declaration->id}})">
                                            <p>{{$current_declaration->witness}}</p>
                                            <p>{{$current_declaration->witness_occupation}}</p>
                                        </x-table.cell>
                                        <x-table.cell wire:click="show({{$current_declaration->id}})">
                                            <p>{{$current_declaration->person_submitting}}</p>
                                            <p>{{$current_declaration->person_submitting_contact}}</p>
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

                    {{ $declarations->links() }}
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="fixed bottom-10 right-5" wire:poll.15s='online' >
                @if ($connectedToServer === true)
                    <x-icon.refresh 
                        class="w-12 h-12 text-white rounded-full p-3 bg-green-600 mt-2 cursor-pointer hover:bg-green-500" wire:offline.class='hidden' 
                        {{-- wire:poll.30000ms='syncAll' --}}
                        wire:click='syncAll'
                        wire:loading.class='animate-spin'
                        wire:target='syncOne'>
                    </x-icon.refresh>
                    <x-icon.online 
                        class=" animate-pulse w-12 h-12 text-white rounded-full p-3 bg-green-400 mt-2" 
                        wire:offline.class='hidden' 
                        >
                    </x-icon.online>
                @else
                    <x-icon.offline 
                        class="animate-pulse w-12 h-12 text-white rounded-full p-3 bg-red-400" 
                        >
                    </x-icon.offline>
                @endif
                
            </div>
            <div  >
            </div>
        </div>
    </div>

     <!-- Add/Edit Declaration Modal -->
     <x-modal wire:model.defer="showFormModal">
        <div class="w-full flex justify-center px-2 sm:px-10 pt-5 mb-10">
            <div class="w-full">
                <div class="flex justify-between">
                    <h2 class="text-2xl ">
                        {{ 'Add New Declaration'}}
                    </h2>

                    <x-icon.expand class="w-10 cursor-pointer" title="Open in separete window" wire:click="expandForm"></x-icon.expand>
                </div>
                <div class="mb-4 mx-2 overflow-y-auto h-176">
                    <form wire:submit.prevent="save" method="POST" class="px-2">
                        {{-- Date of Declaration --}}
                        <div class="w-full sm:w-2/3 mt-4">
                            <label for="declared_on" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2 w-full ">
                            Date of Declaration
                            </label>
                            <div class="w-full">

                                <input type="date" wire:model.lazy='declaration.declared_on'  id="declared_on" min="1992-01-01" max='{{date('Y-m-d')}}' class="w-full rounded-md focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                <x-input.error message="{{ $errors->first('declaration.declared_on') }}"></x-input.error>

                            </div>
                        </div>

                        {{-- Name of Declarant --}}
                        <div class="mt-4 w-full">
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
                        {{-- Schedudle of Declarant --}}
                        <label for="schedule" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                        Schedudle
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
      </x-modal>

</div>

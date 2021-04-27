<div>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900">Staff Details</h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-full flex justify-between border-b-2">
                        <div>
                            <h1 class="text-3xl">{{ $staff->full_name }}</h1>
                            <p>Staff ID: {{ $staff->staff_id }}</p>
                        </div>
                        <div class="">
                            <x-button.link wire:click="$toggle('assignOfficeModal')"> <x-icon.plus></x-icon.plus> Assign office</x-button.link>
                            <x-button.link wire:click="$toggle('makeUserModal')"> <x-icon.plus></x-icon.plus> Make User</x-button.link>
                            {{-- <x-button.danger class="ml-5" wire:click="create"> <x-icon.trash></x-icon.trash> Delete Staff Info</x-button.danger> --}}
                        </div>
                    </div>
                    <div class="py-4 space-y-4">
                        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-4">
                            <li x-for="item in items">
                              <a :href="item.url" class="hover:bg-green-500 hover:border-transparent hover:shadow-lg group block rounded-lg p-4 border border-gray-200">
                                <dl class="grid sm:block lg:grid xl:block grid-cols-2 grid-rows-2 items-center">
                                  <div>
                                    <dt class="sr-only">Office</dt>
                                    <dd class="group-hover:text-white text-2xl font-medium text-black">
                                        Office
                                    </dd>
                                  </div>
                                  <div>
                                    <dt class="sr-only">Current Office</dt>
                                    <dd class="group-hover:text-green-200 text-sm font-medium sm:mb-4 lg:mb-0 xl:mb-4"> 
                                    <p>
                                        @if ($staff->offices->count())
                                           
                                            Current Office: {{  $staff->offices->where('end_date', null)->first()->office_name }}
                                            
                                        @else
                                            Office not assigned
                                        @endif
                                     </p>    
                                    </dd>
                                  </div>
                                 
                                </dl>
                              </a>
                            </li>

                            <li x-for="item in items">
                              <a :href="item.url" class="hover:bg-green-500 hover:border-transparent hover:shadow-lg group block rounded-lg p-4 border border-gray-200">
                                <dl class="grid sm:block lg:grid xl:block grid-cols-2 grid-rows-2 items-center">
                                  <div>
                                    <dt class="sr-only">Account</dt>
                                    <dd class="group-hover:text-white text-2xl font-medium text-black">
                                        Account
                                    </dd>
                                  </div>
                                  <div>
                                    <dt class="sr-only">Account Details</dt>
                                    <dd class="group-hover:text-green-200 text-sm font-medium sm:mb-4 lg:mb-0 xl:mb-4">
                                    <p>
                                        @if ($staff->user)
                                            <div class="flex justify-between">

                                                Username: {{ $staff->user->username  }}
                                                <x-button.link wire:click='resetPassword' wire:loading.class='bg-gray-200'> Reset Password </x-button.link>
                                            </div>
                                        @else
                                            Staff is not a user of the application

                                        @endif
                                    </p>
                                        
                                    </dd>
                                  </div>
                                 
                                </dl>
                              </a>
                            </li>
                        </ul>
                       {{-- {{ $staff->offices}}
                       {{ $staff->user}} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal wire:model.defer="assignOfficeModal">
        <div class="w-full flex justify-center px-5 pt-5 pb-10">
            <div class="w-4/5">
                <h2 class="text-2xl ">
                    Assign Office to {{$staff->full_name}}
                </h2>
                
                <form wire:submit.prevent="assignOffice" class="pt-5" method="POST">
                    {{-- Offices --}}
                    <x-input.select placeholder='Select One' :error="$errors->first('office_id')" wire:model.lazy='office_id'>
                        @if ($offices->count())
                            
                            @foreach ($offices as $selectedOffice)
                                <option value="{{$selectedOffice->id}}">{{$selectedOffice->office_name}}</option>
                            @endforeach
                        @endif
                    </x-input.select>

                    <div class="flex items-center justify-end mt-4">
                        <x-button.primary >
                            Assign Office
                        </x-button.primary>
                    </div>
                   
                </form>
            </div>
        </div>
    </x-modal>

    <x-modal wire:model.defer="makeUserModal">
        <div class="w-full flex justify-center px-5 pt-5 pb-10">
            <div class="w-4/5">
                <h2 class="text-2xl ">
                    Make {{$staff->full_name}} a user of this application
                </h2>
                
                <form wire:submit.prevent="makeUser" class="pt-5" method="POST">
                    {{-- Other Names --}}
                    <x-input.group label="Username" for="username" :error="$errors->first('username')">
                        <x-input.text wire:model.lazy="username" id="username" required />
                    </x-input.group>

                    <div class="flex items-center justify-end mt-4">
                        <x-button.primary >
                            Create User
                        </x-button.primary>
                    </div>
                </form>
            </div>
        </div>
    </x-modal>
</div>

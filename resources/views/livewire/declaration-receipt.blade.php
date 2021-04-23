<div class="py-12">
    <div class=" mx-auto sm:px-6 lg:px-8" style="width:7in">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200 bg-gas-logo bg-contain bg-no-repeat bg-center bg-40%" >
                <div class='grid grid-cols-6 bg-white bg-opacity-90'>
                    <div class="col-start-1 col-span-1 m-auto">
                        <img src="{{asset('images/logo.jpg')}}" alt="Ghana Audit Service">
                    </div>
                    <div class="text-center  col-start-2 col-span-4 print:text-black">
                        <h1 class="text-2xl uppercase font-black font-gray-900">Ghana Audit Service</h1>
                        <h3 class="text-sm uppercase">Declaration of Asset and Liability <br/> under article 286 of the 1992 Constitution </h3>
                        <h2 class="text-base uppercase font-bold">Official Receipt</h2>
                        <div class="text-sm pb-2 ">
                            This is to acknowledge receipt of a declaration by:
                        </div>
                    </div>
                    <div class="col-start-6 col-span-1 m-auto">
                    <img src="{{asset('images/coa.png')}}" alt="Ghana Audit Service">
                    </div>
                    <div class='text-sm col-start-1 col-span-6 border-t-2 pt-2 grid grid-cols-3 justify-between' >
                        
                        <div class="col-start-1 col-span-2">
                            <div class="uppercase text-xs">Date: {{ $declaration->declared_on_display }} </div>
                            <div> 
                                <span class="uppercase text-xs">Name:</span>  
                                <p class='text-base font-bold'>{{ Str::title($declaration->declarant_name) }} </p>
                            </div>
                            <div>
                                <span class="uppercase text-xs">Post / Schedule </span> 
                                <p class='text-base font-bold'>
                                    {{ Str::title($declaration->post) }} {{ $declaration->schedule ? ' / '. Str::title($declaration->schedule):'' }}
                                </p>
                            </div>
                        
                            <div >which has been witnessed by: </div>
                            <div>   
                                <p class='text-base font-bold'>{{ Str::title($declaration->witness)}}</p>
                            </div>
                            <div >
                                <span class="uppercase text-xs">Occupation:</span> 
                                <p class='text-base font-bold'>
                                    {{ Str::title($declaration->witness_occupation) }}
                                </p>
                            </div>
                        </div>
                        <div class="col-start-3 col-span-1  ">
                            <div>
                                Receipt No: 
                                <span class="text-base font-bold"> {{$declaration->receipt_no}}</span>
                            </div>
                            <div>
                            <div class="visible-print text-center mt-2 ml-5">
                                {{ QrCode::size(120)->generate($declaration->qrcode)}}
                            </div>
                            </div>
                            <div class="border-t-2 border-dotted mt-10">(for)Auditor General</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3 print:hidden">
            <x-button.primary onclick='window.print(); return false' autofocus> <x-icon.printer></x-icon.printer>&nbsp; Print Receipt</x-button.primary>
        </div>
            
    </div>
</div>

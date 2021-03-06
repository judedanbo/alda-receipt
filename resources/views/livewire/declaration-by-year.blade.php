<div>
    {{-- <p>{{ $declarationByYear }} </p> --}}
    {{-- <p>{{ $declarationByYearLabels }} </p> --}}
    {{-- <br > --}}
    {{-- <p> {{ $declarationByYearLabels }}</p> --}}

    {{-- <br> --}}
    <div
        x-data="{
            serverData : {{$declarationByYear}},
            {{-- data : [] --}}
            {{-- data = this.serverData --}}
            chartData : {{$declarationByYearData}},
            {{-- console.log(chartData); --}}
            {{-- labels : $wire.declarationByYear.keys(), --}}
            {{-- labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'], --}}
            labels: {{$declarationByYearLabels}},
            {{-- MData = JSON.parse( chartData ); --}}

            tooltipContent: '',
            tooltipOpen: false,
            tooltipX: 0,
            tooltipY: 0,
            showTooltip(e) {
            {{-- console.log(e); --}}
            this.tooltipContent = e.target.textContent
            this.tooltipX = e.target.offsetLeft - e.target.clientWidth;
            this.tooltipY = e.target.clientHeight + e.target.clientWidth;
            },
            hideTooltip(e) {
            this.tooltipContent = '';
            this.tooltipOpen = false;
            this.tooltipX = 0;
            this.tooltipY = 0;
            }

        }"
        {{-- x-init="
          {{-- for(data in serverData){ --}}
            {{-- labels = serverData --}}
            {{-- chartData.push(data['Number']) --}}
          {{-- } --}} --}}
        "
        x-cloak class="px-4">
        <div class="max-w-lg mx-auto py-10">
          <div class="shadow p-6 rounded-lg bg-white">
            <div class="md:flex md:justify-between md:items-center">
              <div>
                <h2 class="text-xl text-gray-800 font-bold leading-tight">Total Yearly Declarations</h2>
                <p class="mb-2 text-gray-600 text-sm">Total Declarations</p>
              </div>

              <!-- Legends -->
              <div class="mb-4">
                <div class="flex items-center">
                  <div class="w-2 h-2 bg-blue-600 mr-2 rounded-full"></div>
                  <div class="text-sm text-gray-700">Declarations</div>
                </div>
              </div>
            </div>


            <div class="line my-8 relative">
              <!-- Tooltip -->
              <template x-if="tooltipOpen == true">
                <div x-ref="tooltipContainer" class="p-0 m-0 z-10 shadow-lg rounded-lg absolute h-auto block"
                     :style="`bottom: ${tooltipY}px; left: ${tooltipX}px`"
                     >
                  <div class="shadow-xs rounded-lg bg-white p-2">
                    <div class="flex items-center justify-between text-sm">
                      <div>Declarations:</div>
                      <div class="font-bold ml-2">
                        <span x-html="tooltipContent"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </template>

              <!-- Bar Chart -->

              <div class="flex -mx-2 items-end mb-2">
                <template x-for="data in chartData">

                  <div class="px-2 w-1/6">
                    <div :style="`height: ${data}px`"
                         class="transition ease-in duration-200 bg-blue-600 hover:bg-blue-400 relative"
                         @mouseenter="showTooltip($event); tooltipOpen = true"
                         @mouseleave="hideTooltip($event)"
                         >

                      <div x-text="data" class="text-center absolute top-0 left-0 right-0 -mt-6 text-gray-800 text-sm"></div>
                    </div>
                  </div>

                </template>
              </div>

              <!-- Labels -->
              <div class="border-t border-gray-400 mx-auto" :style="`height: 1px; width: ${ 100 - 1/chartData.length*100 + 3}%`"></div>
              <div class="flex -mx-2 items-end">
                <template x-for="data in labels">
                  <div class="px-2 w-1/6">
                    <div class="bg-red-600 relative">
                      <div class="text-center absolute top-0 left-0 right-0 h-2 -mt-px bg-gray-400 mx-auto" style="width: 1px"></div>
                      <div x-text="data" class="text-center absolute top-0 left-0 right-0 mt-3 text-gray-700 text-sm"></div>
                    </div>
                  </div>
                </template>
              </div>

            </div>
          </div>
        </div>
      </div>

    {{-- <p>
        {{ $declarationByYearMonth}}
    </p>

    <p>
        {{ $declarationByMonth }}
    </p>

    <div>
        by user
        <p>
            {{ $declarationByUser }}
        </p>
    </div>

    <div>
        by office
        <p>
            {{ $declarationByOffice }}
        </p>
    </div>
    <div>
        by post
        <p>
            {{ $declarationByPost }}
        </p>
    </div>
    <div>Schedule
        <p>
            {{ $declarationBySchedule }}
        </p>
    </div> --}}
</div>

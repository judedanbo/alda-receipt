<div>
    @if (Auth::user()->id == 1)
        {{-- {{ $post }} --}}
        {{-- @foreach ($schedule as $schedule_item)
            <div>{{ $schedule_item->schedule }} : {{$schedule_item->schedule_count}}</div>
        @endforeach --}}
        <div class="w-full border flex flex-wrap gap-4">
            <div class="w-1/3">
                <h1 class="leading w-full py-2 bg-red-200 text-center">Post Summary</h1>
                <table class="table p-4 bg-white shadow rounded-lg w-full">
                    <thead>
                        <tr>
                            <th class="border-b-2 p-4 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900">
                                #
                            </th>
                            <th class="border-b-2 p-4 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900">
                                Post
                            </th>
                            <th class="border-b-2 p-4 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900">
                                Number
                            </th>
                        </tr>
                    </thead>
                    <tbody x-data="{show_more : false}">
                        @php
                            $table_counter = 0;
                        @endphp
                        @foreach ($post as $post_item)
                            <tr wire:click="gotoResult('{{ $post_item->post }}')"
                                class=" text-sm text-gray-700 hover:bg-gray-200  cursor-pointer
                            ">
                                <td class="border-b-2 p-4 dark:border-dark-5">
                                    {{ ++$table_counter }}
                                </td>
                                <td class="border-b-2 p-4 dark:border-dark-5">
                                    {{ $post_item->post }}
                                </td>
                                <td class="border-b-2 p-4 dark:border-dark-5 text-right">
                                    {{ number_format($post_item->post_count) }}
                                </td>
                            </tr>

                            @if ($table_counter == 5)
                            @break
                        @endif
                    @endforeach
                    <tr class="text-gray-700">
                        <td @click="show_more = !show_more" colspan="3"
                            class="text-green-600 border-b-2 p-4 dark:border-dark-5 text-right cursor-pointer hover:text-green-800 hover:text-bold">
                            <span x-show="!show_more">Show all rows</span>
                            <span x-show="show_more">Show only top 5 rows</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="w-1/3">
            <h1 class="leading w-full py-2 bg-green-200 text-center">Schedule Summary</h1>
            <table class="table p-4 bg-white shadow rounded-lg w-full">
                <thead>
                    <tr>
                        <th class="border-b-2 p-4 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900">
                            #
                        </th>
                        <th class="border-b-2 p-4 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900">
                            Schedule
                        </th>
                        <th class="border-b-2 p-4 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900">
                            Number
                        </th>
                    </tr>
                </thead>
                <tbody x-data="{show_more : false}">
                    @php
                        $table_counter = 0;
                    @endphp
                    @foreach ($schedule as $schedule_item)
                        <tr wire:click="gotoResult('{{ $schedule_item->schedule }}')"
                            @if ($table_counter >= 5) @break @endif
                            class=" text-sm text-gray-700 hover:bg-gray-200  cursor-pointer
                            ">
                            <td class="border-b-2 p-4 dark:border-dark-5">
                                {{ ++$table_counter }}
                            </td>
                            <td class="border-b-2 p-4 dark:border-dark-5">
                                {{ $schedule_item->schedule }}
                            </td>
                            <td class="border-b-2 p-4 dark:border-dark-5 text-right">
                                {{ number_format($schedule_item->schedule_count) }}
                            </td>
                        </tr>
                        @if ($table_counter == 5)
                        @break
                    @endif
                @endforeach
                <tr class="text-gray-700">
                    <td @click="show_more = !show_more" colspan="3"
                        class="text-green-600 border-b-2 p-4 dark:border-dark-5 text-right cursor-pointer hover:text-green-800 hover:text-bold">
                        <span x-show="!show_more">Show all rows</span>
                        <span x-show="show_more">Show only top 5 rows</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="w-1/4 ">
        <h1 class="heading w-full py-2 bg-blue-200 text-center">Year of Declaration Summary</h1>
        <table class="table p-4 bg-white shadow rounded-lg w-full">
            <thead>
                <tr>
                    <th class="border-b-2 p-4 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900">
                        #
                    </th>
                    <th class="border-b-2 p-4 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900">
                        Year
                    </th>
                    <th class="border-b-2 p-4 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900">
                        Number
                    </th>
                </tr>
            </thead>
            <tbody x-data="{show_more : false}">
                @php
                    $table_counter = 0;
                @endphp
                @foreach ($year as $year_declared)
                    <tr wire:click="gotoResult('{{ $year_declared->year_declared }}')"
                        @if ($table_counter == 5) @break @endif
                        class=" text-sm text-gray-700 hover:bg-gray-200  cursor-pointer
                            ">
                        <td class="border-b-2 p-4 dark:border-dark-5">
                            {{ ++$table_counter }}
                        </td>
                        <td class="border-b-2 p-4 dark:border-dark-5">
                            {{ $year_declared->year_declared }}
                        </td>
                        <td class="border-b-2 p-4 dark:border-dark-5 text-right">
                            {{ number_format($year_declared->year_declared_count) }}
                        </td>
                    </tr>
                    @if ($table_counter == 5)
                    @break
                @endif
            @endforeach
            <tr class="text-gray-700">
                <td @click="show_more = !show_more" colspan="3"
                    class="text-green-600 border-b-2 p-4 dark:border-dark-5 text-right cursor-pointer hover:text-green-800 hover:text-bold">
                    <span x-show="!show_more">Show all rows</span>
                    <span x-show="show_more">Show only top 5 rows</span>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="w-1/4 ">
    <h1 class=" text-center py-2 bg-purple-200 ">Month of Declaration Summary</h1>
    <table class="table p-4  bg-white shadow rounded-lg w-full">
        <thead>
            <tr>
                <th class="border-b-2 p-4 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900">
                    #
                </th>
                <th class="border-b-2 p-4 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900">
                    Month
                </th>
                <th class="border-b-2 p-4 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900">
                    Number
                </th>
            </tr>
        </thead>
        <tbody x-data="{show_more : false}">
            @php
                $table_counter = 0;
            @endphp
            @foreach ($month as $month_declared)
                <tr wire:click="gotoResult('{{ $month_declared->month_declared }}')"
                    @if ($table_counter == 5) @break @endif
                    class=" text-sm text-gray-700 hover:bg-gray-200  cursor-pointer
                            ">
                    <td class="border-b-2 p-4 dark:border-dark-5">
                        {{ ++$table_counter }}
                    </td>
                    <td class="border-b-2 p-4 dark:border-dark-5">
                        {{ $month_declared->month_declared }}
                    </td>
                    <td class="border-b-2 p-4 dark:border-dark-5 text-right">
                        {{ number_format($month_declared->month_declared_count) }}
                    </td>
                </tr>
                @if ($table_counter == 5)
                @break
            @endif
        @endforeach
        <tr class="text-gray-700">
            <td @click="show_more = !show_more" colspan="3"
                class="text-green-600 border-b-2 p-4 dark:border-dark-5 text-right cursor-pointer hover:text-green-800 hover:text-bold">
                <span x-show="!show_more">Show all rows</span>
                <span x-show="show_more">Show only top 5 rows</span>
            </td>
        </tr>
    </tbody>
</table>
</div>
</div>
@endif
</div>

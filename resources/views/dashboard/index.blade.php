@extends('layout.main')
@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">

        <div class="flex justify-between bg-green-600 shadow-sm border border-gray-300 rounded-lg p-6">
            <div>
                <p class="mb-4 text-white">Total Orders</p>
                <p class="text-white text-3xl font-semibold">{{ $orderItemCount }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="size-16 text-white opacity-30 float-end align-bottom">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
        </div>

        <div class="flex justify-between bg-green-600 shadow-sm border border-gray-300 rounded-lg p-6">
            <div>
                <p class="mb-4 text-white">Total Sales</p>
                <p class="text-white text-3xl font-semibold">{{ $total_sale . ' Ks' }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-16 text-white opacity-30">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </div>

        <div class="flex justify-between bg-green-600 shadow-sm border border-gray-300 rounded-lg p-6">
            <div>
                <p class="mb-4 text-white">Total Dishes</p>
                <p class="text-white text-3xl font-semibold">{{ $itemCount }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-16 text-white opacity-30">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
            </svg>
        </div>

        <div class="flex justify-between bg-green-600 shadow-sm border border-gray-300 rounded-lg p-6">
            <div>
                <p class="mb-4 text-white">Total Customers</p>
                <p class="text-white text-3xl font-semibold">{{ $orderCount }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-16 text-white opacity-30">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>
        </div>

    </div>
    {{-- Chart and new Order List Section --}}
    <section class="flex gap-4 mb-4">
        <div class="w-1/3 bg-white flex flex-col rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
            <div>
                <h4 class="mb-4 text-md font-bold text-gray-600 dark:text-gray-300">Total income in last 7 days</h4>
                <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{ $totalSale . ' Ks' }}
                </h5>
                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Sales this week</p>
            </div>

            <div id="labels-chart" class="mt-auto"></div>
        </div>
        <div class="w-1/3 bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
            <h4 class="mb-4 text-md font-bold text-gray-600 dark:text-gray-300">Customer Satisfaction Analysis</h4>
            <div id="feedback-chart"></div>
        </div>
        <div class="w-1/3 p-6 NewOrderTable bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <h4 class="mb-4 text-md font-bold text-gray-600 dark:text-gray-300">New Orders</h4>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="!px-4 py-3">Table</th>
                            <th class="!px-4 py-3">Order Time</th>
                            <th class="!px-4 py-3">Total</th>
                            <th class="!px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3">{{ $order->table->name }}</td>
                                <td class="px-4 py-3">{{ $order->created_at->format('h:i A') }}</td>
                                <td class="px-4 py-3">{{ $order->total_price . ' Ks' }}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <a href="{{ route('orders.show', $order->id) }}"
                                        class="border border-gray-400 inline-flex items-center px-1 py-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-md focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                        type="button">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    {{-- Hot Items --}}
    <section class="flex gap-4 mb-4">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden w-1/2 p-6">
            <h4 class="mb-4 text-md font-bold text-gray-600 dark:text-gray-300">Hot Items</h4>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="!px-4 py-3">Dish</th>
                            <th class="!px-4 py-3">Total Ordered</th>
                            <th class="!px-4 py-3">Total Income</th>
                            <th class="!px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hotItems as $item)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ Str::startsWith($item->photo, 'http') ? $item->photo : url('images/' . $item->photo) }}"
                                            class="w-10 aspect-square rounded-md">
                                        <span>{{ $item->name }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">{{ $item->total_ordered }}</td>
                                <td class="px-4 py-3">{{ $item->price * $item->total_ordered . ' Ks' }}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <a href="{{ route('items.show', $item->id) }}"
                                        class="border border-gray-400 inline-flex items-center px-1 py-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-md focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                        type="button">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden w-1/2 p-6">
            <h4 class="mb-4 text-md font-bold text-gray-600 dark:text-gray-300">Latest Dishes</h4>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="!px-4 py-3">Dish</th>
                            <th class="!px-4 py-3">Price</th>
                            <th class="!px-4 py-3">Category</th>
                            <th class="!px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($latest_items as $item)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ asset('images/' . $item->photo) }}"
                                            class="w-10 aspect-square rounded-md">
                                        <span>{{ $item->name }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">{{ $item->price . ' Ks' }}</td>
                                <td class="px-4 py-3">{{ $item->category->name }}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <a href="{{ route('items.show', $item->id) }}"
                                        class="border border-gray-400 inline-flex items-center px-1 py-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-md focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                        type="button">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        const options = {
            // set the labels option to true to show the labels on the X and Y axis
            xaxis: {
                show: true,
                categories: [
                    "{{ $last7Days[0] }}",
                    "{{ $last7Days[1] }}",
                    "{{ $last7Days[2] }}",
                    "{{ $last7Days[3] }}",
                    "{{ $last7Days[4] }}",
                    "{{ $last7Days[5] }}",
                    "{{ $last7Days[6] }}",
                ],
                labels: {
                    show: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                    }
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                show: true,
                labels: {
                    show: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                    },
                    formatter: function(value) {
                        return value;
                    }
                }
            },
            series: [{
                name: "Sales in last 7 days.",
                data: {{ $last7DaysIncomeArray }},
                color: "#16a34a",
            }, ],
            chart: {
                type: 'area',
                stacked: false,
                height: 230,
                zoom: {
                    type: 'x',
                    enabled: true,
                    autoScaleYaxis: true
                },
                toolbar: {
                    autoSelected: 'zoom'
                }
            },
            tooltip: {
                enabled: true,
                x: {
                    show: false,
                },
            },
            fill: {
                type: "gradient",
                gradient: {
                    opacityFrom: 0.55,
                    opacityTo: 0,
                    shade: "#1C64F2",
                    gradientToColors: ["#1C64F2"],
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                width: 6,
            },
            legend: {
                show: false
            },
            grid: {
                show: false,
            },
        }
        if (document.getElementById("labels-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("labels-chart"), options);
            chart.render();
        }
    </script>

    <script>
        var ratingDistribution = @json(array_values($ratingDistribution));

        var colors = [
            "#16a34a",
            "#16a34a",
            "#16a34a",
            "#16a34a",
            "#16a34a",
        ];
        var feedback_options = {
            series: [{
                data: ratingDistribution
            }],
            chart: {
                height: '100%',
                type: 'bar',
                events: {
                    click: function(chart, w, e) {
                        // console.log(chart, w, e)
                    }
                }
            },
            colors: colors,
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true,
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            xaxis: {
                categories: [
                    '1 Star',
                    '2 Star',
                    '3 Star',
                    '4 Star',
                    '5 Star',
                ],
                labels: {
                    style: {
                        colors: colors,
                        fontSize: '12px'
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#feedback-chart"), feedback_options);
        chart.render();
    </script>
@endsection

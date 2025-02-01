@extends('layout.main')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.tailwindcss.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css">
    <section class="bg-white dark:bg-gray-900 shadow rounded-md p-6 mb-4">
        <div class="bg-white dark:bg-gray-800 relative sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 pb-4">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Filter By date</h2>
            </div>
            <div class="">
                <form action="{{ route('filter-datas') }}" method="get" id="filter_form">
                    <div class="flex gap-2">
                        <a href="{{ route('reports.index') }}"
                            class="{{ request()->is('reports') ? 'text-green-600 border-green-600' : '' }} py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            All
                        </a>
                        <button
                            class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            type="submit" name="filter" value="last_week">
                            Last Week
                        </button>
                        <button
                            class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            type="submit" name="filter" value="last_month">
                            Last Month
                        </button>
                        <button
                            class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            type="submit" name="filter" value="last_year">
                            Last Year
                        </button>
                    </div>

                    <div id="date-range-picker" date-rangepicker class="flex flex-col mt-4">
                        <span class="text-gray-500 mb-2 mx-1">Start Date</span>
                        <div class="relative mb-3">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="datepicker-range-start" name="start_date" type="text" readonly
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Select start date" value="{{ request('start_date') }}">
                        </div>

                        <span class="text-gray-500 mb-2 mx-1">End Date</span>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="datepicker-range-end" name="end_date" type="text" readonly
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Select end date" value="{{ request('end_date') }}">
                        </div>
                    </div>
                    <button type="submit" name="filter" value="custom"
                        class="w-[200px] float-end mt-3 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Filter
                    </button>
                </form>
            </div>
        </div>
    </section>
    <section class="bg-white dark:bg-gray-900 shadow rounded-md p-6 h-screen">
        <div class="bg-white dark:bg-gray-800 relative sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 pb-4">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Order Histories</h2>
            </div>
            <div class="card bg-white text-gray-600 mb-4">
                <div class="card-body">
                    <div class="overflow-x-auto">
                        <table id="statement_table" class="table w-full">
                            <thead>
                                <tr>
                                    <th class="!px-4">
                                        <div class="flex items-center flex-nowrap">
                                            <span>Date</span>
                                        </div>
                                    </th>
                                    <th class="!px-4">
                                        <div class="flex items-center flex-nowrap">
                                            <span>Total Customer</span>
                                        </div>
                                    </th>
                                    <th class="!px-4">
                                        <div class="flex items-center flex-nowrap">
                                            <span>Total Income</span>
                                        </div>
                                    </th>
                                    <th class="!px-4">
                                        <div class="flex items-center flex-nowrap">
                                            <span>Best Seller Dish</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dailyReport as $report)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="px-4">
                                            <div class="flex items-center">
                                                <span>{{ $report->order_date }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4">
                                            {{ $report->total_orders }}
                                        </td>
                                        <td class="px-4">
                                            {{ $report->total_income . ' Ks' }}
                                        </td>
                                        <td class="px-4">
                                            {{ $report->total_income }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.tailwindcss.js"></script>

    <!-- DataTable JS -->
    <script src="https://cdn.datatables.net/2.1.8/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>

    <!-- Initialize DataTable -->

    <script>
        $(document).ready(function() {
            new DataTable('#total_table', {
                searching: false,
                paging: false,
                info: false,
                ordering: false,
            });
            const dateColumns = [ /* Add the index(es) of your date column(s) here */ ];

            function formatDate(data) {
                const date = new Date(data);
                if (!isNaN(date)) {
                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const day = String(date.getDate()).padStart(2, '0');
                    return `${year}-${month}-${day}`;
                }
                return data; // Return original value if not a valid date
            }

            new DataTable('#statement_table', {
                pageLength: 25,
                order: [
                    [0, 'desc']
                ],
                layout: {
                    topStart: {
                        buttons: [{
                                extend: 'csv',
                                text: 'CSV (Excel)',
                                customizeData: function(data) {
                                    // Adjust date columns during export
                                    data.body.forEach(row => {
                                        dateColumns.forEach(index => {
                                            row[index] = formatDate(row[index]);
                                        });
                                    });
                                },
                            },
                            {
                                extend: 'pdfHtml5',
                                text: 'PDF File',
                                customize: function(doc) {
                                    doc.content[0].text =
                                        'Reports From {{ request('start_date', now()->subDays(14)->format('Y-m-d')) }} To {{ request('end_date', now()->format('Y-m-d')) }}'; // Replace with your desired title
                                    doc.content[0].alignment = 'center'; // Keep it center-aligned
                                    doc.pageMargins = [30, 30, 30, 30]; // Adjust page margins
                                    doc.content[1].table.widths = Array(doc.content[1].table.body[0]
                                        .length).fill('*');
                                    doc.styles.tableHeader = {
                                        fillColor: '#3b82f6',
                                        color: '#FFFFFF',
                                        alignment: 'start',
                                        fontSize: 12,
                                        bold: true
                                    };
                                    doc.styles.tableBodyEven = {
                                        fillColor: '#F7FAFC'
                                    };
                                    doc.styles.tableBodyOdd = {
                                        fillColor: '#FFFFFF'
                                    };
                                    doc.defaultStyle.fontSize = 10;

                                    doc.content[1].table.body.forEach(function(row) {
                                        row.forEach(function(cell) {
                                            cell.alignment = 'start';
                                            cell.noWrap = false;
                                        });
                                    });
                                }
                            },
                        ]
                    }
                }
            });
        });
    </script>
@endsection

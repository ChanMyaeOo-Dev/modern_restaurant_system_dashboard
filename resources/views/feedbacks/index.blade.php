@extends('layout.main')

@section('content')
    <section class="bg-white dark:bg-gray-900 shadow rounded-md p-6">
        <div class="bg-white dark:bg-gray-800 relative sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 pb-4">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">All Feedbacks</h2>
                <!-- Additional buttons and dropdowns -->
                <div
                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button data-modal-target="summarize-modal" data-modal-toggle="summarize-modal"
                        class="block w-full md:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">
                        <div class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="h-3.5 w-3.5 mr-2">
                                <path fill-rule="evenodd"
                                    d="M9.315 7.584C12.195 3.883 16.695 1.5 21.75 1.5a.75.75 0 0 1 .75.75c0 5.056-2.383 9.555-6.084 12.436A6.75 6.75 0 0 1 9.75 22.5a.75.75 0 0 1-.75-.75v-4.131A15.838 15.838 0 0 1 6.382 15H2.25a.75.75 0 0 1-.75-.75 6.75 6.75 0 0 1 7.815-6.666ZM15 6.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M5.26 17.242a.75.75 0 1 0-.897-1.203 5.243 5.243 0 0 0-2.05 5.022.75.75 0 0 0 .625.627 5.243 5.243 0 0 0 5.022-2.051.75.75 0 1 0-1.202-.897 3.744 3.744 0 0 1-3.008 1.51c0-1.23.592-2.323 1.51-3.008Z" />
                            </svg>
                            Summerize With AI
                        </div>
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto {{ count($feedbacks) > 0 ? '' : 'hidden' }}">
                <table id="search-table" class="w-full">
                    <thead>
                        <tr>
                            <th class="!px-4">
                                <div class="flex items-center flex-nowrap">
                                    <span>No.</span>
                                </div>
                            </th>
                            <th class="!px-4">
                                <div class="flex items-center flex-nowrap">
                                    <span>Date</span>
                                </div>
                            </th>
                            <th class="!px-4">
                                <div class="flex items-center flex-nowrap">
                                    <span>Message</span>
                                </div>
                            </th>
                            <th class="!px-4">
                                <div class="flex items-center flex-nowrap">
                                    <span>Rating</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbacks as $index => $feedback)
                            <tr class="border-b border-gray-200 hover:bg-gray-100 text-gray-500">
                                <td class="px-4">
                                    {{ $index + 1 . '.' }}
                                </td>
                                <td class="px-4">
                                    <div class="flex items-center">
                                        <span>{{ $feedback['created_at']->format('d/m/Y') }}</span>
                                    </div>
                                </td>
                                <td class="px-4">
                                    {{ $feedback['message'] }}
                                </td>
                                <td class="px-4">
                                    <div class="flex items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $feedback['rating'])
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="size-4 text-yellow-400">
                                                    <path fill-rule="evenodd"
                                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="size-4 text-gray-200">
                                                    <path fill-rule="evenodd"
                                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        @endfor
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Extra Large Modal -->
            <div id="summarize-modal" tabindex="-1"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-4xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                            <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                Customer's feedbacks summarize in the last 30 days
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="summarize-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <div id="loading" class="flex flex-col items-center justify-center w-full h-full">
                                <img src="{{ asset('gifs/loading.gif') }}" alt="Example GIF"
                                    style="width: 100px; height: auto;">
                                <p class="mt-2 text-sm text-gray-500">
                                    Scanning feedback...
                                </p>
                            </div>
                            <div class="mb-5 pb-5 px-36 hidden border-b" id="chart_canvas">
                                <canvas id="ratingChart" width="300" height="200"></canvas>
                            </div>
                            <p class="text-gray-700 fw-bold text-justify px-4" id="modal-content"></p>
                        </div>
                        <!-- Modal footer -->
                        <div
                            class="flex items-center justify-end p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button id="re_summarize" type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Re-Summarize
                            </button>
                            <button data-modal-hide="summarize-modal" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
            const dataTable = new simpleDatatables.DataTable("#search-table", {
                searchable: true,
                sortable: false,
                perPage: 30, // Limit the table to 30 rows per page
                perPageSelect: [10, 20, 30, 50, 100] // Optional: Add a dropdown for rows per page
            });
        }
    </script>
    <script src="{{ url('js/libs/typewriter.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalTrigger = document.querySelector('[data-modal-target="summarize-modal"]');
            const modalContent = document.getElementById('modal-content');
            const loading = document.getElementById('loading');
            const chart_canvas = document.getElementById('chart_canvas');
            const re_summarize = document.getElementById('re_summarize');
            let ratingChart = null; // Variable to store the chart instance

            // Add click event listener to the modal trigger button
            modalTrigger.addEventListener('click', function() {
                fetchMessage();
            });

            re_summarize.addEventListener('click', function() {
                fetchMessage();
            });

            let fetchMessage = () => {
                fetch('{{ route('summarize-feedback') }}')
                    .then(response => response.json())
                    .then(data => {
                        loading.classList.add('hidden');
                        renderRatingChart(data.ratingDistribution)
                        var onRemoveNode = function({
                            character
                        }) {
                            typewriter.stop();
                            chart_canvas.classList.remove('hidden');
                        }
                        let typewriter = new Typewriter('#modal-content', {
                            strings: [data.summary + " "],
                            autoStart: true,
                            loop: false,
                            delay: 10,
                            onRemoveNode: onRemoveNode,
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        modalContent.innerText = 'Failed to load data.';
                    });
            }

            // Function to render the bar chart
            function renderRatingChart(ratingDistribution) {
                const ctx = document.getElementById('ratingChart').getContext('2d');
                if (ratingChart) {
                    ratingChart.destroy();
                }
                ratingChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'],
                        datasets: [{
                            label: 'Number of Ratings',
                            data: Object.values(ratingDistribution),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    </script>
@endsection

@extends('layout.main')

@section('content')
    <section class="h-screen pb-10 flex gap-4">
        <div class="bg-white dark:bg-gray-900 shadow rounded-md p-6 h-full w-2/3">
            <div
                class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 pb-4 border-b mb-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('orders.index') }}" class="border border-gray-300 rounded-md p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                            <path fill-rule="evenodd"
                                d="M7.72 12.53a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 1 1 1.06 1.06L9.31 12l6.97 6.97a.75.75 0 1 1-1.06 1.06l-7.5-7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $order->table->name }}
                    </h2>
                </div>
                <div
                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="{{ $order->is_completed ? 'hidden' : '' }} flex items-center justify-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-5 me-1">
                                <path fill-rule="evenodd"
                                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                    clip-rule="evenodd" />
                            </svg>
                            Order Complete
                        </button>
                        <div
                            class="{{ $order->is_completed ? '' : 'hidden' }} flex items-center justify-center text-white bg-gray-300 font-medium rounded-lg text-sm px-4 py-2 ">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-5 me-1">
                                <path fill-rule="evenodd"
                                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                    clip-rule="evenodd" />
                            </svg>
                            Order Completed
                        </div>
                    </form>
                </div>
            </div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg text-gray-900 dark:text-white">Order Items</h2>
            </div>
            <div class="grid gap-4 grid-cols-4 w-full mb-4">
                @foreach ($order_items as $order_item)
                    <div class="bg-white rounded-md shadow p-4 md:p-5">
                        <img src="{{ Str::startsWith($order_item->item->photo, 'http') ? $order_item->item->photo : asset('images/' . $order_item->item->photo) }}"
                            class="rounded shadow-md mb-3">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-4 me-2">
                                <path fill-rule="evenodd"
                                    d="M4.5 7.5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="text-lg">{{ $order_item->item->name }}</p>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-4 me-2">
                                <path
                                    d="M11.644 1.59a.75.75 0 0 1 .712 0l9.75 5.25a.75.75 0 0 1 0 1.32l-9.75 5.25a.75.75 0 0 1-.712 0l-9.75-5.25a.75.75 0 0 1 0-1.32l9.75-5.25Z" />
                                <path
                                    d="m3.265 10.602 7.668 4.129a2.25 2.25 0 0 0 2.134 0l7.668-4.13 1.37.739a.75.75 0 0 1 0 1.32l-9.75 5.25a.75.75 0 0 1-.71 0l-9.75-5.25a.75.75 0 0 1 0-1.32l1.37-.738Z" />
                                <path
                                    d="m10.933 19.231-7.668-4.13-1.37.739a.75.75 0 0 0 0 1.32l9.75 5.25c.221.12.489.12.71 0l9.75-5.25a.75.75 0 0 0 0-1.32l-1.37-.738-7.668 4.13a2.25 2.25 0 0 1-2.134-.001Z" />
                            </svg>
                            <p class="">{{ $order_item->quantity . ' Items' }}</p>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-4 me-2">
                                <path fill-rule="evenodd"
                                    d="M4.804 21.644A6.707 6.707 0 0 0 6 21.75a6.721 6.721 0 0 0 3.583-1.029c.774.182 1.584.279 2.417.279 5.322 0 9.75-3.97 9.75-9 0-5.03-4.428-9-9.75-9s-9.75 3.97-9.75 9c0 2.409 1.025 4.587 2.674 6.192.232.226.277.428.254.543a3.73 3.73 0 0 1-.814 1.686.75.75 0 0 0 .44 1.223ZM8.25 10.875a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25ZM10.875 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875-1.125a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="">{{ $order_item->comment ? $order_item->comment : '...' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- Invoice --}}
        <div id="invoice_div" class="bg-white dark:bg-gray-900 shadow rounded-md p-6 h-full w-1/3">
            <div class="flex flex-col md:flex-row items-center pb-4 border-b mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 me-2">
                    <path fill-rule="evenodd"
                        d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z"
                        clip-rule="evenodd" />
                    <path
                        d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                </svg>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                    Invoice
                </h2>
            </div>
            <div class="flex items-center justify-between mb-4 pb-4 border-b">
                <p class="text-gray-900 dark:text-white">Table :</p>
                <p class="text-gray-900 dark:text-white">{{ $order->table->name }}</p>
            </div>
            @foreach ($order_items as $order_item)
                <div class="flex items-center justify-between mb-4 w-full">
                    <p class="text-gray-900 dark:text-white">{{ $order_item->quantity . ' x ' . $order_item->item->name }}
                    </p>
                    <p class="text-gray-900 dark:text-white">{{ $order_item->item->price * $order_item->quantity . ' Ks' }}
                    </p>
                </div>
            @endforeach
            <div class="flex items-center justify-between mb-4 py-4 border-t border-b">
                <p class="text-gray-900 dark:text-white text-lg font-bold">Total :</p>
                <p class="text-gray-900 dark:text-white text-lg font-bold">{{ $order->total_price . ' Ks' }}</p>
            </div>
            <button onclick="printContent('invoice_div')"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full">
                Print
            </button>
        </div>
    </section>
    <script>
        function printContent(invoice_div) {
            var content = document.getElementById(invoice_div).innerHTML;
            var originalContent = document.body.innerHTML;
            document.body.innerHTML = content;
            window.print();
            document.body.innerHTML = originalContent;
            location.reload(); // Reload the page to restore original content
        }
    </script>
@endsection

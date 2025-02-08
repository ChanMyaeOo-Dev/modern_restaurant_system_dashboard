@extends('layout.main')

@section('content')
    <section class="h-screen pb-10 flex gap-4">
        <div class="bg-white dark:bg-gray-900 shadow rounded-md p-6 h-full w-full">
            <div
                class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 pb-4 border-b mb-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('items.index') }}" class="border border-gray-300 rounded-md p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                            <path fill-rule="evenodd"
                                d="M7.72 12.53a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 1 1 1.06 1.06L9.31 12l6.97 6.97a.75.75 0 1 1-1.06 1.06l-7.5-7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        Dish Detail
                    </h2>
                </div>
            </div>
            <div class="w-full">
                <img src="{{ Str::startsWith($item->photo, 'http') ? $item->photo : url('images/' . $item->photo) }}"
                    class="rounded shadow-md w-[300px] mb-3">
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 w-full mb-4">
                    <div class="sm:col-span-2">
                        <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item Name</p>
                        <p
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                            {{ $item->name }}
                        </p>
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 w-full">
                    <div>
                        <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</p>
                        <p
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                            {{ $item->category->name }}
                        </p>
                    </div>
                    <div class="w-full">
                        <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</p>
                        <p
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                            {{ $item->price . ' Ks' }}
                        </p>
                    </div>
                    <div class="sm:col-span-2">
                        <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</p>
                        <p
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                            {{ $item->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

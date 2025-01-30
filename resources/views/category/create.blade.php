@extends('layout.main')

@section('content')
    <section class="bg-white dark:bg-gray-900 shadow rounded-md p-6">
        <div class="">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Add a new Category</h2>
                <a href="{{ route('categories.index') }}" type="button"
                    class="flex items-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm p-3 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 me-2">
                        <path fill-rule="evenodd"
                            d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
                            clip-rule="evenodd" />
                    </svg>
                    Show All Categories
                </a>
            </div>
            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col items-end">
                    {{-- DropZone --}}
                    <div class="flex items-center gap-4 h-[240px] w-full mb-4">
                        <div id="preview" class="hidden h-full aspect-square"></div>
                        <div class="w-full h-full">
                            <div id="drop-area"
                                class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <input type="file" name="photo" id="fileElem" class="hidden" accept="image/*"
                                    onchange="handleFiles(this.files)">
                                <label for="fileElem" class="cursor-pointer">
                                    <div id="drop-text" class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Click
                                                to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF
                                            (Recomended.
                                            800x800px - Ratio 1:1)
                                        </p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    {{-- DropZone --}}
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 w-full">
                        <div class="sm:col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                                Name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                placeholder="Type Item name" required="">
                        </div>

                    </div>
                    <button type="submit"
                        class="px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-green-700 rounded-lg focus:ring-4 focus:ring-green-200 dark:focus:ring-green-900 hover:bg-green-800">
                        Add Cateogry
                    </button>
                </div>
            </form>
        </div>
    </section>
    <script>
        let dropArea = document.getElementById('drop-area');
        let fileElem = document.getElementById('fileElem');
        let dropText = document.getElementById('drop-text');
        let preview = document.getElementById('preview');

        dropArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropArea.classList.add('!border-blue-500');
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('!border-blue-500');
        });

        dropArea.addEventListener('drop', (event) => {
            event.preventDefault();
            dropArea.classList.remove('!border-blue-500');
            let files = event.dataTransfer.files;
            handleFiles(files);
        });

        function handleFiles(files) {
            preview.classList.remove('hidden');
            fileElem.files = files;
            preview.innerHTML = "";
            const img = document.createElement("img");
            img.src = URL.createObjectURL(files[0]);
            img.className = "h-full w-full object-cover rounded-lg";
            preview.appendChild(img);
        }
    </script>
@endsection

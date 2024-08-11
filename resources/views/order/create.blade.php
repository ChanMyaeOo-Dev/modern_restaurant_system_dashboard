@extends('layout.main')

@section('content')
    <section class="flex gap-4">
        <div class="bg-white dark:bg-gray-900 shadow rounded-md p-6 w-full">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Add a new Item</h2>
                <a href="{{ route('items.index') }}" type="button"
                    class="flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm p-3 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 me-2">
                        <path fill-rule="evenodd"
                            d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
                            clip-rule="evenodd" />
                    </svg>
                    Show All Items
                </a>
            </div>
            <div class="grid gap-4 grid-cols-4 w-full">
                @foreach ($items as $item)
                    <div class="bg-white rounded-md shadow p-4 md:p-5">
                        <img src="{{ $item->photo }}" class="rounded shadow-md mb-3">
                        <p class="">{{ $item->name }}</p>
                        <p class="text-gray-500 font-bold mb-2">{{ $item->price . ' MMK' }}</p>
                        <form action="{{ route('carts.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <button
                                class="w-full text-gray-700 border border-gray-700 rounded-md text-sm p-2 hover:bg-slate-500 hover:text-white">
                                <span>Add To Cart</span>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="w-[500px] bg-white dark:bg-gray-900 shadow rounded-md p-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Admin Cart</h2>
            <div class="flex flex-col gap-4">
                @foreach ($carts as $cart)
                    <div class="flex items-start bg-white shadow-md rounded-lg p-4 mb-4" id="cart-item-{{ $cart->id }}">
                        <!-- Product Image -->
                        <img src="{{ $cart->item->photo }}" alt="{{ $cart->item->name }}"
                            class="w-24 h-24 rounded-md object-cover mr-4">

                        <!-- Product Details -->
                        <div class="flex-grow">
                            <h2 class="text-md font-semibold">{{ $cart->item->name }}</h2>
                            <p class="text-gray-700 font-bold mb-2">{{ $cart->item->price . ' MMK' }}</p>

                            <!-- Quantity Selector -->
                            <div class="flex items-center space-x-2">
                                <button class="text-gray-500 bg-gray-100 hover:bg-gray-200 px-2 py-1 rounded-md"
                                    onclick="updateQuantity({{ $cart->id }},'minus')">-</button>
                                <input type="text" value="{{ $cart->quantity }}" readonly
                                    class="w-10 text-center border border-gray-300 rounded-md text-sm"
                                    id="quantity-{{ $cart->id }}">
                                <button class="text-gray-500 bg-gray-100 hover:bg-gray-200 px-2 py-1 rounded-md"
                                    onclick="updateQuantity({{ $cart->id }},'add')">+</button>
                            </div>
                        </div>

                        <!-- Remove Button -->
                        <button class="ml-4 text-red-500 hover:text-red-600" onclick="removeItem({{ $cart->id }})">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Include Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- JavaScript for Handling Cart Actions -->
    <script>
        function updateQuantity(cartId, action) {
            if (action == 'add') {
                axios.post(`/cart/update/${cartId}`, {
                        action: "add"
                    })
                    .then(response => {
                        if (response.data.success) {
                            document.getElementById(`quantity-${cartId}`).value = response.data.quantity;
                        } else {
                            alert('Failed to update cart item.');
                        }
                    })
                    .catch(error => {
                        console.error('There was an error updating the cart:', error);
                    });
            } else {
                axios.post(`/cart/update/${cartId}`, {
                        action: "minus"
                    })
                    .then(response => {
                        if (response.data.success) {
                            document.getElementById(`quantity-${cartId}`).value = response.data.quantity;
                        }
                    })
                    .catch(error => {
                        console.error('There was an error updating the cart:', error);
                    });
            }
        }

        function removeItem(cartId) {
            axios.delete(`/cart/remove/${cartId}`)
                .then(response => {
                    if (response.data.success) {
                        document.getElementById(`cart-item-${cartId}`).remove();
                    } else {
                        alert('Failed to remove cart item.');
                    }
                })
                .catch(error => {
                    console.error('There was an error removing the cart item:', error);
                });
        }
    </script>
@endsection

@extends('layout.main')

@section('content')
    <section class="flex gap-4">
        <div class="bg-white dark:bg-gray-900 shadow rounded-md p-6 w-full">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Make a new Order</h2>
            </div>
            <div class="grid gap-4 grid-cols-4 w-full">
                @foreach ($items as $item)
                    <div class="bg-white rounded-md shadow p-4 md:p-5">
                        <img src="{{ $item->photo }}" class="rounded shadow-md mb-3">
                        <p class="">{{ $item->name }}</p>
                        <p class="text-gray-500 font-bold mb-2">{{ $item->price . ' MMK' }}</p>
                        <form action="{{ route('carts.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="table_id" value="1">
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
            <div class="show_cart {{ count($carts) == 0 ? 'hidden' : '' }}">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Admin Cart</h2>
                <div class="flex flex-col">
                    @foreach ($carts as $cart)
                        <div class="flex items-start bg-white border border-gray-200 rounded-md p-4 mb-2"
                            id="cart-item-{{ $cart->id }}">
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
                <div class="flex flex-col border-t border-t-gray-300 mt-3 pt-4">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-gray-600">Total Amount:</p>
                        <p class="text-gray-600 font-bold" id="total_amount">{{ $cart_total . ' MMK' }}</p>
                    </div>
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="table_id" value="1">
                        <button
                            class="mt-3 w-full text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm p-3 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            Order Now
                        </button>
                    </form>
                </div>
            </div>
            <div
                class="empty_cart bg-white shadow-md rounded-lg p-6 flex flex-col gap-4 items-center justify-center h-48 {{ count($carts) == 0 ? '' : 'hidden' }}">
                <svg class="animated" id="freepik_stories-no-data" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 750 500"
                    version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
                    <style>
                        svg#freepik_stories-no-data:not(.animated) .animable {
                            opacity: 0;
                        }

                        svg#freepik_stories-no-data.animated #freepik--background-complete--inject-12 {
                            animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) fadeIn;
                            animation-delay: 0s;
                        }

                        svg#freepik_stories-no-data.animated #freepik--Lamp--inject-12 {
                            animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideLeft;
                            animation-delay: 0s;
                        }

                        svg#freepik_stories-no-data.animated #freepik--Floor--inject-12 {
                            animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideDown;
                            animation-delay: 0s;
                        }

                        svg#freepik_stories-no-data.animated #freepik--Plant--inject-12 {
                            animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) fadeIn;
                            animation-delay: 0s;
                        }

                        svg#freepik_stories-no-data.animated #freepik--Character--inject-12 {
                            animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideUp;
                            animation-delay: 0s;
                        }

                        svg#freepik_stories-no-data.animated #freepik--Folder--inject-12 {
                            animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideDown;
                            animation-delay: 0s;
                        }

                        svg#freepik_stories-no-data.animated #freepik--speech-bubble--inject-12 {
                            animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) fadeIn;
                            animation-delay: 0s;
                        }

                        @keyframes fadeIn {
                            0% {
                                opacity: 0;
                            }

                            100% {
                                opacity: 1;
                            }
                        }

                        @keyframes slideLeft {
                            0% {
                                opacity: 0;
                                transform: translateX(-30px);
                            }

                            100% {
                                opacity: 1;
                                transform: translateX(0);
                            }
                        }

                        @keyframes slideDown {
                            0% {
                                opacity: 0;
                                transform: translateY(-30px);
                            }

                            100% {
                                opacity: 1;
                                transform: translateY(0);
                            }
                        }

                        @keyframes slideUp {
                            0% {
                                opacity: 0;
                                transform: translateY(30px);
                            }

                            100% {
                                opacity: 1;
                                transform: inherit;
                            }
                        }

                        .animator-hidden {
                            display: none;
                        }
                    </style>
                    <g id="freepik--background-complete--inject-12" class="animable"
                        style="transform-origin: 397.782px 217.393px;">
                        <g id="elkpjz89v1x4">
                            <rect x="151.54" y="143.03" width="134.99" height="198.77"
                                style="fill: rgb(245, 245, 245); transform-origin: 219.035px 242.415px; transform: rotate(-33.78deg);"
                                class="animable"></rect>
                        </g>
                        <polygon points="272.42 279.66 271.15 287.54 215.37 279.5 216.64 271.62 272.42 279.66"
                            style="fill: rgb(224, 224, 224); transform-origin: 243.895px 279.58px;" id="elnsyg7aw50er"
                            class="animable"></polygon>
                        <polygon points="244.33 251.55 252.33 252.7 243.46 307.62 235.45 306.46 244.33 251.55"
                            style="fill: rgb(224, 224, 224); transform-origin: 243.89px 279.585px;" id="el29oofnpfiaj"
                            class="animable"></polygon>
                        <path
                            d="M193,181.75c.08.11-11.16,7.78-25.11,17.1s-25.32,16.8-25.4,16.68,11.16-7.78,25.11-17.11S192.87,181.63,193,181.75Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 167.745px 198.64px;" id="elh1txekm7ms"
                            class="animable"></path>
                        <path
                            d="M234.22,171.39c.08.12-18.62,12.76-41.76,28.24s-42,27.93-42.06,27.82S169,214.68,192.17,199.2,234.14,171.27,234.22,171.39Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 192.31px 199.42px;" id="el0sfh1i7aqizo"
                            class="animable"></path>
                        <path
                            d="M242.49,183.75c.08.12-18.62,12.77-41.76,28.25s-42,27.93-42.06,27.81,18.62-12.76,41.77-28.25S242.41,183.63,242.49,183.75Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 200.58px 211.78px;" id="elq4t5d1e1rf"
                            class="animable"></path>
                        <path
                            d="M250.76,196.12c.08.12-18.62,12.77-41.76,28.24S167,252.3,167,252.18s18.61-12.77,41.76-28.25S250.68,196,250.76,196.12Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 208.88px 224.15px;" id="els2mf5i3o2t"
                            class="animable"></path>
                        <path
                            d="M259,208.49c.08.12-18.62,12.76-41.76,28.24s-42,27.93-42.05,27.81S193.83,251.78,217,236.3,259,208.37,259,208.49Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 217.095px 236.515px;" id="el3hscchu636"
                            class="animable"></path>
                        <g id="elc1nkzsqzmbf">
                            <rect x="537.68" y="250.43" width="113.37" height="166.93"
                                style="fill: rgb(245, 245, 245); transform-origin: 594.365px 333.895px; transform: rotate(-33.78deg);"
                                class="animable"></rect>
                        </g>
                        <polygon points="639.2 365.18 638.13 371.8 591.28 365.05 592.36 358.43 639.2 365.18"
                            style="fill: rgb(224, 224, 224); transform-origin: 615.24px 365.115px;" id="el8m54ty6a7al"
                            class="animable"></polygon>
                        <polygon points="615.61 341.57 622.33 342.54 614.88 388.66 608.15 387.69 615.61 341.57"
                            style="fill: rgb(224, 224, 224); transform-origin: 615.24px 365.115px;" id="elyfnursnhlr"
                            class="animable"></polygon>
                        <path
                            d="M572.46,283c.08.12-9.35,6.57-21.07,14.4s-21.28,14.09-21.36,14,9.36-6.56,21.07-14.4S572.38,282.83,572.46,283Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 551.245px 297.199px;" id="ellm3qu7vup0h"
                            class="animable"></path>
                        <path
                            d="M607.11,274.25c.08.12-15.61,10.76-35,23.75s-35.26,23.45-35.34,23.33,15.61-10.76,35-23.76S607,274.13,607.11,274.25Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 571.94px 297.79px;" id="el3493kuto41x"
                            class="animable"></path>
                        <path
                            d="M614.06,284.63c.08.12-15.61,10.76-35,23.76s-35.26,23.44-35.34,23.32S559.28,321,578.72,308,614,284.52,614.06,284.63Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 578.89px 308.17px;" id="elsxsthboljdg"
                            class="animable"></path>
                        <path
                            d="M621,295c.08.12-15.62,10.76-35,23.76s-35.26,23.44-35.34,23.32,15.61-10.75,35-23.76S620.93,294.9,621,295Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 585.83px 318.54px;" id="elnpm51kdgd3d"
                            class="animable"></path>
                        <path
                            d="M628,305.41c.08.12-15.61,10.75-35,23.75s-35.26,23.44-35.34,23.33,15.61-10.76,35-23.76S627.87,305.29,628,305.41Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 592.83px 328.95px;" id="el716rcyk3w3h"
                            class="animable"></path>
                        <g id="el6bqgfg24gt">
                            <rect x="295.8" y="90.69" width="116.6" height="171.69"
                                style="fill: rgb(245, 245, 245); transform-origin: 354.1px 176.535px; transform: rotate(28.14deg);"
                                class="animable"></rect>
                        </g>
                        <polygon points="347.42 232.37 340.9 234.6 324.34 188.83 330.87 186.59 347.42 232.37"
                            style="fill: rgb(224, 224, 224); transform-origin: 335.88px 210.595px;" id="elqvdu6gxuel"
                            class="animable"></polygon>
                        <polygon points="357.42 199.53 359.8 206.1 314.34 221.67 311.96 215.1 357.42 199.53"
                            style="fill: rgb(224, 224, 224); transform-origin: 335.88px 210.6px;" id="elic7x9xxe9n"
                            class="animable"></polygon>
                        <path
                            d="M389.72,132c-.08.15-10.5-5.27-23.29-12.1s-23.08-12.5-23-12.65,10.51,5.27,23.3,12.1S389.8,131.84,389.72,132Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 366.575px 119.625px;" id="el286813keabc"
                            class="animable"></path>
                        <path
                            d="M414.4,159.23c-.08.15-17.34-8.93-38.55-20.27s-38.33-20.66-38.25-20.81,17.33,8.92,38.54,20.27S414.48,159.08,414.4,159.23Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 376px 138.69px;" id="elfe60tfpzddq"
                            class="animable"></path>
                        <path
                            d="M408.34,170.56c-.08.15-17.34-8.92-38.55-20.27s-38.33-20.66-38.25-20.81,17.33,8.93,38.54,20.27S408.42,170.41,408.34,170.56Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 369.94px 150.02px;" id="elo0c6dtsylko"
                            class="animable"></path>
                        <path
                            d="M402.28,181.89c-.08.15-17.34-8.92-38.55-20.26S325.4,141,325.48,140.82s17.33,8.92,38.54,20.26S402.36,181.74,402.28,181.89Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 363.88px 161.355px;" id="elwmz7c3buspi"
                            class="animable"></path>
                        <path
                            d="M396.22,193.22c-.08.15-17.34-8.92-38.55-20.26s-38.34-20.66-38.25-20.81,17.33,8.92,38.54,20.26S396.3,193.07,396.22,193.22Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 357.82px 172.685px;" id="ele39gidkyjse"
                            class="animable"></path>
                        <g id="elpr1jj4bks0h">
                            <rect x="394.17" width="2.58" height="43.98"
                                style="opacity: 0.2; transform-origin: 395.46px 21.99px;" class="animable"></rect>
                        </g>
                    </g>
                    <g id="freepik--Lamp--inject-12" class="animable animator-hidden"
                        style="transform-origin: 395.46px 48.595px;">
                        <path d="M335.23,97.19H455.69S444.57,44,394.55,44C350.06,44,335.23,97.19,335.23,97.19Z"
                            style="fill: rgb(207, 216, 220); transform-origin: 395.46px 70.595px;" id="ellkswxlni6hj"
                            class="animable"></path>
                        <rect x="394.17" width="2.58" height="43.98"
                            style="fill: rgb(207, 216, 220); transform-origin: 395.46px 21.99px;" id="elxdo8vf4yfli"
                            class="animable"></rect>
                    </g>
                    <g id="freepik--Floor--inject-12" class="animable animator-hidden"
                        style="transform-origin: 375px 439.83px;">
                        <path
                            d="M663.67,439.83c0,.14-129.25.26-288.66.26S86.33,440,86.33,439.83s129.23-.26,288.68-.26S663.67,439.68,663.67,439.83Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 375px 439.83px;" id="el56yxd2383gf"
                            class="animable"></path>
                    </g>
                    <g id="freepik--Plant--inject-12" class="animable" style="transform-origin: 131.448px 408.86px;">
                        <path
                            d="M118.29,377.2a12.62,12.62,0,0,1,8.78,4.5,22.15,22.15,0,0,1,4.47,9c1.69,6.32.65,13.79-1.15,20.08-6.84-2.45-11.07-9.75-13-13.59-3-6.06-4.79-18.86.87-20"
                            style="fill: rgb(207, 216, 220); transform-origin: 123.482px 393.985px;" id="el3oedaosajby"
                            class="animable"></path>
                        <path
                            d="M140.24,418.45a10.74,10.74,0,0,1-.5-10.78,14.26,14.26,0,0,1,8.6-6.91c1.67-.52,3.61-.73,5.06.24a4.58,4.58,0,0,1,1.77,4.31,9.27,9.27,0,0,1-2,4.42c-3.33,4.51-7.37,8.26-13,8.72"
                            style="fill: rgb(207, 216, 220); transform-origin: 146.872px 409.386px;" id="el6funx3agdqd"
                            class="animable"></path>
                        <path
                            d="M141,439.58a6.5,6.5,0,0,1-.31-1.31c-.18-.94-.42-2.15-.71-3.6a37.77,37.77,0,0,1-.74-12.11,23,23,0,0,1,4.49-11.21,15.32,15.32,0,0,1,2.59-2.63,9.16,9.16,0,0,1,.82-.58,1.15,1.15,0,0,1,.3-.18,25.37,25.37,0,0,0-3.45,3.59,23.85,23.85,0,0,0-4.28,11.08c-.64,4.66.15,8.93.61,12,.24,1.53.44,2.77.55,3.63A8.23,8.23,0,0,1,141,439.58Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 143.245px 423.77px;" id="elvcl52it6udr"
                            class="animable"></path>
                        <path
                            d="M120.49,386.83a2.34,2.34,0,0,1,.28.51c.18.4.42.9.7,1.53.61,1.33,1.46,3.26,2.49,5.65,2.06,4.79,4.82,11.45,7.7,18.87s5.33,14.19,7,19.12c.86,2.46,1.53,4.46,2,5.85.21.66.37,1.19.5,1.6a2.61,2.61,0,0,1,.15.57,2.46,2.46,0,0,1-.24-.54c-.15-.4-.34-.92-.59-1.57l-2.11-5.8c-1.79-4.89-4.29-11.65-7.16-19.06s-5.59-14.09-7.57-18.91c-1-2.37-1.77-4.3-2.34-5.71-.26-.64-.47-1.15-.63-1.56A3.49,3.49,0,0,1,120.49,386.83Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 130.9px 413.68px;" id="elvlgta6ydz2"
                            class="animable"></path>
                        <path
                            d="M132.87,425.6a25.18,25.18,0,0,0-19.52-12.13c-2-.14-4.46.2-5.36,2s.3,4,1.68,5.46a21.49,21.49,0,0,0,23.27,5.2"
                            style="fill: rgb(207, 216, 220); transform-origin: 120.309px 420.506px;" id="el70hwallx1f9"
                            class="animable"></path>
                        <path
                            d="M116.43,418.89a7.15,7.15,0,0,1,1.27.05,12.09,12.09,0,0,1,1.47.17c.57.11,1.24.17,1.94.37a19.41,19.41,0,0,1,2.31.64,22.91,22.91,0,0,1,2.57,1,27.8,27.8,0,0,1,5.42,3.21,27.31,27.31,0,0,1,4.48,4.44,22.49,22.49,0,0,1,1.57,2.25,21.93,21.93,0,0,1,1.18,2.09,17.4,17.4,0,0,1,.8,1.8,11.34,11.34,0,0,1,.51,1.4,6.82,6.82,0,0,1,.33,1.23c-.11,0-.59-1.72-1.94-4.28a22,22,0,0,0-1.21-2,25.32,25.32,0,0,0-1.58-2.19,26.65,26.65,0,0,0-9.74-7.52c-.87-.38-1.7-.74-2.51-1a21.87,21.87,0,0,0-2.27-.69C118.23,419.09,116.42,419,116.43,418.89Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 128.355px 428.211px;" id="elntwr4i37ifc"
                            class="animable"></path>
                    </g>
                    <g id="freepik--Character--inject-12" class="animable animator-hidden"
                        style="transform-origin: 564.68px 255.511px;">
                        <path
                            d="M570.36,105.48c-2.94.67-4.37,4.06-4.65,7.06s.1,6.18-1.16,8.92c-1.42,3.08-4.81,5.36-4.92,8.75-.07,2.07,1.16,4,1.1,6.09-.1,3.4-3.56,6-3.75,9.36-.13,2.45,1.5,4.79,1.11,7.21-.3,1.88-1.77,3.36-2.39,5.16-1.23,3.6,1.24,7.55,4.45,9.57a14.59,14.59,0,0,0,21.25-6.78c1.78-4.32,1.39-9.19,1-13.84q-1.8-21.76-2.68-43.58"
                            style="fill: rgb(38, 50, 56); transform-origin: 569.054px 136.619px;" id="elhsc5kvtoqqc"
                            class="animable"></path>
                        <path
                            d="M561.82,156.66a3.41,3.41,0,0,0,1.35-1.59,5.79,5.79,0,0,0,.34-2.45,13.47,13.47,0,0,0-.73-3.23,9.31,9.31,0,0,1-.52-4.1c.25-1.56,1.37-2.84,2.38-4.1a8.77,8.77,0,0,0,1.35-2.05,3.31,3.31,0,0,0,.16-2.4c-.52-1.63-2.12-2.83-2.85-4.72a5,5,0,0,1-.16-2.92,11.59,11.59,0,0,1,1-2.61,22.41,22.41,0,0,0,2-4.71c.7-3.17.37-6.2.85-8.69a9.62,9.62,0,0,1,2.53-5.32,5.81,5.81,0,0,1,1.32-1,2.07,2.07,0,0,1,.53-.19,7.69,7.69,0,0,0-1.71,1.28,9.78,9.78,0,0,0-2.31,5.25,32.58,32.58,0,0,0-.28,4,24.63,24.63,0,0,1-.46,4.69,22.46,22.46,0,0,1-2,4.82c-.75,1.57-1.44,3.41-.78,5.13s2.25,2.91,2.86,4.75a3.88,3.88,0,0,1-.19,2.75A9.46,9.46,0,0,1,565,141.5c-1,1.26-2.09,2.46-2.33,3.86a9,9,0,0,0,.46,3.93,13.62,13.62,0,0,1,.66,3.32,5.61,5.61,0,0,1-.45,2.54,3.06,3.06,0,0,1-1,1.26A1.58,1.58,0,0,1,561.82,156.66Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 566.595px 131.62px;" id="eljhzl6ty4h7"
                            class="animable"></path>
                        <path d="M554,180.37l-9,26-37.64,2-6.28,14,39.3,4A14.85,14.85,0,0,0,560,217.64l10.49-29.28Z"
                            style="fill: rgb(183, 136, 118); transform-origin: 535.785px 203.926px;" id="el9wa34hc4w76"
                            class="animable"></path>
                        <path
                            d="M631.81,425.7s-27.58-87.62-28.17-90.46c-.53-2.58,10-65.63,11.34-82l-37.27,1.39V255l-15.84.88L576.05,435H593.2l-1.7-59.45c10.58,28.39,25.74,57.33,25.74,57.33Z"
                            style="fill: rgb(183, 136, 118); transform-origin: 596.84px 344.12px;" id="el3ehqm8be8mk"
                            class="animable"></path>
                        <path
                            d="M592.2,396.88c0-.54-.21-19.92-.21-19.92-.21,1.16-6.57-16.82-6.42-17.91C585.65,358.48,592.2,396.88,592.2,396.88Z"
                            style="fill: rgb(163, 105, 87); transform-origin: 588.884px 377.962px;" id="elt4s358idjm"
                            class="animable"></path>
                        <path
                            d="M584.85,350.53a3.88,3.88,0,0,0-.11,1.09,27.15,27.15,0,0,0,0,3c0,.63.09,1.31.17,2.05s.19,1.52.36,2.33a41.36,41.36,0,0,0,1.41,5.22c1.24,3.63,2.62,6.8,3.59,9.1.46,1,.86,1.95,1.2,2.71a4.32,4.32,0,0,0,.5,1,3.79,3.79,0,0,0-.3-1c-.23-.66-.58-1.61-1-2.78-.88-2.34-2.2-5.54-3.43-9.13a43.34,43.34,0,0,1-1.43-5.14c-.18-.8-.3-1.57-.41-2.29s-.19-1.4-.24-2c-.12-1.24-.17-2.24-.2-2.94A4.52,4.52,0,0,0,584.85,350.53Z"
                            style="fill: rgb(163, 105, 87); transform-origin: 588.334px 363.78px;" id="elf3jk9cuyn5d"
                            class="animable"></path>
                        <path
                            d="M575.73,435.91V434.3l17.57-.77.05,6.65-1.08.07c-4.83.28-24.55,1.1-27.77.13C560.89,439.3,575.73,435.91,575.73,435.91Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 578.642px 437.185px;" id="el67h561rgv1k"
                            class="animable"></path>
                        <path
                            d="M593.58,439.78a2.29,2.29,0,0,1-.3,0l-.86.06-3.18.14c-2.68.11-6.39.21-10.48.23s-7.81-.05-10.5-.13l-3.17-.13-.87,0-.3,0a1.85,1.85,0,0,1,.3,0h.87l3.18.06c2.68,0,6.39.08,10.48.06s7.81-.09,10.49-.16l3.18-.08h1.16Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 578.75px 439.997px;" id="elcrttrmt1c8"
                            class="animable"></path>
                        <path
                            d="M570,440.34a7.67,7.67,0,0,0-.6-1.51,7.21,7.21,0,0,0-1.09-1.21,2.32,2.32,0,0,1,1.27,1.1A2.39,2.39,0,0,1,570,440.34Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 569.161px 438.98px;" id="elpx6tfids48l"
                            class="animable"></path>
                        <path d="M575.18,437.71s-.29-.27-.55-.67-.42-.75-.37-.78.29.26.55.66S575.23,437.68,575.18,437.71Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 574.72px 436.984px;" id="elcixrw8tvmi"
                            class="animable"></path>
                        <path d="M576.6,437c0,.05-.32-.14-.62-.41s-.52-.52-.48-.56.32.14.62.41S576.64,436.91,576.6,437Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 576.05px 436.516px;" id="el248iy7zjtzy"
                            class="animable"></path>
                        <path
                            d="M577.49,435.3a2.11,2.11,0,0,1-.92.12,2,2,0,0,1-.91-.09,2.08,2.08,0,0,1,.91-.12A2,2,0,0,1,577.49,435.3Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 576.575px 435.314px;" id="elqot7rursj2d"
                            class="animable"></path>
                        <path
                            d="M577.79,434.14a1.86,1.86,0,0,1-1,.3,1.89,1.89,0,0,1-1-.14,5.77,5.77,0,0,1,1-.08A5.19,5.19,0,0,1,577.79,434.14Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 576.79px 434.298px;" id="eljtkbopbdecn"
                            class="animable"></path>
                        <path
                            d="M574.59,436.18a3.07,3.07,0,0,1-1.13,0,6.46,6.46,0,0,1-1.19-.26,3.23,3.23,0,0,1-.69-.28.63.63,0,0,1-.28-.35.44.44,0,0,1,.17-.45,2.08,2.08,0,0,1,2.92,1.35.76.76,0,0,1,0,.3,3.22,3.22,0,0,0-.52-1,2.06,2.06,0,0,0-1-.62,1.78,1.78,0,0,0-1.34.1c-.17.13-.1.34.09.46a3.61,3.61,0,0,0,.64.27,8.41,8.41,0,0,0,1.15.29C574.16,436.15,574.59,436.15,574.59,436.18Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 572.94px 435.561px;" id="els7vtqp1y0jk"
                            class="animable"></path>
                        <path
                            d="M574.3,436.24a1.06,1.06,0,0,1-.14-.78,1.86,1.86,0,0,1,.31-.82,1.14,1.14,0,0,1,.93-.58.46.46,0,0,1,.35.52,1.19,1.19,0,0,1-.19.5,4.13,4.13,0,0,1-.53.69,1.64,1.64,0,0,1-.64.45s.22-.2.53-.56a3.88,3.88,0,0,0,.47-.67c.15-.24.26-.67,0-.72s-.56.26-.73.48a1.83,1.83,0,0,0-.32.73A3.52,3.52,0,0,0,574.3,436.24Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 574.947px 435.15px;" id="elskq3107waro"
                            class="animable"></path>
                        <path
                            d="M593.21,435s-.5,0-1.29.05a5.54,5.54,0,0,0-4.57,3.67c-.26.75-.28,1.26-.32,1.25s0-.13,0-.35a4.48,4.48,0,0,1,.18-.95,5.47,5.47,0,0,1,1.76-2.61,5.39,5.39,0,0,1,2.93-1.15,4.19,4.19,0,0,1,1,0A1.26,1.26,0,0,1,593.21,435Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 590.111px 437.425px;" id="elxxe0j1s4x4"
                            class="animable"></path>
                        <path
                            d="M584.8,438.38a9.81,9.81,0,0,1-2.56.25,9.43,9.43,0,0,1-2.55-.22c0-.06,1.14,0,2.55,0S584.79,438.32,584.8,438.38Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 582.245px 438.501px;" id="el3665q01bwrt"
                            class="animable"></path>
                        <path d="M588.22,438.35s-.09.24-.21.5-.18.5-.24.49-.09-.27.05-.58S588.18,438.3,588.22,438.35Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 587.97px 438.84px;" id="elz0ad0tolpd"
                            class="animable"></path>
                        <path d="M589.51,436.74s-.07.22-.25.4-.36.3-.41.26.07-.22.25-.41S589.46,436.69,589.51,436.74Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 589.174px 437.068px;" id="elq8iohve92t"
                            class="animable"></path>
                        <path d="M591.35,436c0,.06-.24.06-.5.15s-.44.23-.49.19.1-.28.42-.39S591.37,435.94,591.35,436Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 590.851px 436.124px;" id="el460ryrflyn9"
                            class="animable"></path>
                        <path d="M592.66,435.64c0,.06-.07.15-.22.2s-.28.06-.3,0,.08-.15.22-.2S592.64,435.59,592.66,435.64Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 592.399px 435.742px;" id="elc3vk4docn9"
                            class="animable"></path>
                        <path
                            d="M616.89,434.36l-.66-1.47L631.94,425l2.77,6-1,.51c-4.29,2.23-21.94,11.05-25.28,11.49C604.74,443.53,616.89,434.36,616.89,434.36Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 621.221px 434.011px;" id="els6pkc0cvj5e"
                            class="animable"></path>
                        <path
                            d="M634.77,430.57l-.26.16-.77.4-2.84,1.44c-2.4,1.19-5.74,2.8-9.47,4.5s-7.15,3.15-9.63,4.18l-2.95,1.19-.8.31a1.14,1.14,0,0,1-.29.09l.27-.13.79-.35,2.92-1.25c2.47-1.06,5.87-2.54,9.6-4.24s7.08-3.28,9.5-4.44l2.86-1.37.79-.37Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 621.265px 436.705px;" id="el7k554sh69ot"
                            class="animable"></path>
                        <path
                            d="M613.52,440.74a7.38,7.38,0,0,0-1.17-1.14,6.94,6.94,0,0,0-1.49-.66,2.81,2.81,0,0,1,2.66,1.8Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 612.19px 439.84px;" id="elfnvpjzod3th"
                            class="animable"></path>
                        <path d="M617.13,436.22s-.38-.12-.78-.38-.69-.51-.66-.56.38.12.78.38S617.16,436.17,617.13,436.22Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 616.41px 435.746px;" id="el0y03z3ubtnwa"
                            class="animable"></path>
                        <path
                            d="M618.11,435c0,.05-.34,0-.73-.12s-.68-.27-.67-.33a1.49,1.49,0,0,1,.74.12C617.83,434.76,618.13,434.9,618.11,435Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 617.41px 434.781px;" id="elhl20rt2zpqo"
                            class="animable"></path>
                        <path
                            d="M618.25,433.08c0,.06-.33.27-.79.49a2.11,2.11,0,0,1-.87.29c0-.06.33-.27.78-.49A2.18,2.18,0,0,1,618.25,433.08Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 617.42px 433.47px;" id="elykqvzr2tqc8"
                            class="animable"></path>
                        <path
                            d="M618.05,431.9s-.29.4-.81.69a1.74,1.74,0,0,1-1,.3,5.28,5.28,0,0,1,.91-.49C617.64,432.13,618,431.85,618.05,431.9Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 617.145px 432.392px;" id="elmz1ocnnr2as"
                            class="animable"></path>
                        <path
                            d="M616,435.08a3.24,3.24,0,0,1-1,.46,7.85,7.85,0,0,1-1.2.25,3,3,0,0,1-.74,0,.59.59,0,0,1-.4-.2.44.44,0,0,1,0-.48,2.06,2.06,0,0,1,2.57-.5,2,2,0,0,1,.64.53c.12.16.17.26.16.27a3,3,0,0,0-.87-.67,2,2,0,0,0-1.13-.17,1.75,1.75,0,0,0-1.18.64c-.11.19,0,.35.27.38a4,4,0,0,0,.69,0,7.9,7.9,0,0,0,1.18-.21C615.56,435.22,616,435.05,616,435.08Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 614.31px 435.087px;" id="eldedfb0js71w"
                            class="animable"></path>
                        <path
                            d="M615.72,435.25a1.11,1.11,0,0,1-.44-.66,1.88,1.88,0,0,1-.06-.87,1.13,1.13,0,0,1,.62-.91c.25-.08.83.43.87.62s-.29.09-.31.25a3.48,3.48,0,0,1-.2.83,1.56,1.56,0,0,1-.4.68s.12-.27.26-.72a5.12,5.12,0,0,0,.15-.81c0-.28,0-.71-.32-.64s-.41.46-.48.74a1.73,1.73,0,0,0,0,.79A4.36,4.36,0,0,0,615.72,435.25Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 615.954px 434.026px;" id="el7t10y2jaszf"
                            class="animable"></path>
                        <path
                            d="M632.47,426.36s-.48.17-1.16.58a5.58,5.58,0,0,0-2.09,2.22,5.63,5.63,0,0,0-.57,3c.06.8.25,1.26.21,1.28a1.27,1.27,0,0,1-.15-.32,5.18,5.18,0,0,1-.21-.94,5.29,5.29,0,0,1,2.73-5.36,4.75,4.75,0,0,1,.89-.38A1.23,1.23,0,0,1,632.47,426.36Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 630.461px 429.9px;" id="elnru35fgwsrn"
                            class="animable"></path>
                        <path
                            d="M626.18,432.9a14.28,14.28,0,0,1-4.65,2.12c0-.06,1.05-.46,2.33-1S626.15,432.85,626.18,432.9Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 623.855px 433.959px;" id="elvewoxjwlvq"
                            class="animable"></path>
                        <path d="M629.29,431.47c.05,0,0,.25,0,.54s0,.53,0,.55-.2-.22-.2-.55S629.24,431.44,629.29,431.47Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 629.201px 432.014px;" id="elr7uy8dahtte"
                            class="animable"></path>
                        <path d="M629.8,429.47c.05,0,0,.23-.06.47s-.21.42-.26.4,0-.23.06-.47S629.74,429.45,629.8,429.47Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 629.64px 429.905px;" id="elbzznwu7ckxc"
                            class="animable"></path>
                        <path d="M631.18,428c0,.06-.2.15-.4.34s-.31.39-.36.37,0-.3.22-.53S631.17,428,631.18,428Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 630.791px 428.353px;" id="el33pj6v86ieh"
                            class="animable"></path>
                        <path d="M632.23,427.18s0,.16-.12.27-.23.17-.27.13,0-.16.12-.27S632.19,427.14,632.23,427.18Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 632.027px 427.38px;" id="elueqw56zktfo"
                            class="animable"></path>
                        <path
                            d="M612.56,223.64l-2.92-35.7,15,.27s.69-5.27-1.52-16.81c-1.36-7.08-6.07-11.42-11.36-14v-.1l-.46-.12a42.83,42.83,0,0,0-13.76-3.59l-18.45.21S565,152,557.23,162.09c-3,3.87-12.31,30.36-12.31,30.36l22.15,10.66L565,188.42s.42,10.65,1.78,14c.75,1.88,3,7.72,3,7.72l-.29,17.62Z"
                            style="fill: rgb(207, 216, 220); transform-origin: 584.831px 190.675px;" id="el4sjmecjmbn8"
                            class="animable"></path>
                        <polygon points="602.39 182.76 599.65 194.42 625.48 194.42 623.78 174.86 602.39 182.76"
                            style="fill: rgb(207, 216, 220); transform-origin: 612.565px 184.64px;" id="eldb3i8limwyt"
                            class="animable"></polygon>
                        <path
                            d="M625.48,194.42a20.7,20.7,0,0,0-3.42-.34c-2.12-.12-5-.23-8.28-.21s-6.17.16-8.29.32a19.6,19.6,0,0,0-3.41.42,21.66,21.66,0,0,0,3.44,0c2.11-.07,5-.15,8.26-.16s6.15,0,8.27.05A21.65,21.65,0,0,0,625.48,194.42Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 613.78px 194.273px;" id="elpx4341ll0wl"
                            class="animable"></path>
                        <path
                            d="M601.27,174.77a15.57,15.57,0,0,0-.08,3c0,1.83.08,4.35.19,7.14s.24,5.32.36,7.14a14.9,14.9,0,0,0,.32,3,15.64,15.64,0,0,0,.08-3c0-1.83-.08-4.36-.19-7.15s-.24-5.31-.36-7.14A14.71,14.71,0,0,0,601.27,174.77Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 601.665px 184.91px;" id="elaj8t34y7lav"
                            class="animable"></path>
                        <g id="elnyu33mr3e8">
                            <g style="opacity: 0.3; transform-origin: 593.51px 205.601px;" class="animable">
                                <path d="M577.77,184.87s5.74,42.57,21.88,41.44c0,0,7.27-.08,9.6-4.91v-1.9Z"
                                    id="elh2qrpi40qwq" class="animable" style="transform-origin: 593.51px 205.601px;">
                                </path>
                            </g>
                        </g>
                        <g id="el89xnvs7l90j">
                            <g style="opacity: 0.3; transform-origin: 600.83px 189.545px;" class="animable">
                                <polygon
                                    points="601.27 177.28 598.18 198.15 600.18 201.81 603.48 194.65 602.08 194.61 601.27 177.28"
                                    id="elz0wyntykb7" class="animable" style="transform-origin: 600.83px 189.545px;">
                                </polygon>
                            </g>
                        </g>
                        <path
                            d="M569.69,210.16a4,4,0,0,1-.44-1c-.25-.65-.58-1.6-1-2.79a86.11,86.11,0,0,1-2.47-9.45,67,67,0,0,1-1.22-9.69c-.06-1.25-.08-2.26-.06-3a4,4,0,0,1,.07-1.08c.08,0,.14,1.54.35,4a89,89,0,0,0,1.37,9.61c.74,3.72,1.63,7.05,2.31,9.44.32,1.11.59,2.06.81,2.84A4.89,4.89,0,0,1,569.69,210.16Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 567.09px 196.655px;" id="elmbsym71l0z"
                            class="animable"></path>
                        <path
                            d="M576.21,222.39c-.14,0-.54-.87-.89-2a4.8,4.8,0,0,1-.39-2.2,5.22,5.22,0,0,1,.89,2.05A5,5,0,0,1,576.21,222.39Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 575.568px 220.29px;" id="elj1c8r8lb3eb"
                            class="animable"></path>
                        <path
                            d="M578.44,222.23a9.2,9.2,0,0,1-.09-6.24,20.81,20.81,0,0,1,0,3.12A20.56,20.56,0,0,1,578.44,222.23Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 578.156px 219.11px;" id="elqt8vgii0q7p"
                            class="animable"></path>
                        <path
                            d="M567.52,203.6c-.07.12-5.22-2.32-11.51-5.46s-11.34-5.8-11.28-5.93,5.22,2.32,11.51,5.46S567.58,203.47,567.52,203.6Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 556.125px 197.905px;" id="elya7uul6hvdq"
                            class="animable"></path>
                        <path
                            d="M576.6,157.25c.11-5.06.14-10.38.14-10.38s-6.49-1.25-7.62-9.79c-1.08-8.14,1.94-27.25,1.94-27.25h0c9.48-3.58,19.33-.33,25.82,7.35h0l-1.61,41.07c-.19,4.77-4.44,8.41-9.54,8.17h0C580.57,166.17,576.49,162.07,576.6,157.25Z"
                            style="fill: rgb(183, 136, 118); transform-origin: 582.883px 137.404px;" id="el2hku7ndpoah"
                            class="animable"></path>
                        <path
                            d="M570.56,125.1a1.1,1.1,0,0,0,1,1.13,1.05,1.05,0,0,0,1.15-1,1.09,1.09,0,0,0-1-1.12A1,1,0,0,0,570.56,125.1Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 571.635px 125.167px;" id="elvumyo8e55j"
                            class="animable"></path>
                        <path
                            d="M570.16,123.67c.13.14,1-.45,2.15-.41s2,.64,2.14.5-.06-.32-.43-.61a3,3,0,0,0-1.72-.57,2.81,2.81,0,0,0-1.71.5C570.22,123.35,570.09,123.6,570.16,123.67Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 572.318px 123.18px;" id="eltabhyfhe25"
                            class="animable"></path>
                        <path
                            d="M582.47,125.84a1.09,1.09,0,0,0,1,1.13,1,1,0,0,0,1.15-1,1.08,1.08,0,0,0-1-1.12A1,1,0,0,0,582.47,125.84Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 583.545px 125.91px;" id="el4nm9fe1fwzq"
                            class="animable"></path>
                        <path
                            d="M582.39,124.41c.13.15,1-.44,2.15-.41s2,.64,2.15.5-.07-.32-.44-.6a2.87,2.87,0,0,0-1.71-.58,2.91,2.91,0,0,0-1.72.5C582.46,124.09,582.33,124.34,582.39,124.41Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 584.557px 123.92px;" id="elo2mxgi5qsfj"
                            class="animable"></path>
                        <path
                            d="M577.91,133a7.56,7.56,0,0,0-1.9-.39c-.3,0-.58-.11-.62-.31a1.46,1.46,0,0,1,.22-.89l.94-2.25a39.1,39.1,0,0,0,2.15-5.92,39.62,39.62,0,0,0-2.62,5.73c-.31.79-.62,1.55-.91,2.27a1.75,1.75,0,0,0-.18,1.17.75.75,0,0,0,.48.46,2.05,2.05,0,0,0,.51.08A7.63,7.63,0,0,0,577.91,133Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 576.829px 128.139px;" id="el58065cmw375"
                            class="animable"></path>
                        <path d="M576.74,146.87a21.66,21.66,0,0,0,11.46-2.75s-2.91,5.77-11.4,4.76Z"
                            style="fill: rgb(163, 105, 87); transform-origin: 582.47px 146.559px;" id="elx08od43heaf"
                            class="animable"></path>
                        <path d="M586.15,121c-.24.37-1.14.21-2.14,0s-1.88-.38-2-.81.93-1,2.27-.73S586.39,120.68,586.15,121Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 584.097px 120.306px;" id="elv6yww2xw11q"
                            class="animable"></path>
                        <path
                            d="M574.48,119.3c-.09.43-1.05.59-2.15.64s-2.07,0-2.2-.44.8-1.06,2.13-1.12S574.57,118.89,574.48,119.3Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 572.302px 119.166px;" id="el17b9k7xqfai"
                            class="animable"></path>
                        <path d="M577.93,135.81a.58.58,0,0,0-.65.3.67.67,0,1,0,1.17,0,.67.67,0,0,0-.77-.33"
                            style="fill: rgb(163, 105, 87); transform-origin: 577.865px 136.431px;" id="el1hhfr5syxoi"
                            class="animable"></path>
                        <path
                            d="M578.2,135.93c0-.05-.19-.34-.7-.23a.9.9,0,0,0-.64.63,1,1,0,0,0,.35,1.06,1,1,0,0,0,1.13,0,.84.84,0,0,0,.36-.83c-.1-.53-.49-.61-.51-.54s.14.25.11.56a.47.47,0,0,1-.24.37.51.51,0,0,1-.51,0,.53.53,0,0,1-.18-.49.49.49,0,0,1,.27-.37C577.92,135.92,578.17,136,578.2,135.93Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 577.767px 136.62px;" id="elj17si5rku3i"
                            class="animable"></path>
                        <path
                            d="M593,127.21c-1,2.34-3.48,4.15-3.14,6.68.22,1.63,1.27,3.15,1.07,4.79-.26,2-2.39,3.48-2.7,5.53-.37,2.51,2.08,4.46,3.05,6.8,1.43,3.42-.39,7.26-.44,11a11.74,11.74,0,0,0,10.4,11.42c2.28.19,4.85-.5,6-2.46,1-1.62.78-3.68,1.36-5.47.88-2.68,3.43-4.64,4-7.4,1-5-5.1-9.2-4.7-14.32.17-2.19,1.52-4.09,2.09-6.21a9.12,9.12,0,0,0-1.78-8.09c-1.51-1.79-3.69-3-5-4.92-1.45-2.21-1.5-5-2-7.61a19.18,19.18,0,0,0-30.46-11.23s-1.45,6.59,5.32,7.7,9.9-.17,10.66,2.54a7.16,7.16,0,0,0,2,6.19C591.49,125.13,594.12,124.49,593,127.21Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 591.665px 137.601px;" id="elnqu6kjelvp"
                            class="animable"></path>
                        <path
                            d="M603.75,172.92a2.39,2.39,0,0,1-.62-.06,9.78,9.78,0,0,1-1.72-.47,12.21,12.21,0,0,1-5.24-3.87,13.86,13.86,0,0,1-2.22-4,15.85,15.85,0,0,1-.91-5.13,21.19,21.19,0,0,1,.72-5.71,24.45,24.45,0,0,1,1-2.89,29.55,29.55,0,0,0,1.09-2.87,5.34,5.34,0,0,0,0-2.94,16.3,16.3,0,0,0-1.13-2.74,18,18,0,0,1-1.17-2.71,5.85,5.85,0,0,1-.21-2.87c.4-1.88,1.54-3.28,2.22-4.71a8.91,8.91,0,0,0,.9-4.26,10.05,10.05,0,0,0-2.23-5.9,17.59,17.59,0,0,0-1.69-1.65,6.84,6.84,0,0,1,1.85,1.52,10,10,0,0,1,2.44,6,9.24,9.24,0,0,1-.88,4.46c-.69,1.48-1.8,2.89-2.14,4.61s.47,3.53,1.36,5.27a15.58,15.58,0,0,1,1.18,2.83,5.89,5.89,0,0,1,0,3.2A31.35,31.35,0,0,1,595.2,151a23.52,23.52,0,0,0-1,2.83,20.61,20.61,0,0,0-.73,5.57,14.46,14.46,0,0,0,2.94,8.88,12.28,12.28,0,0,0,5,3.91C602.9,172.77,603.76,172.86,603.75,172.92Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 598.145px 146.531px;" id="eluxnp995u1if"
                            class="animable"></path>
                        <path
                            d="M602.75,122.46a7.07,7.07,0,0,1-1.49.22,15.51,15.51,0,0,1-4.12-.11,7.85,7.85,0,0,1-5.2-3.15,17,17,0,0,1-1.36-3.36,5.58,5.58,0,0,0-2.28-2.81c-2.19-1.39-4.76-1.56-7-1.83a12.21,12.21,0,0,1-5.83-1.82,5.77,5.77,0,0,1-2.39-3.33,3.35,3.35,0,0,1-.07-1.13c0-.26.06-.39.08-.39a7.08,7.08,0,0,0,.19,1.47,5.72,5.72,0,0,0,2.4,3.08,12.09,12.09,0,0,0,5.67,1.64c2.24.26,4.9.39,7.24,1.87a6.08,6.08,0,0,1,2.48,3.07,16.73,16.73,0,0,0,1.29,3.28,7.55,7.55,0,0,0,4.86,3,17.26,17.26,0,0,0,4,.27A10.11,10.11,0,0,1,602.75,122.46Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 587.87px 113.759px;" id="ell4uij58lago"
                            class="animable"></path>
                        <path
                            d="M600.27,114.32a3.33,3.33,0,0,1-1.17.17,7.13,7.13,0,0,1-5-2,9.18,9.18,0,0,1-1.55-2.07c-.9-1.52-1.77-3.39-3.64-4.17a12,12,0,0,0-5.6-.49,17.18,17.18,0,0,1-4.78,0,6,6,0,0,1-3-1.32,3.32,3.32,0,0,1-.58-.66q-.18-.26-.15-.27s.28.32.86.77a6.3,6.3,0,0,0,2.89,1.12,18.14,18.14,0,0,0,4.68-.08,12,12,0,0,1,5.85.5,5.75,5.75,0,0,1,2.39,2,25.76,25.76,0,0,1,1.45,2.42,9.52,9.52,0,0,0,1.45,2,7,7,0,0,0,1.71,1.27,7.42,7.42,0,0,0,3,.83C599.85,114.33,600.26,114.27,600.27,114.32Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 587.533px 109.001px;" id="elzqcu1lagbe"
                            class="animable"></path>
                        <path
                            d="M606.73,170.76c-.05,0,.27-.66.64-1.9a17.2,17.2,0,0,0,.66-5.36,16.32,16.32,0,0,0-2.13-7.63c-.73-1.31-1.84-2.48-2.75-3.92a7,7,0,0,1-1-2.41,5.39,5.39,0,0,1,.22-2.7c.56-1.73,1.56-3.18,1.78-4.77s-.54-3-1.3-4.33a21.3,21.3,0,0,1-1.07-2,7.32,7.32,0,0,1-.57-2.09,18.12,18.12,0,0,1,.12-3.81,10.11,10.11,0,0,0-.48-5.32,4.84,4.84,0,0,0-1.18-1.56s.05,0,.12.06a1.22,1.22,0,0,1,.32.23,3.57,3.57,0,0,1,.93,1.19,9.88,9.88,0,0,1,.65,5.43,19.17,19.17,0,0,0-.05,3.73,9.6,9.6,0,0,0,1.62,3.88,13.3,13.3,0,0,1,1.09,2.13,5,5,0,0,1,.3,2.52c-.24,1.75-1.27,3.23-1.79,4.86a5,5,0,0,0-.21,2.45,6.66,6.66,0,0,0,.94,2.23c.85,1.39,2,2.58,2.73,3.95a16.5,16.5,0,0,1,2.08,7.87,16.18,16.18,0,0,1-.84,5.43,10.43,10.43,0,0,1-.58,1.38A1.84,1.84,0,0,1,606.73,170.76Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 604.036px 146.86px;" id="elz2416f4voxf"
                            class="animable"></path>
                        <path
                            d="M566,357.09s-6.74-63.84-7.13-87.43,10.61-46.87,10.61-46.87L612.56,221s8.52,23.93,8.67,34c.3,19.54-5.19,38.83-4.56,54.33l1.44,47.8"
                            style="fill: rgb(38, 50, 56); transform-origin: 590.051px 289.065px;" id="elaj8um58z7rl"
                            class="animable"></path>
                        <path
                            d="M619.56,278.6a6.88,6.88,0,0,1-.71.54l-.39.27-.42.41a6.92,6.92,0,0,0-1,1.07c-1.39,1.7-2.4,4.75-3.37,8.54a28.7,28.7,0,0,1-2.18,6.08,10.64,10.64,0,0,1-1,1.51c-.18.24-.35.5-.56.73l-.66.66a10.71,10.71,0,0,1-3.24,2.08c-2.41,1.06-5.14,1.56-7.62,2.81a12,12,0,0,0-5.53,6.3c-1.22,2.71-2,5.55-3,8.21s-2.35,5.2-4.5,6.82a12.36,12.36,0,0,1-7,2.21c-2.32.14-4.47.07-6.4.36a10.11,10.11,0,0,0-4.82,1.82,6.76,6.76,0,0,0-2.24,3.16,4.8,4.8,0,0,0-.17,2.45c.12.56.27.83.24.84a2.52,2.52,0,0,1-.34-.82,4.59,4.59,0,0,1,.08-2.53,6.8,6.8,0,0,1,2.25-3.33,10.25,10.25,0,0,1,5-2c2-.32,4.13-.28,6.42-.43a12,12,0,0,0,6.79-2.16,14.52,14.52,0,0,0,4.31-6.62c1-2.63,1.73-5.48,3-8.24a12.5,12.5,0,0,1,5.78-6.55c2.58-1.28,5.31-1.77,7.66-2.79a10.49,10.49,0,0,0,3.12-2l.63-.63c.2-.22.37-.47.55-.7a9.65,9.65,0,0,0,.93-1.45,28.68,28.68,0,0,0,2.21-6c1-3.78,2.09-6.87,3.56-8.58a6.51,6.51,0,0,1,1-1.06c.16-.14.3-.28.44-.39l.41-.26A6.93,6.93,0,0,1,619.56,278.6Z"
                            style="fill: rgb(250, 250, 250); transform-origin: 592.035px 307.035px;" id="elaevvdiqkusr"
                            class="animable"></path>
                        <path
                            d="M619.82,249.06a4.67,4.67,0,0,1,.06.85,10.48,10.48,0,0,1-.3,2.45,15.75,15.75,0,0,1-4.87,7.52,28.93,28.93,0,0,1-5,3.69c-1.93,1.14-4.06,2.23-6.25,3.47a32.29,32.29,0,0,0-6.38,4.49,24.64,24.64,0,0,0-4.84,6.79,62.1,62.1,0,0,1-4.19,7.39,17.66,17.66,0,0,1-2.74,3A16.54,16.54,0,0,1,582,290.9a39.9,39.9,0,0,1-6.69,2.57c-2.14.66-4.14,1.25-5.88,2a22.51,22.51,0,0,0-4.48,2.4,13.87,13.87,0,0,0-2.81,2.59,12.85,12.85,0,0,0-1.69,2.8,5.28,5.28,0,0,1,.28-.81,10,10,0,0,1,1.25-2.12,13.47,13.47,0,0,1,2.8-2.7,22.83,22.83,0,0,1,4.51-2.5,60,60,0,0,1,5.89-2.05,41.38,41.38,0,0,0,6.6-2.58,17.05,17.05,0,0,0,3.15-2.12,17.74,17.74,0,0,0,2.64-2.94,64.33,64.33,0,0,0,4.15-7.34,24.83,24.83,0,0,1,5-6.92,32.23,32.23,0,0,1,6.5-4.54c2.2-1.23,4.33-2.3,6.26-3.43a28.87,28.87,0,0,0,5-3.58,15.86,15.86,0,0,0,4.92-7.31A15.29,15.29,0,0,0,619.82,249.06Z"
                            style="fill: rgb(250, 250, 250); transform-origin: 590.166px 276.16px;" id="elefrmu7de964"
                            class="animable"></path>
                        <path
                            d="M559.09,273a.75.75,0,0,1-.09-.2,5.22,5.22,0,0,1-.19-.59,4.78,4.78,0,0,1,.1-2.4c.56-2,2.77-4.57,6.33-5.84,1.78-.61,3.79-1,5.89-1.52a11.09,11.09,0,0,0,8.15-6.07,32.14,32.14,0,0,0,1.49-3.59,39.13,39.13,0,0,1,3.17-7.67,12.22,12.22,0,0,1,6.52-5.07,59.22,59.22,0,0,1,7.49-1.9,24.83,24.83,0,0,0,6.51-2.22,13.7,13.7,0,0,0,4.4-4,14.88,14.88,0,0,0,2.8-8.1,23,23,0,0,0-.21-3.2,10.41,10.41,0,0,1,.41,3.2,14.73,14.73,0,0,1-2.7,8.31,13.84,13.84,0,0,1-4.49,4.13,24.93,24.93,0,0,1-6.61,2.31,59.58,59.58,0,0,0-7.42,1.91,11.74,11.74,0,0,0-6.26,4.87,39.19,39.19,0,0,0-3.13,7.56,31.15,31.15,0,0,1-1.53,3.65,13.21,13.21,0,0,1-2.24,3.1,13,13,0,0,1-6.25,3.15c-2.12.54-4.12.88-5.87,1.46-3.47,1.18-5.67,3.61-6.26,5.55a5.07,5.07,0,0,0-.19,2.32A5,5,0,0,1,559.09,273Z"
                            style="fill: rgb(250, 250, 250); transform-origin: 585.283px 246.815px;" id="elz7i03x0l9dc"
                            class="animable"></path>
                        <path
                            d="M616.12,327a3.82,3.82,0,0,1,.07.63,6.64,6.64,0,0,1-.19,1.8,10.21,10.21,0,0,1-3.78,5.4,16.67,16.67,0,0,1-4,2.36c-1.53.65-3.22,1.17-5,1.72a41.32,41.32,0,0,0-5.41,2A15.45,15.45,0,0,0,593,344.5c-1.46,1.52-2.72,3.19-4.12,4.67a18.77,18.77,0,0,1-4.61,3.6,20.31,20.31,0,0,1-9.51,2.48,18.94,18.94,0,0,1-6.54-1.09,12.48,12.48,0,0,1-1.66-.71,2.63,2.63,0,0,1-.55-.31,4.25,4.25,0,0,1,.59.21,17.72,17.72,0,0,0,1.68.62,20,20,0,0,0,6.48.91,20.21,20.21,0,0,0,9.28-2.53,18.68,18.68,0,0,0,4.47-3.53c1.37-1.46,2.62-3.12,4.11-4.68a16.06,16.06,0,0,1,5.08-3.7,41.39,41.39,0,0,1,5.49-2c1.76-.54,3.44-1,5-1.66a16.77,16.77,0,0,0,3.9-2.25,10.2,10.2,0,0,0,3.81-5.16A12.69,12.69,0,0,0,616.12,327Z"
                            style="fill: rgb(250, 250, 250); transform-origin: 591.102px 341.126px;" id="el7g1y5j2ryza"
                            class="animable"></path>
                        <path
                            d="M611.21,194.46l-8.34.2a13.49,13.49,0,0,1-1.88,4.73c-7-12.1-12.37-28.3-13.71-34.81.2-.65.43-1.37.72-2.17a9.24,9.24,0,0,0-.11-3.66c-.24-1.45-.64-3.4-.76-4.3-.37-2.76-.82-3.19-1.78-2.88-1.3.43.54,7.73-.53,7.89-.58.08-1.28-2.42-1.48-4.47s-1.14-8.37-1.81-8.79c-1-.62-1.87.36-1.61,2.4s.57,8.24-.51,8.33-2-10.39-2-10.39.17-2.28-1.09-2.23c-2.26.1-.49,11.14-.3,12.19.14.72-1,.86-1.14.07s-.66-10.47-3-10.39c-1.78,0,1.37,9.09.37,11.19s-1.68-7.12-3.37-7c-.63.05-1.1.17.06,5.38a118.2,118.2,0,0,0,4,12.21c2.68,14.45,14.44,60.68,32.87,52.22,10.32-4.74,14.5-25.72,14.5-25.72Z"
                            style="fill: rgb(183, 136, 118); transform-origin: 594.27px 182.757px;" id="ele1tnpncfy1k"
                            class="animable"></path>
                        <path
                            d="M575.66,157.2a.49.49,0,0,0,.24,0,.53.53,0,0,0,.37-.58c0-.62-.12-1.52-.26-2.69a37.55,37.55,0,0,1-.46-4.26c0-.84,0-1.74.05-2.69a9.9,9.9,0,0,1,.15-1.44c.08-.45.38-1,.73-.91h.06c.35,0,.63.26.74.68a3.92,3.92,0,0,1,.14,1.34v0h0a78,78,0,0,0,1.07,8.35c.08.37.16.75.28,1.13a4.3,4.3,0,0,0,.2.57,3.18,3.18,0,0,0,.17.3.55.55,0,0,0,.42.26.74.74,0,0,0,.63-.53,2.86,2.86,0,0,0,.19-.61,10.19,10.19,0,0,0,.16-1.22,36.44,36.44,0,0,0-.07-5,11.3,11.3,0,0,1-.1-2.51,1.4,1.4,0,0,1,.49-.93.53.53,0,0,1,.43-.05.82.82,0,0,1,.24.1.32.32,0,0,1,.11.15,12.75,12.75,0,0,1,.69,2.51c.18.88.33,1.79.47,2.7s.27,1.83.38,2.76a20.36,20.36,0,0,0,.46,2.85,11,11,0,0,0,.45,1.41,2.65,2.65,0,0,0,.42.71.59.59,0,0,0,.59.22.62.62,0,0,0,.41-.45,5,5,0,0,0,.11-1.56c0-.5-.06-1-.11-1.48-.07-.84-.15-1.67-.18-2.49a9.68,9.68,0,0,1,0-1.21,2,2,0,0,1,.13-.52.49.49,0,0,1,.09-.15l0,0,.13,0c.66-.27.88.65,1.06,1.39s.25,1.58.41,2.37c.26,1.57.6,3.14.77,4.64a5.53,5.53,0,0,1-.08,2.16c-.24.72-.48,1.43-.71,2.14l0,.07,0,.06a115.17,115.17,0,0,0,4.47,14.46c1.58,4.27,3.17,8,4.56,11s2.65,5.35,3.51,6.93l1,1.79a3.36,3.36,0,0,0,.39.6,4,4,0,0,0-.31-.64l-1-1.83c-.82-1.61-2-4-3.36-7s-2.9-6.73-4.44-11a119.4,119.4,0,0,1-4.38-14.42v.14c.23-.7.46-1.41.7-2.12a5.72,5.72,0,0,0,.12-2.39c-.18-1.57-.51-3.09-.77-4.67-.15-.78-.25-1.58-.41-2.4A4.4,4.4,0,0,0,587,152a1.18,1.18,0,0,0-.55-.56,1.27,1.27,0,0,0-.79,0l-.16,0a.65.65,0,0,0-.23.13.88.88,0,0,0-.25.35,2.26,2.26,0,0,0-.17.68,9.46,9.46,0,0,0,0,1.3c0,.84.12,1.68.19,2.52,0,.49.08,1,.1,1.45a4.86,4.86,0,0,1-.07,1.35c0,.1-.08.08,0,.13h0s0,0,0,0h0s0,0,0,0,0,0,0,0l-.06-.06a2,2,0,0,1-.3-.54,9.83,9.83,0,0,1-.43-1.33,18.59,18.59,0,0,1-.45-2.77q-.16-1.41-.39-2.79c-.14-.92-.3-1.82-.48-2.72a12.18,12.18,0,0,0-.76-2.67.85.85,0,0,0-.31-.35,1.73,1.73,0,0,0-.37-.16,1.11,1.11,0,0,0-.85.12,1.87,1.87,0,0,0-.74,1.3,4.85,4.85,0,0,0,0,1.37c0,.43.1.85.13,1.27a37,37,0,0,1,.09,4.92,8.54,8.54,0,0,1-.15,1.16,2.23,2.23,0,0,1-.15.52.61.61,0,0,1-.11.18c0,.09-.07,0-.06.12,0-.1,0,0,0-.13a2,2,0,0,1-.12-.21c-.07-.16-.13-.34-.19-.51-.11-.36-.19-.73-.27-1.09a79.46,79.46,0,0,1-1.13-8.28v0a4.35,4.35,0,0,0-.17-1.49,1.4,1.4,0,0,0-.39-.66,1,1,0,0,0-.74-.28h.06a.87.87,0,0,0-.87.41,2.21,2.21,0,0,0-.3.78,10.09,10.09,0,0,0-.14,1.5c0,1,0,1.87,0,2.72a34.89,34.89,0,0,0,.55,4.28c.17,1.16.3,2.06.36,2.67a.47.47,0,0,1-.29.52C575.74,157.18,575.65,157.19,575.66,157.2Z"
                            style="fill: rgb(163, 105, 87); transform-origin: 588.24px 171.915px;" id="el6e1jr7u6nea"
                            class="animable"></path>
                        <path
                            d="M510.53,208.23a21.41,21.41,0,0,0-5.79.67c-5.17,1.36-14.08,6.76-14.45,13.43h6.48s-3.63,7.72-2.57,7c2.77-1.86,8.27-7.45,8.27-7.45Z"
                            style="fill: rgb(183, 136, 118); transform-origin: 500.41px 218.801px;" id="elc9tiua6j4yt"
                            class="animable"></path>
                        <path d="M598.86,92c-.15,0-.73-5.34-1.31-12s-.94-12-.8-12,.73,5.34,1.31,12S599,92,598.86,92Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 597.805px 80px;" id="elw0h04dg6dlg"
                            class="animable"></path>
                        <path
                            d="M627.27,68.41c.11.08-4.26,6.43-9.77,14.18s-10.08,14-10.2,13.88,4.26-6.43,9.77-14.18S627.15,68.33,627.27,68.41Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 617.285px 82.4405px;" id="elj40xqw7niid"
                            class="animable"></path>
                        <path
                            d="M639.07,97.19c0,.14-5.08,1.31-11.4,2.61s-11.48,2.24-11.51,2.1,5.07-1.31,11.4-2.61S639,97.05,639.07,97.19Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 627.615px 99.545px;" id="ellhh1o098zn"
                            class="animable"></path>
                    </g>
                    <g id="freepik--Folder--inject-12" class="animable" style="transform-origin: 366.753px 314.59px;">
                        <path
                            d="M299,234.54,263.6,416.34,259,440.14,495,439c10.6-.05,20-9.46,23.39-23.44l41.86-171.63c2.59-10.61-3.09-21.65-11.13-21.64l-238.92.25C305,222.53,300.34,227.45,299,234.54Z"
                            style="fill: rgb(207, 216, 220); transform-origin: 409.942px 331.215px;" id="el9grxnugrznv"
                            class="animable"></path>
                        <g id="elzfi0gkp5sw9">
                            <g style="opacity: 0.5; transform-origin: 409.942px 331.215px;" class="animable">
                                <path
                                    d="M299,234.54,263.6,416.34,259,440.14,495,439c10.6-.05,20-9.46,23.39-23.44l41.86-171.63c2.59-10.61-3.09-21.65-11.13-21.64l-238.92.25C305,222.53,300.34,227.45,299,234.54Z"
                                    id="elqu4eevp45e" class="animable" style="transform-origin: 409.942px 331.215px;">
                                </path>
                            </g>
                        </g>
                        <path
                            d="M472.39,404l-25-201.41c-1-8.25-7.59-14.41-15.36-14.38l-54.8.17a15,15,0,0,0-10.83,4.8l-26,27.67L188,221.67c-9.31.05-16.47,8.87-15.24,18.77l23.21,186.15c1,8.24,7.59,14.39,15.34,14.38l265.65-.53c29.58.61,32.41-8.12,32.41-8.12C475.41,439.83,472.39,404.05,472.39,404Z"
                            style="fill: rgb(207, 216, 220); transform-origin: 340.996px 314.59px;" id="elvl9mi6v9c6i"
                            class="animable"></path>
                        <g id="elbsxqyc0lbvd">
                            <g style="opacity: 0.5; transform-origin: 318.86px 337.49px;" class="animable">
                                <polygon points="357.84 363.72 348.88 373.34 279.88 311.26 288.84 301.64 357.84 363.72"
                                    style="fill: rgb(255, 255, 255); transform-origin: 318.86px 337.49px;"
                                    id="eluxwap9v7ks" class="animable"></polygon>
                                <polygon points="345.13 299.51 355.03 308.42 292.6 375.47 282.69 366.56 345.13 299.51"
                                    style="fill: rgb(255, 255, 255); transform-origin: 318.86px 337.49px;"
                                    id="el2vp1anqs6qh" class="animable"></polygon>
                            </g>
                        </g>
                    </g>
                    <g id="freepik--speech-bubble--inject-12" class="animable animator-hidden"
                        style="transform-origin: 514.235px 92.0246px;">
                        <path
                            d="M510.32,103.78a1.85,1.85,0,0,1-1.13-1.63l-.4-9.28a1.86,1.86,0,0,1,2.29-1.9,5.82,5.82,0,0,0,4.52-.89,5.21,5.21,0,0,0,2.33-3.42,5.33,5.33,0,0,0-1.12-4,6,6,0,0,0-3.94-2.37,7,7,0,0,0-7.1,5,1.87,1.87,0,0,1-3.6-1,10.76,10.76,0,0,1,11.13-7.77,9.66,9.66,0,0,1,6.49,3.83,9.13,9.13,0,0,1,1.83,6.87,9,9,0,0,1-4,5.92,9.72,9.72,0,0,1-5.06,1.65l.31,7.16a1.87,1.87,0,0,1-2.6,1.79Z"
                            style="fill: rgb(207, 216, 220); transform-origin: 511.916px 90.1901px;" id="elx093j2sgzoi"
                            class="animable"></path>
                        <path d="M513.06,107.58a1.53,1.53,0,1,1-1.63-1.42A1.52,1.52,0,0,1,513.06,107.58Z"
                            style="fill: rgb(207, 216, 220); transform-origin: 511.534px 107.686px;" id="elu96d42xsgr"
                            class="animable"></path>
                        <path
                            d="M478.19,90.69a4.68,4.68,0,0,0,.09-.6c0-.44.11-1,.19-1.79a21.67,21.67,0,0,1,.49-2.88c.13-.56.2-1.18.4-1.81s.4-1.31.62-2a34.49,34.49,0,0,1,5-9.53,33.5,33.5,0,0,1,10.51-9.14,33,33,0,0,1,7.41-3.06,33.55,33.55,0,0,1,8.55-1.12A33.16,33.16,0,0,1,516,59c.77.08,1.53.28,2.3.41a17.12,17.12,0,0,1,2.3.56A32,32,0,0,1,529.49,64a33.44,33.44,0,0,1,13.22,16.6,32.74,32.74,0,0,1,2,11.41,32.16,32.16,0,0,1-2.09,11.74l-.45,1.14-.06.15.06.15c2.51,5.77,5,11.44,7.35,16.93l.42-.48-15-5.75-.18-.07-.15.14a33.49,33.49,0,0,1-14.14,8.16,33.31,33.31,0,0,1-27-4.19,34.17,34.17,0,0,1-8.43-7.85,33.21,33.21,0,0,1-6.4-15.34c-.12-1-.22-1.84-.31-2.6s0-1.38-.05-1.91,0-.88,0-1.17a.2.2,0,1,0-.06,0c0,.29,0,.68,0,1.17s0,1.17,0,1.93.17,1.63.27,2.62a35.77,35.77,0,0,0,1.71,7.06,36.61,36.61,0,0,0,4.58,8.5,34.47,34.47,0,0,0,8.49,8,33.75,33.75,0,0,0,27.41,4.38A34,34,0,0,0,535,116.48l-.33.07,15,5.78.75.29-.33-.77c-2.38-5.49-4.84-11.15-7.34-16.93v.29l.46-1.17a32.7,32.7,0,0,0,2.14-12,33.45,33.45,0,0,0-2-11.66,34,34,0,0,0-13.51-16.91,32.3,32.3,0,0,0-9.12-4.1,15.89,15.89,0,0,0-2.34-.55c-.78-.14-1.55-.34-2.33-.41a34.39,34.39,0,0,0-4.61-.26,33.56,33.56,0,0,0-8.68,1.18,34.19,34.19,0,0,0-7.51,3.14,33.57,33.57,0,0,0-10.57,9.35,34.2,34.2,0,0,0-4.93,9.68c-.21.72-.41,1.41-.59,2a17.6,17.6,0,0,0-.38,1.83,19,19,0,0,0-.42,2.9c-.06.77-.1,1.36-.13,1.8A2.54,2.54,0,0,0,478.19,90.69Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 514.235px 92.0246px;" id="elsdjxfahrkzq"
                            class="animable"></path>
                    </g>
                    <defs>
                        <filter id="active" height="200%">
                            <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2">
                            </feMorphology>
                            <feFlood flood-color="#32DFEC" flood-opacity="1" result="PINK"></feFlood>
                            <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
                            <feMerge>
                                <feMergeNode in="OUTLINE"></feMergeNode>
                                <feMergeNode in="SourceGraphic"></feMergeNode>
                            </feMerge>
                        </filter>
                        <filter id="hover" height="200%">
                            <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2">
                            </feMorphology>
                            <feFlood flood-color="#ff0000" flood-opacity="0.5" result="PINK"></feFlood>
                            <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
                            <feMerge>
                                <feMergeNode in="OUTLINE"></feMergeNode>
                                <feMergeNode in="SourceGraphic"></feMergeNode>
                            </feMerge>
                            <feColorMatrix type="matrix"
                                values="0   0   0   0   0                0   1   0   0   0                0   0   0   0   0                0   0   0   1   0 ">
                            </feColorMatrix>
                        </filter>
                    </defs>
                </svg>
                <p class="text-gray-400 mb-4">No Items in the cart yet.</p>
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
                            document.getElementById('total_amount').innerText = response.data.total + " MMK";
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
                            document.getElementById('total_amount').innerText = response.data.total + " MMK";
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
                        if (response.data.cartLength <= 1) {
                            let showCart = document.querySelector(".show_cart");
                            let emptyCart = document.querySelector(".empty_cart");
                            showCart.classList.add('hidden');
                            emptyCart.classList.remove('hidden');
                        }
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

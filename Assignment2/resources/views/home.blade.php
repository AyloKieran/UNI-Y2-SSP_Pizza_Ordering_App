<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-4">

        <div class="flex flex-wrap md:flex-nowrap max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white w-100 md:w-4/5 sm:w-100 shadow-sm sm:rounded-lg md:mr-2 p-4">
                <h1 class="text-2xl pb-4">Pizzas</h1>
                <form method="POST" method="/cart">
                    @csrf
                    @foreach ($pizzas as $pizza)
                    <input type="radio" id="pizza" name="pizza" value="{{ $pizza->name }}">
                    <label for="pizza">{{ $pizza->name }} - Small: £@money($pizza->smallprice) | Medium:
                        £@money($pizza->mediumprice) | Large: £@money($pizza->largeprice)</label>
                    <p class="pl-8 pb-4">{{ $pizza->toppings }}</p>
                    @endforeach

                    @error('pizza')
                    <p class="text-sm text-red-700">{{ $message }}</p>
                    @enderror

                    <div class="pl-8 flex flex-wrap">
                        @foreach ($toppings as $topping)
                        <div class="mr-2 mb-2 p-1 rounded bg-gray-50 shadow hover:bg-gray-100 hover:shadow-md">
                            <input type="checkbox" id="{{ $topping->id }}" name="toppings[]"
                                value="{{ $topping->name }}">
                            <label for="{{ $topping->id }}" class="text-xs">{{ $topping->name }}</label>
                        </div>
                        @endforeach
                    </div>

                    @error('toppings')
                    <p class="text-sm text-red-700">{{ $message }}</p>
                    @enderror

                    @error('size')
                    <p class="text-sm text-red-700">{{ $message }}</p>
                    @enderror
                    <div class="w-full flex">
                        <div class="flex flex-grow mt-8 h-8">
                            <div class="bg-gray-700 p-1 rounded shadow mr-2">
                                <input type="radio" id="size" name="size" value="small">
                                <label for="size" class="text-white font-bold">Small</label>
                            </div>
                            <div class="bg-gray-700 p-1 rounded shadow mr-2">
                                <input type="radio" id="size" name="size" value="medium">
                                <label for="size" class="text-white font-bold">Medium</label>
                            </div>
                            <div class="bg-gray-700 p-1 rounded shadow mr-2">
                                <input type="radio" id="size" name="size" value="large">
                                <label for="size" class="text-white font-bold">Large</label>
                            </div>
                        </div>
                        <button type="sumbit" name="submit" class="mt-4 p-2 bg-gray-200 rounded shadow">
                            Add to Order
                        </button>
                    </div>

                </form>
            </div>
            <div class="bg-white w-full mt-2 md:w-2/6 md:mt-0 shadow-sm sm:rounded-lg p-4">
                <h1 class="text-2xl pb-2">Cart</h1>
                <div class="flex flex-col">
                    <div>
                    @forelse ($cart as $cartitem)
                    <div class="mb-2 p-2 bg-gray-50 rounded shadow">
                        <h2 class="text-lg"><span class="font-bold">{{ $cartitem['name'] }}</span>
                            ({{ $cartitem['size'] }})
                        </h2>
                        <h2 class="text-md">£@money($cartitem['price'])</h2>
                        <p class="text-xs">
                            @foreach ($cartitem['toppings'] as $topping)
                            @if($loop->last)
                            {{ $topping }}
                            @else
                            {{ $topping }},
                            @endif
                            @endforeach
                        </p>
                    </div>
                    @empty
                    <h2 class="text-lg pb-4">Cart is Empty</h2>
                    @endforelse
                    </div>

                    <h3 class="text-lg py-2 font-bold text-gray-700">Total: £@money($total)</h3>
                    <div class="flex-grow"></div>
                    <div class="">
                        <form method="POST" action="/cart">
                            @csrf
                            <div class="flex">
                                <div class="flex-grow">
                                    <input type="radio" id="delivery" name="deliverytype" value="Delivery">
                                    <label for="delivery">Delivery</label>
                                </div>
                                <div class="flex-grow">
                                    <input type="radio" id="collection" name="deliverytype" value="Collection">
                                    <label for="collection">Collection</label>
                                </div>
                            </div>

                            @error('deliverytype')
                            <p class="text-sm text-red-700">{{ $message }}</p>
                            @enderror
                            <div class="w-full">
                                <button type="sumbit" name="submit"
                                    class=" mt-4 p-2 bg-gray-200 rounded shadow hover:bg-gray-300 hover:shadow-md">
                                    Checkout
                                </button>
                            </div>

                        </form>

                        <div class="flex w-full justify-between">
                            <form method="POST" action="/cart/clear" class="">
                                @csrf
                                <button type="sumbit" name="submit"
                                    class="mt-4 p-1 bg-red-100 text-gray-600 text-sm rounded shadow hover:bg-red-200 hover:text-gray-700 hover:shadow-md">
                                    Clear Cart
                                </button>
                            </form>

                            <form method="POST" action="/cart/load" class="">
                                @csrf
                                <button type="sumbit" name="submit"
                                    class="mt-4 p-1 bg-blue-100 text-gray-500 text-sm rounded shadow hover:bg-blue-200 hover:text-gray-700 hover:shadow-md">
                                    Load Cart
                                </button>
                            </form>
                            <form method="POST" action="/cart/save" class="">
                                @csrf
                                <button type="sumbit" name="submit"
                                    class="mt-4 p-1 bg-blue-100 text-gray-500 text-sm rounded shadow hover:bg-blue-200 hover:text-gray-700 hover:shadow-md">
                                    Save Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

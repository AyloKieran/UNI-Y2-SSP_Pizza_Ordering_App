<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white border-b border-gray-200">
                    <h1 class="text-2xl">Cart</h1>
                    <div class="flex flex-col bg-gray-100 rounded-xl mb-4 mt-2 py-1">
                        @forelse ($cart as $cartitem)
                        <div class="p-2 mx-2 my-1 bg-gray-200 rounded shadow">
                            <h2 class="text-lg"><span class="font-bold">{{ $cartitem['name'] }}</span>
                                ({{ $cartitem['size'] }})</h2>
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

                    <h2 class="pb-4"><span class="font-bold">Delivery Type: </span>{{ $deliverytype }}</h2>
                    <div class="flex w-full justify-between">
                        <h3 class="w-1/2"><span class="font-bold">Deals Applied: </span>@forelse($applieddeals as $deal) <p>
                                {{ $deal }}</p> @empty <p>None</p> @endforelse</h3>
                        <h3 class="w-1/2"><span class="font-bold">Unsuitable Deals: </span>@forelse($unsuitabledeals as $deal) <p>
                                {{ $deal }}</p> @empty <p>None</p> @endforelse</h3>
                    </div>
                    <h4 class="text-xl pt-4"><span class="font-bold">Total: </span>£@money($total)</h4>
                    <h4 class="text-sm"><span class="font-bold">Savings: </span>£@money($savings)</h4>

                    <form method="POST" action="/order" class="">
                        @csrf
                        <button type="sumbit" name="submit"
                            class="mt-4 p-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 hover:shadow-md">
                            Order
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>

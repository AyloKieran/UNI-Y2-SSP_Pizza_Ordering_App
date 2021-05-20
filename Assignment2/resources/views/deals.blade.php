<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Deals') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white border-b border-gray-200">
                    <h1 class="text-2xl">Deals</h1>
                    <form method="POST">
                        @csrf
                        <div class="pb-2">
                            <input type="checkbox" id="Two for One Tuesdays" name="deals[]"
                                value="Two for One Tuesdays" @if(in_array('Two for One Tuesdays', $deals)) checked @endif>
                            <label for="Two for One Tuesdays" class="text-lg font-bold">Two for One Tuesdays</label>
                            <ul class="pl-8">
                                <li>Two Medium or Large Pizzas</li>
                                <li>Charged at the price of the highest pizza selected</li>
                                <li>Collection / Delivery</li>
                            </ul>
                        </div>

                        <div class="pb-2">
                            <input type="checkbox" id="Three for Two Thursdays" name="deals[]"
                                value="Three for Two Thursdays" @if(in_array('Three for Two Thursdays', $deals)) checked @endif>
                            <label for="Three for Two Thursdays" class="text-lg font-bold">Three for Two Thursdays</label>
                            <ul class="pl-8">
                                <li>Three Medium pizzas</li>
                                <li>Charged at the price of the two highest priced pizzas selected</li>
                                <li>Collection / Delivery</li>
                            </ul>
                        </div>

                        <div class="pb-2">
                            <input type="checkbox" id="Family Friday" name="deals[]" value="Family Friday" @if(in_array('Family Friday', $deals)) checked @endif>
                            <label for="Family Friday" class="text-lg font-bold">Family Friday</label>
                            <ul class="pl-8">
                                <li>Four Named Medium pizzas</li>
                                <li>Price £30</li>
                                <li>Collection Only</li>
                            </ul>
                        </div>

                        <div class="pb-2">
                            <input type="checkbox" id="Two Large" name="deals[]" value="Two Large" @if(in_array('Two Large', $deals)) checked @endif>
                            <label for="Two Large" class="text-lg font-bold">Two Large</label>
                            <ul class="pl-8">
                                <li>Two Named Large pizzas</li>
                                <li>Price £25</li>
                                <li>Collection Only</li>
                            </ul>
                        </div>

                        <div class="pb-2">
                            <input type="checkbox" id="Two Medium" name="deals[]" value="Two Medium" @if(in_array('Two Medium', $deals)) checked @endif>
                            <label for="Two Medium" class="text-lg font-bold">Two Medium</label>
                            <ul class="pl-8">
                                <li>Two Named Medium pizzas</li>
                                <li>Price £18</li>
                                <li>Collection Only</li>
                            </ul>
                        </div>

                        <div class="pb-2">
                            <input type="checkbox" id="Two Small" name="deals[]" value="Two Small" @if(in_array('Two Small', $deals)) checked @endif>
                            <label for="Two Small" class="text-lg font-bold">Two Small</label>
                            <ul class="pl-8">
                                <li>Two Named Small pizzas</li>
                                <li>Price £12</li>
                                <li>Collection Only</li>
                            </ul>
                        </div>
                        
                        <div class="flex w-full">
                            <div class="flex-grow"></div>
                            <button type="sumbit" name="submit" class="mt-4 p-2 bg-blue-600 rounded shadow hover:bg-blue-700 text-white">
                            Select Deal(s)
                        </button>

                        </div>

                        
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>

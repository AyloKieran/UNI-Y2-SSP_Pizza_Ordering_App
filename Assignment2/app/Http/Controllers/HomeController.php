<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;
use App\Models\Topping;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $pizzas = Pizza::all();
        $toppings = Topping::all();
        $cart = [];
        $total = 0;

        if($request->session()->get('order') != null)
        {
            foreach($request->session()->get('order') as $orderitem)
            {
                $orderitem = unserialize($orderitem);
                $total = $total + $orderitem['price'];

                array_push($cart, $orderitem);
            }
        }

        array_multisort(array_column($cart, 'price'), SORT_DESC, $cart);

        return view('home', ['pizzas' => $pizzas, 'toppings' => $toppings, 'cart' => $cart, 'total' => $total]);
    }

    public function addToCart(Request $request)
    {
        $this->validate($request, [
            'pizza' => ['required', 'string'],
            'toppings' => ['required_if:pizza,Create Your Own', 'array'],
            'size' => ['required', 'string'],
        ]);

        $selectedpizza = $request->pizza;

        $order = [
            'name' => $selectedpizza,
            'size' => $request->size,
            'toppings' => [],
            'price' => 0.00
        ];

        $pizza = Pizza::where('name', $selectedpizza)->first();

        if($selectedpizza != "Create Your Own") 
        {
            $order['toppings'] = explode(",", $pizza->toppings);
            switch ($order['size']) {
                case "small":
                    $order['price'] = $pizza->smallprice;
                    break;
                case "medium":
                    $order['price'] = $pizza->mediumprice;
                    break;
                case "large":
                    $order['price'] = $pizza->largeprice;
                    break;   
            }
        } else {
            $order['toppings'] = $request->toppings;

            $toppings = count($order['toppings']);

            switch ($order['size']) {
                case "small":
                    $order['price'] = ($toppings * 0.9) + $pizza->smallprice;
                    break;
                case "medium":
                    $order['price'] = ($toppings * 1) + $pizza->mediumprice;
                    break;
                case "large":
                    $order['price'] = ($toppings * 1.15) + $pizza->largeprice;
                    break;  
                }
        }

        $request->session()->push('order', serialize($order));

        return(redirect(route('home')));
    }
}

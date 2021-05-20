<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedOrders;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $deliverytype = $request->session()->get('deliverytype');
        $cart = [];

        $applieddeals = [];
        $unsuitabledeals = [];

        $originaltotal = 0.00;
        $newtotal = 0.00;

        $savings = 0.00;
        
        $dealitems = unserialize($request->session()->get('deals'));
        $order = $request->session()->get('order');

        if($dealitems != null)
        {
            foreach($dealitems as $dealitem)
            {
                array_push($unsuitabledeals, $dealitem);
            }
        }

        if($order != null)
        {
            foreach($order as $orderitem)
            {
                $orderitem = unserialize($orderitem);
                $originaltotal = $originaltotal + $orderitem['price'];
                array_push($cart, $orderitem);
            }
        }

        array_multisort(array_column($cart, 'price'), SORT_DESC, $cart);

        $dealcart = $cart;

        //Two for one Tuesdays

        if(in_array("Two for One Tuesdays", $unsuitabledeals))
        {
            $pizzas = [];
            foreach($dealcart as $key => $item)
            {
                if($item["size"] == "medium" || $item["size"] == "large")
                {
                    $pizzas[] = $item;
                    unset($dealcart[$key]);
                }
            }
            array_multisort(array_column($pizzas, 'price'), SORT_DESC, $pizzas);
            if(count($pizzas) >=2)
            {
                $newtotal = $newtotal + $pizzas[0]["price"];
                unset($pizzas[0]);
                unset($pizzas[1]);

                if(($key = array_search("Two for One Tuesdays", $unsuitabledeals)) !== false)
                {
                    $applieddeals[] = $unsuitabledeals[$key];
                    unset($unsuitabledeals[$key]);
                }
                
            }

            $dealcart = array_merge($pizzas, $dealcart);
        }

        // Three for Two Thursdays

        if(in_array("Three for Two Thursdays", $unsuitabledeals))
        {
            $pizzas = [];
            foreach($dealcart as $key => $item)
            {
                if($item["size"] == "medium")
                {
                    $pizzas[] = $item;
                    unset($dealcart[$key]);
                }
            
            }
            array_multisort(array_column($pizzas, 'price'), SORT_DESC, $pizzas);
            if(count($pizzas) >=3)
            {
                $newtotal = $newtotal + $pizzas[0]["price"];
                $newtotal = $newtotal + $pizzas[1]["price"];
                unset($pizzas[0]);
                unset($pizzas[1]);
                unset($pizzas[2]);

                if(($key = array_search("Three for Two Thursdays", $unsuitabledeals)) !== false)
                {
                    $applieddeals[] = $unsuitabledeals[$key];
                    unset($unsuitabledeals[$key]);
                }
                
            }

            $dealcart = array_merge($pizzas, $dealcart);
        }

        // Family Friday

        if(in_array("Family Friday", $unsuitabledeals))
        {
            $pizzas = [];
            foreach($dealcart as $key => $item)
            {
                if($item["size"] == "medium" && $item["name"] != "Create Your Own")
                {
                    $pizzas[] = $item;
                    unset($dealcart[$key]);
                }
            
            }
            array_multisort(array_column($pizzas, 'price'), SORT_DESC, $pizzas);
            if($deliverytype == "Collection")
            if(count($pizzas) >=4)
            {
                $newtotal = $newtotal + 30.00;
                unset($pizzas[0]);
                unset($pizzas[1]);
                unset($pizzas[2]);
                unset($pizzas[3]);

                if(($key = array_search("Family Friday", $unsuitabledeals)) !== false)
                {
                    $applieddeals[] = $unsuitabledeals[$key];
                    unset($unsuitabledeals[$key]);
                }
                
            }

            $dealcart = array_merge($pizzas, $dealcart);
        }

        // Two Large

        if(in_array("Two Large", $unsuitabledeals))
        {
            $pizzas = [];
            foreach($dealcart as $key => $item)
            {
                if($item["size"] == "large" && $item["name"] != "Create Your Own")
                {
                    $pizzas[] = $item;
                    unset($dealcart[$key]);
                }
            
            }
            array_multisort(array_column($pizzas, 'price'), SORT_DESC, $pizzas);
            if($deliverytype == "Collection")
            if(count($pizzas) >=2)
            {
                $newtotal = $newtotal + 25.00;
                unset($pizzas[0]);
                unset($pizzas[1]);

                if(($key = array_search("Two Large", $unsuitabledeals)) !== false)
                {
                    $applieddeals[] = $unsuitabledeals[$key];
                    unset($unsuitabledeals[$key]);
                }
                
            }

            $dealcart = array_merge($pizzas, $dealcart);
        }

        // Two Medium

        if(in_array("Two Medium", $unsuitabledeals))
        {
            $pizzas = [];
            foreach($dealcart as $key => $item)
            {
                if($item["size"] == "medium" && $item["name"] != "Create Your Own")
                {
                    $pizzas[] = $item;
                    unset($dealcart[$key]);
                }
            
            }
            array_multisort(array_column($pizzas, 'price'), SORT_DESC, $pizzas);
            if($deliverytype == "Collection")
            if(count($pizzas) >=2)
            {
                $newtotal = $newtotal + 18.00;
                unset($pizzas[0]);
                unset($pizzas[1]);

                if(($key = array_search("Two Medium", $unsuitabledeals)) !== false)
                {
                    $applieddeals[] = $unsuitabledeals[$key];
                    unset($unsuitabledeals[$key]);
                }
                
            }

            $dealcart = array_merge($pizzas, $dealcart);
        }

        // Two Small

        if(in_array("Two Small", $unsuitabledeals))
        {
            $pizzas = [];
            foreach($dealcart as $key => $item)
            {
                if($item["size"] == "small" && $item["name"] != "Create Your Own")
                {
                    $pizzas[] = $item;
                    unset($dealcart[$key]);
                }
            
            }
            array_multisort(array_column($pizzas, 'price'), SORT_DESC, $pizzas);
            if($deliverytype == "Collection")
            if(count($pizzas) >=2)
            {
                $newtotal = $newtotal + 12.00;
                unset($pizzas[0]);
                unset($pizzas[1]);

                if(($key = array_search("Two Small", $unsuitabledeals)) !== false)
                {
                    $applieddeals[] = $unsuitabledeals[$key];
                    unset($unsuitabledeals[$key]);
                }
                
            }

            $dealcart = array_merge($pizzas, $dealcart);
        }

        foreach($dealcart as $item)
        {
            $newtotal = $newtotal + $item["price"];
        }

        $savings = $originaltotal - $newtotal;

        $request->session()->put('total', $newtotal);

        return view('cart', ['deliverytype' => $deliverytype, 'cart' => $cart, 'total' => $newtotal, 'savings' => $savings, 'unsuitabledeals' => $unsuitabledeals, 'applieddeals' => $applieddeals]);
    }

    public function clearCart(Request $request)
    {
        $request->session()->forget('order');
        return redirect(route('home'));
    }

    public function saveCart(Request $request)
    {       
        $savedorder = SavedOrders::firstOrNew(['user_id' => auth()->user()->id]);
        $savedorder->savedOrder = serialize($request->session()->get('order'));
        $savedorder->save();

        return redirect(route('home'));
    }

    public function loadCart(Request $request)
    {

        $savedorder = SavedOrders::where('user_id', auth()->user()->id)->first();

        if($savedorder)
        {
            $order = unserialize($savedorder->savedOrder);
        } else {
            $order = unserialize("N;");
        }

        $request->session()->put('order', $order);

        return redirect(route('home'));
    }

    public function checkout(Request $request)
    {
        $this->validate($request, [
            'deliverytype' => ['required']
        ]);

        $request->session()->put('deliverytype', $request->deliverytype);

        return redirect(route('cart'));
    }

    public function order(Request $request)
    {
        $deliverytype = $request->session()->get('deliverytype');
        $total = $request->session()->get('total');

        $request->session()->forget('deliverytype');
        $request->session()->forget('total');
        $request->session()->forget('order');

        return view('order')->with('deliverytype', $deliverytype)->with('total', $total);
    }
}

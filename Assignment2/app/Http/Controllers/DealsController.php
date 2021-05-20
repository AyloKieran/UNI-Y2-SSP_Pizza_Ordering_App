<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DealsController extends Controller
{
    public function index(Request $request)
    {
        $deals = [];
        
        $dealitems = unserialize($request->session()->get('deals'));

        if($dealitems != null)
        {
            foreach($dealitems as $dealitem)
            {
                array_push($deals, $dealitem);
            }
        }

        return view('deals', ['deals' => $deals]);
    }

    public function selectDeals(Request $request)
    {
        $this->validate($request, [
            'deals' => ['array']
        ]);

        $deals = $request->deals;

        // dd($deals);

        $request->session()->put('deals', serialize($deals));

        return redirect(route('home'));
    }
}

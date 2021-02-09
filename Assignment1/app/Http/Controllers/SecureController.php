<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SecureController extends Controller
{

    public function __construct()
    {
        // Removed to stop auto redirect to register
        // $this->middleware('auth');
    }

    public function index()
    {
        // show authorization error if user is not logged in, rather than redirecting to register
        $this->authorize('viewSecure', Auth::user());

        return view('secure');
    }
}

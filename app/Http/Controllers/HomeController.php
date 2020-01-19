<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if($request->filtro)
            $users = DB::table('users')->where('name', 'LIKE', "%$request->filtro%")->paginate(10);
        else
            $users = DB::table('users')->paginate(10);
        return view('home', compact('user', 'users'));
    }
}

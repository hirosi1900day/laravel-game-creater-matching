<?php
namespace App\Http\Controllers\Admin;  
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User; 
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');  
    }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::OrderBy('created_at','desc')->get();
        return view('admin.home', compact('users')); 
    }

    public function show(User $user) {
        return view('admin.show', compact('user'));
    }    
}
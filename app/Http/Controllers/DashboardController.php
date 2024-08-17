<?php

namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\User;
// use Illuminate\Routing\Controllers\HasMiddleware;
// use Illuminate\Routing\Controllers\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// class DashboardController extends Controller implements HasMiddleware
class DashboardController extends Controller 
{
    //
    public function index()
    {

        return view("users.dashboard");
        
    }



}

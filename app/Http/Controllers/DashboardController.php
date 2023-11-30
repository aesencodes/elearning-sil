<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function index(){
        if (Auth::user()->role == 199200) {
            return redirect()->route('student.class');
        } else if(Auth::user()->role == 199300) {
            return redirect()->route('teacher.class');
        } else {
            return  abort(404);
        }
    }
}

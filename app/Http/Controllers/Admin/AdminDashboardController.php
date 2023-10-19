<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function viewDashboard(): View {
        return view('pages.admin.dashboard');
    }
}

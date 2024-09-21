<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if (fullAccess()) {
            return view('adminDashboard');
        } else {
            return view('dashboard');
        }
    }
}
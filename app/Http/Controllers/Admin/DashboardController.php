<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request): Response
    {

        return Inertia::render('Admin/Dashboard',[
            'totalUsers' => 0,
        ]);

    }
}

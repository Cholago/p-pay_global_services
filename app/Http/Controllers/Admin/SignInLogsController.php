<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\LoginLog;
use App\Models\User;

/**
 * Controller for managing sign-in logs in the admin panel.
 */
class SignInLogsController extends Controller
{
    /**
     * Display a paginated list of sign-in logs.
     *
     * @param Request $request The incoming HTTP request
     * @return Response Returns an Inertia response
     */
    public function index(Request $request): Response
    {
        // Set default order_by to 'desc' if not provided
        $orderBy = $request->input('order_by', 'desc');
        // Fetch sign-in logs with associated user data, paginated and ordered by id descending
        $signinlogs = LoginLog::with('user:id,first_name,last_name,email')
            ->filter($request->only('search', 'user') + ['order_by' => $orderBy])
            ->paginate(20)
            ->withQueryString();
        
        $users = User::select('id', 'email')->get();

        // Render the Index view with sign-in logs and search filters
        return Inertia::render('Admin/SigninLogs/Index', [
            'filters' => $request->only('search', 'user') + ['order_by' => $orderBy],
            'signinlogs' => $signinlogs,
            'users' => $users
        ]);
    }
}

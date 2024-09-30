<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreatedMial;

class UsersController extends Controller
{
    /**
     * Display a paginated list of admin users.
     */
    public function index(Request $request): Response
    {
        // Fetch admin users (user_type 1), order by first name, apply search filter, and paginate
        $users = User::where('user_type', 1)
            ->orderBy('first_name')
            ->filter($request->only('search'))
            ->paginate(20);

        // Render the users index page with search filters and user data
        return Inertia::render('Admin/Users/Index', [
            'filters' => $request->only('search'),
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(): Response
    {
        // Render the user creation form
        return Inertia::render('Admin/Users/Create', []);
    }

    /**
     * Display the specified user.
     */
    public function show(User $user): Response
    {
        // Render the user view page with user data
        return Inertia::render('Admin/Users/View', [
            'user' => $user
        ]);
    }

    /**
     * Store a newly created user in the database.
     */
    public function store(Request $request): RedirectResponse
    {
        // Format the phone number
        $request->merge([
            'phone' => formatPhoneNumber($request->phone)
        ]);

        // Validate user input
        $request->validate([
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'email' => 'required|string|lowercase|email|max:100|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => 'required|string|min:9|max:15|unique:'.User::class,
        ]);

        // Create new user
        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 1, // admin user
            'active' => 1,
            'phone' => $request->phone, 
        ]);

        // Prepare email details
        $details = [
            'user' => $user,
            'password' => $request->password,
        ];

        // Send email notification to the new user
        Mail::to($user->email)->send(new UserCreatedMial($details));

        // Redirect to users list with success message
        return Redirect::route('users')->with('success', 'User created successfully');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        // Prevent editing of main system admin
        if ($user->is_admin) {
            return redirect()->route('users.view', $user)->with(['error' => 'Main system admin cannot be edited.']);
        }

        // Render the user edit form
        return Inertia::render('Admin/Users/Edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified user in the database.
     */
    public function update(User $user, Request $request): RedirectResponse
    {
        // Prevent updating of main system admin
        if ($user->is_admin) {
            return redirect()->route('users.view', $user)->with(['error' => 'Main system admin cannot be edited.']);
        }
        
        // Validate user input
        $request->validate([
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'phone' => 'required|string|min:9|max:15',
            'active' => 'required|integer',
        ]);

        // Format phone number if provided
        if ($request->phone) {
            $user->phone = formatPhoneNumber($request->phone);
        }

        // Update user data
        $user->fill($request->only('first_name', 'middle_name', 'last_name', 'phone', 'active'));
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'User profile updated successfully.');
    }
}

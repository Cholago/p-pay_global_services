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
use App\Models\Bank;
use App\Models\Dealer;
use App\Models\Country;


class DealersController extends Controller
{
    /**
     * Display a listing of dealers.
     * 
     * @param Request $request The incoming request
     * @return Response Inertia response with dealers data
     */
    public function index(Request $request): Response
    {
        // Fetch dealers with related data and apply search filter if provided
        $dealers = Dealer::with('bank:id,bank_name')
            ->with('country:id,name')
            ->with('user:id,first_name,last_name,email,phone,active')
            ->filter($request->only('search'))
            ->paginate(20);

        // Render the index view with dealers data
        return Inertia::render('Admin/Dealers/Index', [
            'filters' => $request->only('search'),
            'dealers' => $dealers
        ]);
    }

    /**
     * Show the form for creating a new dealer.
     * 
     * @return Response Inertia response with countries and banks data
     */
    public function create(): Response
    {
        // Fetch active countries and banks for the create form
        $countries = Country::select('id', 'name')->get();
        $banks = Bank::select('id', 'bank_name')->where('active', 1)->get();

        // Render the create view with countries and banks data
        return Inertia::render('Admin/Dealers/Create', [
            'countries' => $countries,
            'banks' => $banks,
        ]);
    }

    /**
     * Store a newly created dealer in storage.
     * 
     * @param Request $request The incoming request with dealer data
     * @return RedirectResponse Redirect to dealers index with success message
     */
    public function store(Request $request): RedirectResponse
    {
        // Format the phone number before validation
        $request->merge([
            'phone' => formatPhoneNumber($request->phone)
        ]);

        // Validate the incoming request data
        $request->validate([
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'email' => 'required|string|lowercase|email|max:100|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'min:9', 'max:15', 'unique:users,phone'],
            'country_id' => ['required', 'integer'],
            'bank_id' => ['required', 'integer'],
        ]);

        // Create a new user for the dealer
        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'user_type' => 2, //dealer user
            'active' => 1,
        ]);

        // Create a new dealer associated with the user
        $dealer = Dealer::create([
            'user_id' => $user->id,
            'bank_id' => $request->bank_id,
            'country_id' => $request->country_id,
            'state' => $request->state,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
        ]);

        // Redirect to dealers index with success message
        return Redirect::route('dealers.index')->with('success', 'Dealer created successfully');
    }

    /**
     * Display the specified dealer.
     * 
     * @param Dealer $dealer The dealer to be displayed
     * @return Response Inertia response with dealer data
     */
    public function show(Dealer $dealer): Response
    {
        // Load related data for the dealer
        $dealer->load('bank:id,bank_name');
        $dealer->load('country:id,name');
        $dealer->load('user:id,first_name,last_name,email,phone,active');

        // Render the view view with dealer data
        return Inertia::render('Admin/Dealers/View', [
            'dealer' => $dealer
        ]);
    }

    /**
     * Show the form for editing the specified dealer.
     * 
     * @param Dealer $dealer The dealer to be edited
     * @return Response Inertia response with dealer, countries, and banks data
     */
    public function edit(Dealer $dealer): Response
    {
        // Load related data for the dealer
        $dealer->load('bank:id,bank_name');
        $dealer->load('country:id,name');
        $dealer->load('user:id,first_name,middle_name,last_name,email,phone,active');

        // Fetch countries and active banks for the edit form
        $countries = Country::select('id', 'name')->get();
        $banks = Bank::select('id', 'bank_name')->where('active', 1)->get();

        // Render the edit view with dealer, countries, and banks data
        return Inertia::render('Admin/Dealers/Edit', [
            'dealer' => $dealer,
            'countries' => $countries,
            'banks' => $banks,
        ]);
    }

    /**
     * Update the specified dealer in storage.
     * 
     * @param Request $request The incoming request with updated dealer data
     * @param Dealer $dealer The dealer to be updated
     * @return RedirectResponse Redirect to dealers index with success message
     */
    public function update(Request $request, Dealer $dealer): RedirectResponse
    {
        // Format the phone number before validation
        $request->merge([
            'phone' => formatPhoneNumber($request->phone)
        ]);

        // Validate the incoming request data
        $request->validate([
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'email' => 'required|string|lowercase|email|max:100|unique:'.User::class.',email,'.$dealer->user->id,
            'phone' => ['required', 'string', 'min:9', 'max:15', 'unique:users,phone,'.$dealer->user->id],
            'country_id' => ['required', 'integer'],
            'bank_id' => ['required', 'integer'],
        ]);

        // Update the associated user data
        $dealer->user->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'active' => $request->active,
        ]);

        // Update the dealer data
        $dealer->update([   
            'bank_id' => $request->bank_id,
            'country_id' => $request->country_id,
            'state' => $request->state,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
        ]);

        // Redirect to dealers index with success message
        return Redirect::route('dealers.index')->with('success', 'Dealer updated successfully');
    }

    /**
     * Remove the specified dealer from storage.
     * 
     * @param Dealer $dealer The dealer to be removed
     * @return RedirectResponse Redirect response
     */
    public function destroy(Dealer $dealer): RedirectResponse
    {
        // TODO: Implement dealer deletion logic
    }
}
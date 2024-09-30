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
use App\Models\Bank;
use App\Models\Country;

class BanksController extends Controller
{
    // Display a paginated list of banks
    public function index(Request $request): Response
    {
        // Fetch banks, apply filters, and paginate
        $banks = Bank::orderBy('bank_name')
            ->filter($request->only('search'))
            ->paginate(20);

        // Render the index view with banks and filters
        return Inertia::render('Admin/Banks/Index', [
            'filters' => $request->only('search'),
            'banks' => $banks
        ]);
    }

    // Show the form for creating a new bank
    public function create(): Response
    {
        // Fetch all countries for the dropdown
        $countries = Country::select('id', 'name')->get();
        
        // Render the create view with countries data
        return Inertia::render('Admin/Banks/Create',[
            'countries' => $countries,
        ]);
    }

    // Display details of a specific bank
    public function show(Bank $bank): Response
    {
        // Load the associated country data
        $bank->load('country:id,name');
        
        // Render the view view with bank data
        return Inertia::render('Admin/Banks/View', [
            'bank' => $bank
        ]);
    }

    // Store a newly created bank
    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $request->validate([
            'bank_name' => ['required', 'max:200'],
            'bank_code' => ['required', 'max:50'], 
            'country_id' => ['required', 'integer'],
            'email' => 'required|string|lowercase|email|max:100',
            'phone_number' => 'required|string|min:9|max:15',
        ]);

        // Create a new bank with the validated data
        $bank = Bank::create([
            'bank_name' => $request->bank_name,
            'bank_code' => $request->bank_code,
            'country_id' => $request->country_id,
            'state' => $request->state,
            'city' => $request->city,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'phone_number' => formatPhoneNumber($request->phone_number), 
            'email' => $request->email,
            'swift_code' => $request->swift_code,
        ]);

        // Redirect to the banks index with a success message
        return Redirect::route('banks')->with('success', 'Bank created successfully');
    }

    // Show the form for editing a bank
    public function edit(Bank $bank): Response
    {
        // Fetch all countries for the dropdown
        $countries = Country::select('id', 'name')->get();
        
        // Render the edit view with bank and countries data
        return Inertia::render('Admin/Banks/Edit', [
            'bank' => $bank,
            'countries' => $countries
        ]);
    }

    // Update the specified bank
    public function update(Bank $bank, Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $request->validate([
            'bank_name' => ['required', 'max:200'],
            'bank_code' => ['required', 'max:50'], 
            'country_id' => ['required', 'integer'],
            'email' => 'required|string|lowercase|email|max:100',
            'phone_number' => 'required|string|min:9|max:15',
            'active' => 'required|integer',
        ]);

        // Format the phone number if provided
        if($request->phone_number){
            $bank->phone_number = formatPhoneNumber($request->phone);
        }

        // Update the bank with the validated data
        $bank->fill($request->only(
            'bank_name', 
            'bank_code', 
            'country_id',
            'state',
            'city', 
            'address', 
            'postal_code',
            'phone_number',
            'email',
            'swift_code',
            'active'
        ));
        $bank->save();

        // Redirect to the banks index with a success message
        return Redirect::route('banks')->with('success', 'Bank updated successfully');
    }
}
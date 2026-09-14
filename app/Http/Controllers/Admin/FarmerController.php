<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Farmer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class FarmerController extends Controller
{
    public function index()
    {
        $farmers = Farmer::with('user')->latest()->get();

        return view('admin.farmers.index', compact('farmers'));
    }

    public function create()
    {
        return view('admin.farmers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'farmer_id' => 'required|string|max:50|unique:farmers,farmer_id',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:6',
            'address' => 'nullable|string',
            'cow_rate' => 'required|numeric|min:0',
            'buffalo_rate' => 'required|numeric|min:0',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['farmer_id'] . '@gourik.local',
            'password' => Hash::make($validated['password']),
            'role' => 'farmer',
        ]);

        Farmer::create([
            'user_id' => $user->id,
            'farmer_id' => $validated['farmer_id'],
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'cow_rate' => $validated['cow_rate'],
            'buffalo_rate' => $validated['buffalo_rate'],
            'status' => true,
        ]);

        return redirect()
            ->route('admin.farmers.index')
            ->with('success', 'Farmer created successfully.');
    }

    public function edit(Farmer $farmer)
    {
        $farmer->load('user');

        return view('admin.farmers.edit', compact('farmer'));
    }

    public function update(Request $request, Farmer $farmer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'cow_rate' => 'nullable|numeric|min:0',
            'buffalo_rate' => 'nullable|numeric|min:0',
            'status' => 'required|boolean',
        ]);

        if (
            !$request->filled('cow_rate') &&
            !$request->filled('buffalo_rate')
        ) {
            return back()
                ->withErrors([
                    'cow_rate' => 'Please enter at least one milk rate.'
                ])
                ->withInput();
        }

        $farmer->user->update([
            'name' => $validated['name'],
        ]);

        $farmer->update([
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'cow_rate' => $validated['cow_rate'] ?? null,
            'buffalo_rate' => $validated['buffalo_rate'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.farmers.index')
            ->with('success', 'Farmer updated successfully.');
    }
}

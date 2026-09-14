<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Farmer;
use App\Models\MilkEntry;
use Illuminate\Http\Request;

class MilkEntryController extends Controller
{
    public function index(Request $request)
    {
        $query = MilkEntry::with('farmer.user')
            ->orderByDesc('entry_date');

        if ($request->filled('farmer_id')) {
            $query->where('farmer_id', $request->farmer_id);
        }

        if ($request->filled('entry_date')) {
            $query->whereDate('entry_date', $request->entry_date);
        }

        $entries = $query->get();

        $farmers = Farmer::with('user')
            ->where('status', true)
            ->orderBy('farmer_id')
            ->get();

        return view('admin.milk.index', compact('entries', 'farmers'));
    }


    public function create($session = 'morning')
    {
        if (!in_array($session, ['morning', 'evening','both'])) {
            abort(404);
        }

        $farmers = Farmer::with('user')
            ->where('status', true)
            ->orderBy('farmer_id')
            ->get();

        return view('admin.milk.create', compact('farmers', 'session'));
    }



    public function store(Request $request)
{
    $validated = $request->validate([
        'farmer_id' => 'required|exists:farmers,id',
        'entry_date' => 'required|date',
        'session' => 'required|in:morning,evening,both',

        // Single session
        'cow_milk' => 'nullable|numeric|min:0',
        'buffalo_milk' => 'nullable|numeric|min:0',

        // Both sessions
        'morning_cow_milk' => 'nullable|numeric|min:0',
        'morning_buffalo_milk' => 'nullable|numeric|min:0',
        'evening_cow_milk' => 'nullable|numeric|min:0',
        'evening_buffalo_milk' => 'nullable|numeric|min:0',
    ]);

    $farmer = Farmer::findOrFail($validated['farmer_id']);

    $entry = MilkEntry::firstOrNew([
        'farmer_id' => $farmer->id,
        'entry_date' => $validated['entry_date'],
    ]);

    /*
    |--------------------------------------------------------------------------
    | Morning
    |--------------------------------------------------------------------------
    */

    if ($validated['session'] === 'morning') {

        $entry->cow_morning = $validated['cow_milk'] ?? 0;
        $entry->buffalo_morning = $validated['buffalo_milk'] ?? 0;

        $entry->cow_morning_rate = $farmer->cow_rate;
        $entry->buffalo_morning_rate = $farmer->buffalo_rate;
    }

    /*
    |--------------------------------------------------------------------------
    | Evening
    |--------------------------------------------------------------------------
    */

    elseif ($validated['session'] === 'evening') {

        $entry->cow_evening = $validated['cow_milk'] ?? 0;
        $entry->buffalo_evening = $validated['buffalo_milk'] ?? 0;

        $entry->cow_evening_rate = $farmer->cow_rate;
        $entry->buffalo_evening_rate = $farmer->buffalo_rate;
    }

    /*
    |--------------------------------------------------------------------------
    | Both Morning + Evening
    |--------------------------------------------------------------------------
    */

    elseif ($validated['session'] === 'both') {

        $entry->cow_morning = $validated['morning_cow_milk'] ?? 0;
        $entry->buffalo_morning = $validated['morning_buffalo_milk'] ?? 0;

        $entry->cow_evening = $validated['evening_cow_milk'] ?? 0;
        $entry->buffalo_evening = $validated['evening_buffalo_milk'] ?? 0;

        $entry->cow_morning_rate = $farmer->cow_rate;
        $entry->buffalo_morning_rate = $farmer->buffalo_rate;

        $entry->cow_evening_rate = $farmer->cow_rate;
        $entry->buffalo_evening_rate = $farmer->buffalo_rate;
    }

    $entry->save();

    /*
    |--------------------------------------------------------------------------
    | Success Message
    |--------------------------------------------------------------------------
    */

    $sessionLabel = match ($validated['session']) {
        'morning' => 'Morning',
        'evening' => 'Evening',
        'both' => 'Morning & Evening',
    };

    return redirect()
        ->route('admin.milk.create', [
            'session' => $validated['session']
        ])
        ->with(
            'success',
            $sessionLabel . ' milk entry saved successfully.'
        )
        ->with(
            'updated_farmer',
            $farmer->user->name
        )
        ->with(
            'updated_farmer_id',
            $farmer->farmer_id
        )
        ->with(
            'updated_date',
            $entry->entry_date->format('d M Y')
        )
        ->with(
            'updated_session',
            $sessionLabel
        );
}

    public function edit(MilkEntry $milkEntry)
    {
        $farmers = Farmer::with('user')
            ->where('status', true)
            ->orderBy('farmer_id')
            ->get();

        return view('admin.milk.edit', compact('milkEntry', 'farmers'));
    }


    public function update(Request $request, MilkEntry $milkEntry)
    {
        $validated = $request->validate([
            'entry_date' => 'required|date',

            'cow_morning' => 'nullable|numeric|min:0',
            'cow_morning_rate' => 'nullable|numeric|min:0',

            'cow_evening' => 'nullable|numeric|min:0',
            'cow_evening_rate' => 'nullable|numeric|min:0',

            'buffalo_morning' => 'nullable|numeric|min:0',
            'buffalo_morning_rate' => 'nullable|numeric|min:0',

            'buffalo_evening' => 'nullable|numeric|min:0',
            'buffalo_evening_rate' => 'nullable|numeric|min:0',
        ]);


        $milkEntry->update([
            'entry_date' => $validated['entry_date'],

            'cow_morning' => $validated['cow_morning'] ?? 0,
            'cow_morning_rate' => $validated['cow_morning_rate'] ?? null,

            'cow_evening' => $validated['cow_evening'] ?? 0,
            'cow_evening_rate' => $validated['cow_evening_rate'] ?? null,

            'buffalo_morning' => $validated['buffalo_morning'] ?? 0,
            'buffalo_morning_rate' => $validated['buffalo_morning_rate'] ?? null,

            'buffalo_evening' => $validated['buffalo_evening'] ?? 0,
            'buffalo_evening_rate' => $validated['buffalo_evening_rate'] ?? null,
        ]);


        return redirect()
            ->route('admin.milk.index')
            ->with('success', 'Milk entry updated successfully.')
            ->with('updated_farmer', $milkEntry->farmer->user->name)
            ->with('updated_farmer_id', $milkEntry->farmer->farmer_id)
            ->with('updated_date', $milkEntry->entry_date->format('d M Y'));
    }
}

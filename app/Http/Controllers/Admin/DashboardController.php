<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Farmer;
use App\Models\MilkEntry;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        /*
        |--------------------------------------------------------------------------
        | Farmers
        |--------------------------------------------------------------------------
        */

        $totalFarmers = Farmer::count();

        $activeFarmers = Farmer::where('status', true)->count();


        /*
        |--------------------------------------------------------------------------
        | Today's Milk
        |--------------------------------------------------------------------------
        */

        $todayEntries = MilkEntry::whereDate('entry_date', $today)
            ->get();

        $todayCowMilk = $todayEntries->sum(function ($entry) {
            return (float) $entry->cow_morning
                + (float) $entry->cow_evening;
        });

        $todayBuffaloMilk = $todayEntries->sum(function ($entry) {
            return (float) $entry->buffalo_morning
                + (float) $entry->buffalo_evening;
        });

        $todayMilk = $todayCowMilk + $todayBuffaloMilk;


        /*
        |--------------------------------------------------------------------------
        | Current Month Milk
        |--------------------------------------------------------------------------
        */

        $monthlyEntries = MilkEntry::whereBetween(
            'entry_date',
            [$startOfMonth, $endOfMonth]
        )->get();

        $monthlyCowMilk = $monthlyEntries->sum(function ($entry) {
            return (float) $entry->cow_morning
                + (float) $entry->cow_evening;
        });

        $monthlyBuffaloMilk = $monthlyEntries->sum(function ($entry) {
            return (float) $entry->buffalo_morning
                + (float) $entry->buffalo_evening;
        });

        $monthlyMilk = $monthlyCowMilk + $monthlyBuffaloMilk;


        /*
        |--------------------------------------------------------------------------
        | Milk Percentage
        |--------------------------------------------------------------------------
        */

        $cowPercentage = $monthlyMilk > 0
            ? ($monthlyCowMilk / $monthlyMilk) * 100
            : 0;

        $buffaloPercentage = $monthlyMilk > 0
            ? ($monthlyBuffaloMilk / $monthlyMilk) * 100
            : 0;


        /*
        |--------------------------------------------------------------------------
        | Monthly Payout
        |--------------------------------------------------------------------------
        |
        | Uses the rates saved with each milk entry.
        | This keeps historical calculations accurate.
        |
        */

        $monthlyPayout = 0;

        foreach ($monthlyEntries as $entry) {

            $monthlyPayout +=
                ((float) $entry->cow_morning
                    * (float) ($entry->cow_morning_rate ?? 0));

            $monthlyPayout +=
                ((float) $entry->cow_evening
                    * (float) ($entry->cow_evening_rate ?? 0));

            $monthlyPayout +=
                ((float) $entry->buffalo_morning
                    * (float) ($entry->buffalo_morning_rate ?? 0));

            $monthlyPayout +=
                ((float) $entry->buffalo_evening
                    * (float) ($entry->buffalo_evening_rate ?? 0));
        }


        /*
        |--------------------------------------------------------------------------
        | Recent Entries
        |--------------------------------------------------------------------------
        */

        $recentEntries = MilkEntry::with('farmer.user')
            ->orderByDesc('entry_date')
            ->orderByDesc('id')
            ->take(10)
            ->get();


        return view('admin.dashboard', compact(
            'totalFarmers',
            'activeFarmers',

            'todayMilk',
            'todayCowMilk',
            'todayBuffaloMilk',

            'monthlyMilk',
            'monthlyCowMilk',
            'monthlyBuffaloMilk',

            'monthlyPayout',

            'cowPercentage',
            'buffaloPercentage',

            'recentEntries'
        ));
    }
}
<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $farmer = $user->farmer;

        if (!$farmer) {
            abort(404, 'Farmer profile not found.');
        }


        /*
        |--------------------------------------------------------------------------
        | Selected Month
        |--------------------------------------------------------------------------
        */

        $selectedMonth = request('month');

        if ($selectedMonth) {

            try {

                $month = Carbon::createFromFormat(
                    'Y-m',
                    $selectedMonth
                );

            } catch (\Exception $e) {

                $month = Carbon::now();

            }

        } else {

            $month = Carbon::now();

        }


        /*
        |--------------------------------------------------------------------------
        | Month Start & End
        |--------------------------------------------------------------------------
        */

        $startOfMonth = $month->copy()->startOfMonth();

        $endOfMonth = $month->copy()->endOfMonth();


        /*
        |--------------------------------------------------------------------------
        | Get Selected Month Entries
        |--------------------------------------------------------------------------
        */

        $entries = $farmer->milkEntries()
            ->whereBetween('entry_date', [
                $startOfMonth,
                $endOfMonth
            ])
            ->orderByDesc('entry_date')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Cow Milk
        |--------------------------------------------------------------------------
        */

        $cowMilk = $entries->sum(function ($entry) {

            return (float) $entry->cow_morning
                + (float) $entry->cow_evening;

        });


        /*
        |--------------------------------------------------------------------------
        | Buffalo Milk
        |--------------------------------------------------------------------------
        */

        $buffaloMilk = $entries->sum(function ($entry) {

            return (float) $entry->buffalo_morning
                + (float) $entry->buffalo_evening;

        });


        /*
        |--------------------------------------------------------------------------
        | Total Milk
        |--------------------------------------------------------------------------
        */

        $totalMilk = $cowMilk + $buffaloMilk;


        /*
        |--------------------------------------------------------------------------
        | Amount Calculation
        |--------------------------------------------------------------------------
        |
        | We use the rates saved with each milk entry.
        | This keeps old bills correct when the farmer's
        | default rate changes later.
        |
        */

        $cowAmount = 0;

        $buffaloAmount = 0;


        foreach ($entries as $entry) {

            // Cow Morning

            $cowAmount +=
                (float) $entry->cow_morning
                * (float) ($entry->cow_morning_rate ?? 0);


            // Cow Evening

            $cowAmount +=
                (float) $entry->cow_evening
                * (float) ($entry->cow_evening_rate ?? 0);


            // Buffalo Morning

            $buffaloAmount +=
                (float) $entry->buffalo_morning
                * (float) ($entry->buffalo_morning_rate ?? 0);


            // Buffalo Evening

            $buffaloAmount +=
                (float) $entry->buffalo_evening
                * (float) ($entry->buffalo_evening_rate ?? 0);
        }


        /*
        |--------------------------------------------------------------------------
        | Total Amount
        |--------------------------------------------------------------------------
        */

        $totalAmount = $cowAmount + $buffaloAmount;


        /*
        |--------------------------------------------------------------------------
        | Milk Percentage
        |--------------------------------------------------------------------------
        */

        $cowPercentage = $totalMilk > 0
            ? ($cowMilk / $totalMilk) * 100
            : 0;

        $buffaloPercentage = $totalMilk > 0
            ? ($buffaloMilk / $totalMilk) * 100
            : 0;


        /*
        |--------------------------------------------------------------------------
        | Month Selector
        |--------------------------------------------------------------------------
        */

        $months = [];

        $currentMonth = Carbon::now()->startOfMonth();


        for ($i = 0; $i < 12; $i++) {

            $monthOption = $currentMonth
                ->copy()
                ->subMonths($i);

            $months[] = [
                'value' => $monthOption->format('Y-m'),
                'label' => $monthOption->format('F Y'),
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | Send Data To Dashboard
        |--------------------------------------------------------------------------
        */

        return view('farmer.dashboard', compact(

            'farmer',

            'entries',

            'cowMilk',
            'buffaloMilk',
            'totalMilk',

            'cowAmount',
            'buffaloAmount',
            'totalAmount',

            'cowPercentage',
            'buffaloPercentage',

            'month',
            'selectedMonth',
            'months'
        ));
    }
}
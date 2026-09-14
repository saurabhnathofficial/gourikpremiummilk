<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Farmer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FarmerBillController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Farmers
        |--------------------------------------------------------------------------
        */

        $farmers = Farmer::with('user')
            ->where('status', true)
            ->orderBy('farmer_id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Selected Farmer
        |--------------------------------------------------------------------------
        */

        $farmer = null;
        $entries = collect();

        $cowMilk = 0;
        $buffaloMilk = 0;
        $totalMilk = 0;

        $cowAmount = 0;
        $buffaloAmount = 0;
        $totalAmount = 0;


        /*
        |--------------------------------------------------------------------------
        | Selected Month
        |--------------------------------------------------------------------------
        */

        $selectedMonth = $request->input(
            'month',
            Carbon::now()->format('Y-m')
        );

        try {

            $month = Carbon::createFromFormat(
                'Y-m',
                $selectedMonth
            );

        } catch (\Exception $e) {

            $month = Carbon::now();
            $selectedMonth = $month->format('Y-m');
        }


        /*
        |--------------------------------------------------------------------------
        | Load Farmer Bill
        |--------------------------------------------------------------------------
        */

        if ($request->filled('farmer_id')) {

            $farmer = Farmer::with('user')
                ->where('id', $request->farmer_id)
                ->where('status', true)
                ->first();

            if ($farmer) {

                $startOfMonth = $month->copy()->startOfMonth();
                $endOfMonth = $month->copy()->endOfMonth();

                $entries = $farmer->milkEntries()
                    ->whereBetween('entry_date', [
                        $startOfMonth,
                        $endOfMonth
                    ])
                    ->orderBy('entry_date')
                    ->get();


                /*
                |--------------------------------------------------------------------------
                | Milk Totals
                |--------------------------------------------------------------------------
                */

                $cowMilk = $entries->sum(function ($entry) {

                    return (float) $entry->cow_morning
                        + (float) $entry->cow_evening;

                });


                $buffaloMilk = $entries->sum(function ($entry) {

                    return (float) $entry->buffalo_morning
                        + (float) $entry->buffalo_evening;

                });


                $totalMilk =
                    $cowMilk +
                    $buffaloMilk;


                /*
                |--------------------------------------------------------------------------
                | Amount Calculation
                |--------------------------------------------------------------------------
                |
                | IMPORTANT:
                | We use the rate saved with each milk entry.
                | This keeps historical bills correct even if
                | the farmer's current rate changes later.
                |
                */

                foreach ($entries as $entry) {

                    $cowAmount +=
                        (float) $entry->cow_morning
                        * (float) ($entry->cow_morning_rate ?? 0);

                    $cowAmount +=
                        (float) $entry->cow_evening
                        * (float) ($entry->cow_evening_rate ?? 0);


                    $buffaloAmount +=
                        (float) $entry->buffalo_morning
                        * (float) ($entry->buffalo_morning_rate ?? 0);

                    $buffaloAmount +=
                        (float) $entry->buffalo_evening
                        * (float) ($entry->buffalo_evening_rate ?? 0);
                }


                $totalAmount =
                    $cowAmount +
                    $buffaloAmount;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Month Options
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


        return view('admin.farmer-bills.index', compact(
            'farmers',
            'farmer',
            'entries',

            'cowMilk',
            'buffaloMilk',
            'totalMilk',

            'cowAmount',
            'buffaloAmount',
            'totalAmount',

            'month',
            'selectedMonth',
            'months'
        ));
    }
}
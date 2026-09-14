@extends('layouts.portal')

@section('title', 'Farmer Dashboard | Gourik')

@section('content')

<style>
    .farmer-dashboard {
        background: #f7faf8;
        min-height: calc(100vh - 70px);
    }

    .welcome-card {
        background: linear-gradient(135deg, #06264A 0%, #0b416f 100%);
        color: #fff;
        border-radius: 20px;
        padding: 30px;
        position: relative;
        overflow: hidden;
    }

    .welcome-card::after {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.06);
        right: -60px;
        top: -80px;
    }

    .welcome-card::before {
        content: "";
        position: absolute;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.04);
        right: 100px;
        bottom: -80px;
    }

    .farmer-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.15);
        padding: 7px 14px;
        border-radius: 50px;
        font-size: 13px;
    }

    .summary-card {
        border: 0;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 5px 20px rgba(6, 38, 74, 0.07);
        transition: all 0.25s ease;
        height: 100%;
    }

    .summary-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 28px rgba(6, 38, 74, 0.12);
    }

    .summary-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
    }


    .animal-icon {
        font-size: 27px;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cow-icon {
        background: #eaf4ff;
        color: #0d6efd;
    }

    .buffalo-icon {
        background: #eeeaff;
        color: #6f42c1;
    }

    .milk-icon {
        background: #e8f7f0;
        color: #198754;
    }

    .money-icon {
        background: #fff4dc;
        color: #d69b00;
    }

    .summary-label {
        color: #667085;
        font-size: 14px;
        font-weight: 500;
    }

    .summary-value {
        color: #06264A;
        font-size: 28px;
        font-weight: 700;
        margin: 5px 0;
    }

    .rate-text {
        color: #667085;
        font-size: 13px;
    }

    .earning-card {
        background: linear-gradient(135deg, #198754 0%, #126b42 100%);
        color: #fff;
        border-radius: 20px;
        border: 0;
        box-shadow: 0 8px 25px rgba(25, 135, 84, 0.18);
    }

    .earning-label {
        font-size: 14px;
        opacity: 0.85;
    }

    .earning-value {
        font-size: 38px;
        font-weight: 700;
        margin: 4px 0;
    }

    .earning-detail {
        font-size: 13px;
        opacity: 0.8;
    }

    .section-card {
        background: #fff;
        border: 0;
        border-radius: 18px;
        box-shadow: 0 5px 20px rgba(6, 38, 74, 0.06);
    }

    .section-title {
        color: #06264A;
        font-weight: 700;
    }

    .breakdown-item {
        padding: 16px;
        border-radius: 14px;
        background: #f8fafb;
        margin-bottom: 12px;
    }

    .breakdown-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .progress {
        height: 8px;
        border-radius: 10px;
        background: #e9ecef;
    }

    .progress-bar {
        border-radius: 10px;
    }

    .history-table th {
        color: #667085;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .history-table td {
        font-size: 14px;
        white-space: nowrap;
    }

    .date-badge {
        background: #eef7f2;
        color: #198754;
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
    }

    .empty-state {
        padding: 50px 20px;
    }

    .empty-icon {
        width: 65px;
        height: 65px;
        background: #eef7f2;
        color: #198754;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    @media (max-width: 767.98px) {

        .welcome-card {
            padding: 24px 20px;
            border-radius: 16px;
        }

        .welcome-card h2 {
            font-size: 23px;
        }

        .summary-value {
            font-size: 24px;
        }

        .earning-value {
            font-size: 32px;
        }

        .section-card {
            border-radius: 15px;
        }
    }
</style>


<div class="farmer-dashboard">

    <div class="container py-4 py-lg-5">

        {{-- Welcome Section --}}
        <div class="welcome-card mb-4">

            <div class="position-relative" style="z-index: 2;">

                <div class="row align-items-center">

                    {{-- LEFT SIDE --}}
                    <div class="col-lg-7">

                        <div class="farmer-badge mb-3">
                            <i class="bi bi-person-circle"></i>
                            Farmer ID: {{ $farmer->farmer_id }}
                        </div>

                        <h2 class="fw-bold mb-2">
                            Welcome, {{ $farmer->user->name }} 👋
                        </h2>

                        <p class="mb-0 mt-3 opacity-75">
                            Here's your milk collection summary for
                            {{ $month->format('F Y') }}.
                        </p>

                    </div>


                    {{-- RIGHT SIDE --}}
                    <div class="col-lg-5">

                        <form method="GET"
                            action="{{ route('farmer.dashboard') }}"
                            class="d-flex flex-column align-items-lg-end mt-4 mt-lg-0">

                            <label for="month"
                                class="form-label text-white fw-semibold mb-2">

                                <i class="bi bi-calendar3 me-1"></i>
                                Select Month

                            </label>

                            <select
                                name="month"
                                id="month"
                                class="form-select"
                                style="max-width: 220px;"
                                onchange="this.form.submit()">

                                @foreach($months as $monthOption)

                                <option
                                    value="{{ $monthOption['value'] }}"
                                    {{ $monthOption['value'] === $month->format('Y-m') ? 'selected' : '' }}>

                                    {{ $monthOption['label'] }}

                                </option>

                                @endforeach

                            </select>

                        </form>

                    </div>

                </div>

            </div>
        </div>


        {{-- Summary Cards --}}
        <div class="row g-4 mb-4">

            {{-- Cow Milk --}}
            <div class="col-12 col-sm-6 col-xl-3">

                <div class="summary-card p-4">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>
                            <div class="summary-label">
                                Cow Milk
                            </div>

                            <div class="summary-value">
                                {{ number_format($cowMilk, 2) }} L
                            </div>

                            <div class="rate-text">
                                Rate:
                                ₹{{ number_format($farmer->cow_rate ?? 0, 2) }}/L
                            </div>
                        </div>

                        <div class="summary-icon cow-icon">
                            <span class="animal-icon">🐄</span>
                        </div>

                    </div>

                </div>

            </div>


            {{-- Buffalo Milk --}}
            <div class="col-12 col-sm-6 col-xl-3">

                <div class="summary-card p-4">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>
                            <div class="summary-label">
                                Buffalo Milk
                            </div>

                            <div class="summary-value">
                                {{ number_format($buffaloMilk, 2) }} L
                            </div>

                            <div class="rate-text">
                                Rate:
                                ₹{{ number_format($farmer->buffalo_rate ?? 0, 2) }}/L
                            </div>
                        </div>

                        <div class="summary-icon buffalo-icon">
                            <span class="animal-icon">🐃</span>
                        </div>

                    </div>

                </div>

            </div>


            {{-- Total Milk --}}
            <div class="col-12 col-sm-6 col-xl-3">

                <div class="summary-card p-4">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>
                            <div class="summary-label">
                                Total Milk
                            </div>

                            <div class="summary-value">
                                {{ number_format($totalMilk, 2) }} L
                            </div>

                            <div class="rate-text">
                                {{ $entries->count() }} collection day(s)
                            </div>
                        </div>

                        <div class="summary-icon milk-icon">
                            <i class="bi bi-cup-straw"></i>
                        </div>

                    </div>

                </div>

            </div>


            {{-- Estimated Amount --}}
            <div class="col-12 col-sm-6 col-xl-3">

                <div class="summary-card p-4">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>
                            <div class="summary-label">
                                Estimated Amount
                            </div>

                            <div class="summary-value">
                                ₹{{ number_format($totalAmount, 2) }}
                            </div>

                            <div class="rate-text">
                                <p class="text-muted">
                                    {{ $month->format('F Y') }}
                                </p>
                            </div>
                        </div>

                        <div class="summary-icon money-icon">
                            <i class="bi bi-currency-rupee"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Earnings + Breakdown --}}
        <div class="row g-4 mb-4">

            {{-- Earnings --}}
            <div class="col-lg-5">

                <div class="earning-card h-100 p-4 p-lg-5">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>
                            <div class="earning-label">
                                THIS MONTH'S ESTIMATED EARNING
                            </div>

                            <div class="earning-value">
                                ₹{{ number_format($totalAmount, 2) }}
                            </div>

                            <div class="earning-detail">
                                Based on your recorded milk collection
                            </div>
                        </div>

                        <i class="bi bi-wallet2 fs-2 opacity-75"></i>

                    </div>

                    <hr class="border-light opacity-25 my-4">

                    <div class="row">

                        <div class="col-6">
                            <div class="earning-label">
                                Cow
                            </div>

                            <strong>
                                ₹{{ number_format($cowAmount, 2) }}
                            </strong>
                        </div>

                        <div class="col-6">
                            <div class="earning-label">
                                Buffalo
                            </div>

                            <strong>
                                ₹{{ number_format($buffaloAmount, 2) }}
                            </strong>
                        </div>

                    </div>

                </div>

            </div>


            {{-- Milk Breakdown --}}
            <div class="col-lg-7">

                <div class="section-card h-100 p-4">

                    <div class="mb-3">
                        <h5 class="section-title mb-1">
                            <i class="bi bi-bar-chart-fill me-2"></i>
                            Milk Breakdown
                        </h5>

                        <small class="text-muted">
                            Your current month's collection
                        </small>
                    </div>


                    @php
                    $cowPercentage = $totalMilk > 0
                    ? ($cowMilk / $totalMilk) * 100
                    : 0;

                    $buffaloPercentage = $totalMilk > 0
                    ? ($buffaloMilk / $totalMilk) * 100
                    : 0;
                    @endphp


                    {{-- Cow --}}
                    <div class="breakdown-item">

                        <div class="d-flex align-items-center gap-3">

                            <div class="breakdown-icon cow-icon">
                                <span class="animal-icon">🐄</span>
                            </div>

                            <div class="flex-grow-1">

                                <div class="d-flex justify-content-between mb-1">

                                    <strong>
                                        Cow Milk
                                    </strong>

                                    <strong>
                                        {{ number_format($cowMilk, 2) }} L
                                    </strong>

                                </div>

                                <div class="progress">

                                    <div
                                        class="progress-bar bg-primary"
                                        style="width: {{ $cowPercentage }}%">
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Buffalo --}}
                    <div class="breakdown-item mb-0">

                        <div class="d-flex align-items-center gap-3">

                            <div class="breakdown-icon buffalo-icon">
                                <span class="animal-icon">🐃</span>
                            </div>

                            <div class="flex-grow-1">

                                <div class="d-flex justify-content-between mb-1">

                                    <strong>
                                        Buffalo Milk
                                    </strong>

                                    <strong>
                                        {{ number_format($buffaloMilk, 2) }} L
                                    </strong>

                                </div>

                                <div class="progress">

                                    <div
                                        class="progress-bar"
                                        style="width: {{ $buffaloPercentage }}%; background-color: #6f42c1;">
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Milk History --}}
        <div class="section-card">

            <div class="p-4">

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">

                    <div>

                        <h5 class="section-title mb-1">
                            <i class="bi bi-clock-history me-2"></i>
                            Milk History
                        </h5>

                        <p class="text-muted mb-0 small">
                            Your collection records for {{ now()->format('F Y') }}
                        </p>

                    </div>

                    <span class="badge bg-light text-dark border px-3 py-2">
                        {{ $entries->count() }} Day(s)
                    </span>

                    <button type="button"
                        class="btn btn-success"
                        onclick="printMonthlyBill()">

                        <i class="bi bi-printer me-1"></i>
                        Print Monthly Bill

                    </button>
                </div>

            </div>


            <div class="table-responsive">

                <table class="table history-table align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th class="ps-4">
                                Date
                            </th>

                            <th>
                                Cow Morning
                            </th>

                            <th>
                                Cow Evening
                            </th>

                            <th>
                                Buffalo Morning
                            </th>

                            <th>
                                Buffalo Evening
                            </th>

                            <th class="pe-4">
                                Total
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($entries as $entry)

                        @php
                        $total =
                        $entry->cow_morning +
                        $entry->cow_evening +
                        $entry->buffalo_morning +
                        $entry->buffalo_evening;
                        @endphp

                        <tr>

                            <td class="ps-4">

                                <span class="date-badge">
                                    {{ $entry->entry_date->format('d M Y') }}
                                </span>

                            </td>

                            <td>
                                {{ number_format($entry->cow_morning, 2) }} L
                            </td>

                            <td>
                                {{ number_format($entry->cow_evening, 2) }} L
                            </td>

                            <td>
                                {{ number_format($entry->buffalo_morning, 2) }} L
                            </td>

                            <td>
                                {{ number_format($entry->buffalo_evening, 2) }} L
                            </td>

                            <td class="pe-4">

                                <strong class="text-success">
                                    {{ number_format($total, 2) }} L
                                </strong>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6">

                                <div class="empty-state text-center">

                                    <div class="empty-icon mb-3">
                                        <i class="bi bi-droplet"></i>
                                    </div>

                                    <h6 class="fw-bold">
                                        No milk entries yet
                                    </h6>

                                    <p class="text-muted mb-0">
                                        Your milk collection records will appear here.
                                    </p>

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>



{{-- Printable Monthly Bill --}}

<style>
    .monthly-bill {
        display: none;
    }

    @media print {

        body * {
            visibility: hidden;
        }

        #monthlyBill,
        #monthlyBill * {
            visibility: visible;
        }

        #monthlyBill {
            display: block;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 20px;
            background: white;
            color: #172033;
        }

        @page {
            size: A4;
            margin: 12mm;
        }

        .bill-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 12px;
            border-bottom: 2px solid #198754;
        }

        .bill-brand {
            display: flex;
            flex-direction: column;
        }

        .bill-logo {
            width: 180px;
            height: auto;
            display: block;
            margin-bottom: 4px;
        }

        .bill-brand p {
            margin: 0;
            font-size: 12px;
            color: #172033;
        }

        .bill-month {
            font-size: 15px;
            font-weight: 700;
            color: #06264A;
            padding-top: 12px;
        }

        .farmer-details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .farmer-details div {
            border: 1px solid #ddd;
            padding: 10px;
        }

        .farmer-details strong {
            display: block;
            font-size: 11px;
            color: #667085;
            margin-bottom: 4px;
        }

        .farmer-details span {
            font-size: 13px;
            font-weight: 600;
        }

        .bill-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .bill-table th {
            background: #06264A !important;
            color: white !important;
            padding: 9px;
            border: 1px solid #06264A;
        }

        .bill-table td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .bill-table tfoot th {
            background: #f1f5f3 !important;
            color: #172033 !important;
            border: 1px solid #ddd;
        }

        .bill-calculation {
            margin-top: 25px;
            margin-left: auto;
            width: 55%;
        }

        .bill-calculation div {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
            font-size: 12px;
        }

        .bill-total {
            margin-top: 15px;
            padding: 15px;
            background: #198754 !important;
            color: white !important;
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: bold;
        }

        .bill-footer {
            margin-top: 30px;
            padding-top: 12px;
            border-top: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            color: #667085;
        }

    }
</style>
<div id="monthlyBill" class="monthly-bill">

    <div class="bill-header">

        <div class="bill-brand">

            <img
                src="{{ asset('images/gourik_logo.png') }}"
                alt="Gourik Premium Milk"
                class="bill-logo">


        </div>

        <div class="bill-month">
            {{ $month->format('F Y') }}
            <p>Monthly Milk Statement</p>

        </div>

    </div>


    <div class="farmer-details">

        <div>
            <strong>Farmer Name</strong>
            <span>{{ $farmer->user->name }}</span>
        </div>

        <div>
            <strong>Farmer ID</strong>
            <span>{{ $farmer->farmer_id }}</span>
        </div>

        <div>
            <strong>Statement Period</strong>
            <span>
                {{ $month->copy()->startOfMonth()->format('d M Y') }}
                -
                {{ $month->copy()->endOfMonth()->format('d M Y') }}
            </span>
        </div>

    </div>


    <table class="bill-table">

        <thead>

            <tr>
                <th>Date</th>
                <th>Cow Morning</th>
                <th>Cow Evening</th>
                <th>Buffalo Morning</th>
                <th>Buffalo Evening</th>
                <th>Total</th>
            </tr>

        </thead>

        <tbody>

            @foreach($entries as $entry)

            @php
            $dailyTotal =
            $entry->cow_morning +
            $entry->cow_evening +
            $entry->buffalo_morning +
            $entry->buffalo_evening;
            @endphp

            <tr>

                <td>
                    {{ $entry->entry_date->format('d M Y') }}
                </td>

                <td>
                    {{ number_format($entry->cow_morning, 2) }} L
                </td>

                <td>
                    {{ number_format($entry->cow_evening, 2) }} L
                </td>

                <td>
                    {{ number_format($entry->buffalo_morning, 2) }} L
                </td>

                <td>
                    {{ number_format($entry->buffalo_evening, 2) }} L
                </td>

                <td>
                    <strong>
                        {{ number_format($dailyTotal, 2) }} L
                    </strong>
                </td>

            </tr>

            @endforeach

        </tbody>

        <tfoot>

            <tr>
                <th>TOTAL</th>

                <th colspan="2">
                    {{ number_format($cowMilk, 2) }} L
                </th>

                <th colspan="2">
                    {{ number_format($buffaloMilk, 2) }} L
                </th>

                <th>
                    {{ number_format($totalMilk, 2) }} L
                </th>
            </tr>

        </tfoot>

    </table>


    <div class="bill-calculation">

        <div>
            <span>Cow Milk</span>

            <strong>
                {{ number_format($cowMilk, 2) }} L
                =
                ₹{{ number_format($cowAmount, 2) }}
            </strong>
        </div>

        <div>
            <span>Buffalo Milk</span>

            <strong>
                {{ number_format($buffaloMilk, 2) }} L
                =
                ₹{{ number_format($buffaloAmount, 2) }}
            </strong>
        </div>

        <div style="border-bottom: 0; font-size: 11px; color: #667085;">
            <span>
                Amount calculated using the rates saved with each milk entry.
            </span>
        </div>

    </div>


    <div class="bill-total">

        <span>Total Amount</span>

        <strong>
            ₹{{ number_format($totalAmount, 2) }}
        </strong>

    </div>


    <div class="bill-footer">

        Gourik Premium Milk

        <span>
            Generated on {{ now()->format('d M Y') }}
        </span>

    </div>

</div>

<script>
    function printMonthlyBill() {
        window.print();
    }
</script>
@endsection
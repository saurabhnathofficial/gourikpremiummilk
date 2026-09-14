@extends('layouts.portal')

@section('title', 'Admin Dashboard | Gourik')

@section('content')

<style>
    /* =========================================================
       GOURIK ADMIN DASHBOARD
    ========================================================= */

    .admin-dashboard {
        min-height: calc(100vh - 70px);
        background: #f6f9f7;
    }

    /* =========================================================
       DASHBOARD HEADER
    ========================================================= */

    .dashboard-header {
        position: relative;
        overflow: hidden;
        padding: 32px 34px;
        border-radius: 20px;
        color: #fff;
        background: linear-gradient(
            135deg,
            #06264A 0%,
            #0b4960 55%,
            #116b72 100%
        );
        box-shadow: 0 10px 30px rgba(6, 38, 74, 0.14);
    }

    .dashboard-header::before {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        right: 120px;
        bottom: -110px;
        border-radius: 50%;
        background: rgba(25, 135, 84, 0.14);
    }

    .dashboard-header::after {
        content: "";
        position: absolute;
        width: 240px;
        height: 240px;
        right: -80px;
        top: -100px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.06);
    }

    .dashboard-header-content {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .dashboard-label {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 9px;
        color: rgba(255, 255, 255, 0.72);
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .6px;
        text-transform: uppercase;
    }

    .dashboard-header h1 {
        margin: 0 0 7px;
        color: #fff;
        font-size: 32px;
        font-weight: 700;
    }

    .dashboard-header p {
        margin: 0;
        color: rgba(255, 255, 255, 0.72);
        font-size: 15px;
    }

    .dashboard-date {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-top: 18px;
        padding: 7px 12px;
        border: 1px solid rgba(255, 255, 255, 0.14);
        border-radius: 50px;
        background: rgba(255, 255, 255, 0.09);
        color: rgba(255, 255, 255, 0.9);
        font-size: 13px;
    }

    .dashboard-header-icon {
        position: relative;
        z-index: 2;
        width: 78px;
        height: 78px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 20px;
        color: rgba(255, 255, 255, 0.88);
        font-size: 40px;
    }

    /* =========================================================
       STAT CARDS
    ========================================================= */

    .stat-card {
        height: 100%;
        overflow: hidden;
        border: 0;
        border-radius: 18px;
        background: #fff;
        transition: all .25s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(6, 38, 74, 0.10) !important;
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        font-size: 21px;
    }

    .stat-icon-green {
        background: #e5f5ed;
        color: #198754;
    }

    .stat-icon-blue {
        background: #e8f0f8;
        color: #06264A;
    }

    .stat-icon-orange {
        background: #fff2df;
        color: #d88916;
    }

    .stat-icon-purple {
        background: #f0eafb;
        color: #7353b6;
    }

    .stat-label {
        color: #667085;
        font-size: 13px;
    }

    .stat-value {
        margin-top: 4px;
        color: #172033;
        font-size: 28px;
        font-weight: 700;
        line-height: 1.2;
    }

    .stat-value small {
        color: #667085;
        font-size: 15px;
        font-weight: 500;
    }

    .stat-meta {
        color: #667085;
        font-size: 12px;
    }

    .payout-card {
        border: 1px solid #dceee4;
        background: linear-gradient(135deg, #eaf7f0, #f7fbf9);
    }

    .payout-value {
        color: #198754;
        font-size: 27px;
        font-weight: 700;
        line-height: 1.2;
    }

    /* =========================================================
       COMMON CARDS
    ========================================================= */

    .dashboard-card {
        border: 0;
        border-radius: 18px;
        background: #fff;
    }

    .section-title {
        margin-bottom: 4px;
        color: #172033;
        font-size: 18px;
        font-weight: 700;
    }

    .section-subtitle {
        margin: 0;
        color: #667085;
        font-size: 13px;
    }

    /* =========================================================
       MILK OVERVIEW
    ========================================================= */

    .milk-type-card {
        padding: 17px;
        border: 1px solid #edf1ef;
        border-radius: 14px;
        background: #f8faf9;
    }

    .milk-type-icon {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 12px;
        background: #e5f5ed;
        color: #198754;
        font-size: 19px;
    }

    .milk-type-name {
        color: #172033;
        font-size: 14px;
        font-weight: 600;
    }

    .milk-type-value {
        color: #172033;
        font-size: 14px;
        font-weight: 700;
    }

    .progress {
        height: 8px;
        overflow: hidden;
        border-radius: 20px;
        background: #e9efeb;
    }

    .progress-bar {
        border-radius: 20px;
    }

    .milk-total-box {
        margin-top: 18px;
        padding: 15px 17px;
        border-radius: 14px;
        background: #06264A;
        color: #fff;
    }

    .milk-total-label {
        color: rgba(255, 255, 255, .7);
        font-size: 12px;
    }

    .milk-total-value {
        margin-top: 3px;
        font-size: 22px;
        font-weight: 700;
    }

    /* =========================================================
       QUICK ACTIONS
    ========================================================= */

    .quick-action {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 13px 15px;
        border: 1px solid #e7ece9;
        border-radius: 13px;
        background: #fff;
        color: #172033;
        text-decoration: none;
        transition: all .2s ease;
    }

    .quick-action:hover {
        border-color: #198754;
        background: #f7fcf9;
        color: #198754;
        transform: translateX(3px);
    }

    .quick-action-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 11px;
        background: #e8f5ef;
        color: #198754;
        font-size: 18px;
    }

    .quick-action-title {
        color: #172033;
        font-size: 13px;
        font-weight: 600;
    }

    .quick-action:hover .quick-action-title {
        color: #198754;
    }

    .quick-action-text {
        margin-top: 2px;
        color: #667085;
        font-size: 11px;
    }

    /* =========================================================
       RECENT ENTRIES
    ========================================================= */

    .view-all {
        color: #198754;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .view-all:hover {
        color: #146c43;
    }

    .recent-table th {
        padding: 13px 12px;
        border-bottom: 1px solid #edf0ee;
        color: #667085;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .recent-table td {
        padding: 14px 12px;
        border-bottom: 1px solid #f0f2f1;
        color: #172033;
        font-size: 13px;
        white-space: nowrap;
    }

    .recent-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .recent-table tbody tr {
        transition: background .15s ease;
    }

    .recent-table tbody tr:hover {
        background: #fafcfb;
    }

    .farmer-avatar {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 9px;
        border-radius: 10px;
        background: #e8f5ef;
        color: #198754;
        font-size: 14px;
    }

    .farmer-name {
        color: #172033;
        font-weight: 600;
    }

    .farmer-badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 8px;
        background: #eef6f1;
        color: #198754;
        font-size: 11px;
        font-weight: 600;
    }

    .total-cell {
        color: #06264A !important;
        font-weight: 700;
    }

    .empty-state {
        padding: 45px 20px !important;
        color: #667085;
        text-align: center;
    }

    .empty-state i {
        color: #aab5b0;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991.98px) {

        .dashboard-header {
            padding: 28px;
        }

        .dashboard-header h1 {
            font-size: 28px;
        }

    }

    @media (max-width: 767.98px) {

        .admin-dashboard {
            min-height: calc(100vh - 60px);
        }

        .dashboard-header {
            padding: 24px;
            border-radius: 16px;
        }

        .dashboard-header-content {
            align-items: flex-start;
        }

        .dashboard-header h1 {
            font-size: 25px;
        }

        .dashboard-header p {
            font-size: 14px;
        }

        .dashboard-header-icon {
            width: 58px;
            height: 58px;
            border-radius: 16px;
            font-size: 29px;
        }

        .dashboard-date {
            margin-top: 15px;
        }

        .stat-value {
            font-size: 23px;
        }

        .payout-value {
            font-size: 22px;
        }

        .dashboard-card .card-body {
            padding: 18px !important;
        }

    }

    @media (max-width: 575.98px) {

        .dashboard-header-content {
            display: block;
        }

        .dashboard-header-icon {
            display: none;
        }

        .dashboard-header h1 {
            font-size: 24px;
        }

        .stat-card .card-body {
            padding: 15px !important;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            font-size: 18px;
        }

        .stat-value {
            font-size: 21px;
        }

        .stat-label {
            font-size: 12px;
        }

        .quick-action {
            padding: 12px;
        }

    }
</style>


<div class="admin-dashboard">

    <div class="container py-4 py-lg-5">

        {{-- =====================================================
             DASHBOARD HEADER
        ====================================================== --}}

        <div class="dashboard-header mb-4">

            <div class="dashboard-header-content">

                <div>

                    <div class="dashboard-label">
                        <i class="bi bi-speedometer2"></i>
                        Gourik Administration
                    </div>

                    <h1>
                        Welcome back, {{ auth()->user()->name }} 👋
                    </h1>

                    <p>
                        Manage your farmers and monitor milk collection
                        from one place.
                    </p>

                    <div class="dashboard-date">
                        <i class="bi bi-calendar3"></i>
                        {{ now()->format('l, d M Y') }}
                    </div>

                </div>

                <div class="dashboard-header-icon">
                    <i class="bi bi-grid-1x2-fill"></i>
                </div>

            </div>

        </div>


        {{-- =====================================================
             STAT CARDS
        ====================================================== --}}

        <div class="row g-3 g-lg-4 mb-4">

            {{-- Total Farmers --}}

            <div class="col-6 col-xl-3">

                <div class="card stat-card shadow-sm">

                    <div class="card-body p-3 p-lg-4">

                        <div class="d-flex justify-content-between align-items-start">

                            <div class="stat-icon stat-icon-green">
                                <i class="bi bi-people-fill"></i>
                            </div>

                            <span class="stat-meta">
                                All Farmers
                            </span>

                        </div>

                        <div class="mt-3">

                            <div class="stat-label">
                                Total Farmers
                            </div>

                            <div class="stat-value">
                                {{ $totalFarmers ?? 0 }}
                            </div>

                            <div class="stat-meta mt-2">
                                {{ $activeFarmers ?? 0 }} currently active
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Active Farmers --}}

            <div class="col-6 col-xl-3">

                <div class="card stat-card shadow-sm">

                    <div class="card-body p-3 p-lg-4">

                        <div class="d-flex justify-content-between align-items-start">

                            <div class="stat-icon stat-icon-blue">
                                <i class="bi bi-person-check-fill"></i>
                            </div>

                            <span class="small text-success fw-semibold">
                                Active
                            </span>

                        </div>

                        <div class="mt-3">

                            <div class="stat-label">
                                Active Farmers
                            </div>

                            <div class="stat-value">
                                {{ $activeFarmers ?? 0 }}
                            </div>

                            <div class="stat-meta mt-2">
                                Available for milk entry
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Today's Milk --}}

            <div class="col-6 col-xl-3">

                <div class="card stat-card shadow-sm">

                    <div class="card-body p-3 p-lg-4">

                        <div class="d-flex justify-content-between align-items-start">

                            <div class="stat-icon stat-icon-orange">
                                <i class="bi bi-droplet-fill"></i>
                            </div>

                            <span class="stat-meta">
                                Today
                            </span>

                        </div>

                        <div class="mt-3">

                            <div class="stat-label">
                                Today's Milk
                            </div>

                            <div class="stat-value">
                                {{ number_format($todayMilk ?? 0, 2) }}
                                <small>L</small>
                            </div>

                            <div class="stat-meta mt-2">
                                Cow + Buffalo collection
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Monthly Payout --}}

            <div class="col-6 col-xl-3">

                <div class="card stat-card payout-card shadow-sm">

                    <div class="card-body p-3 p-lg-4">

                        <div class="d-flex justify-content-between align-items-start">

                            <div class="stat-icon stat-icon-purple">
                                <i class="bi bi-currency-rupee"></i>
                            </div>

                            <span class="small text-success fw-semibold">
                                Estimate
                            </span>

                        </div>

                        <div class="mt-3">

                            <div class="stat-label">
                                Monthly Payout
                            </div>

                            <div class="payout-value mt-1">
                                ₹{{ number_format($monthlyPayout ?? 0, 2) }}
                            </div>

                            <div class="stat-meta mt-2">
                                Current month
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             MILK OVERVIEW + QUICK ACTIONS
        ====================================================== --}}

        <div class="row g-4 mb-4">

            {{-- Milk Overview --}}

            <div class="col-lg-7">

                <div class="card dashboard-card shadow-sm h-100">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center mb-4">

                            <div>

                                <h5 class="section-title">
                                    Milk Collection
                                </h5>

                                <p class="section-subtitle">
                                    Current month overview
                                </p>

                            </div>

                            <div class="milk-type-icon">
                                <i class="bi bi-droplet-half"></i>
                            </div>

                        </div>


                        {{-- Cow Milk --}}

                        <div class="milk-type-card mb-3">

                            <div class="d-flex align-items-center">

                                <div class="milk-type-icon me-3">
                                    <i class="bi bi-droplet-fill"></i>
                                </div>

                                <div class="flex-grow-1">

                                    <div class="d-flex justify-content-between align-items-center">

                                        <span class="milk-type-name">
                                            Cow Milk
                                        </span>

                                        <span class="milk-type-value">
                                            {{ number_format($monthlyCowMilk ?? 0, 2) }} L
                                        </span>

                                    </div>

                                    <div class="progress mt-2">

                                        <div
                                            class="progress-bar bg-success"
                                            style="width: {{ min($cowPercentage ?? 0, 100) }}%;">
                                        </div>

                                    </div>

                                    <div class="d-flex justify-content-between mt-2">

                                        <small class="text-muted">
                                            {{ number_format($cowPercentage ?? 0, 1) }}%
                                        </small>

                                        <small class="text-muted">
                                            Monthly share
                                        </small>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- Buffalo Milk --}}

                        <div class="milk-type-card">

                            <div class="d-flex align-items-center">

                                <div class="milk-type-icon me-3">
                                    <i class="bi bi-droplet"></i>
                                </div>

                                <div class="flex-grow-1">

                                    <div class="d-flex justify-content-between align-items-center">

                                        <span class="milk-type-name">
                                            Buffalo Milk
                                        </span>

                                        <span class="milk-type-value">
                                            {{ number_format($monthlyBuffaloMilk ?? 0, 2) }} L
                                        </span>

                                    </div>

                                    <div class="progress mt-2">

                                        <div
                                            class="progress-bar bg-success"
                                            style="width: {{ min($buffaloPercentage ?? 0, 100) }}%;">
                                        </div>

                                    </div>

                                    <div class="d-flex justify-content-between mt-2">

                                        <small class="text-muted">
                                            {{ number_format($buffaloPercentage ?? 0, 1) }}%
                                        </small>

                                        <small class="text-muted">
                                            Monthly share
                                        </small>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- Total --}}

                        <div class="milk-total-box">

                            <div class="milk-total-label">
                                Total Monthly Collection
                            </div>

                            <div class="milk-total-value">
                                {{ number_format($monthlyMilk ?? 0, 2) }} L
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Quick Actions --}}

            <div class="col-lg-5">

                <div class="card dashboard-card shadow-sm h-100">

                    <div class="card-body p-4">

                        <h5 class="section-title">
                            Quick Actions
                        </h5>

                        <p class="section-subtitle mb-3">
                            Frequently used actions
                        </p>


                        <div class="d-grid gap-2">

                            {{-- Morning --}}

                            <a
                                href="{{ route('admin.milk.create', ['session' => 'morning']) }}"
                                class="quick-action"
                            >

                                <div class="quick-action-icon">
                                    <i class="bi bi-sunrise"></i>
                                </div>

                                <div>

                                    <div class="quick-action-title">
                                        Morning Milk Entry
                                    </div>

                                    <div class="quick-action-text">
                                        Record morning collection
                                    </div>

                                </div>

                                <i class="bi bi-chevron-right ms-auto"></i>

                            </a>


                            {{-- Evening --}}

                            <a
                                href="{{ route('admin.milk.create', ['session' => 'evening']) }}"
                                class="quick-action"
                            >

                                <div class="quick-action-icon">
                                    <i class="bi bi-sunset"></i>
                                </div>

                                <div>

                                    <div class="quick-action-title">
                                        Evening Milk Entry
                                    </div>

                                    <div class="quick-action-text">
                                        Record evening collection
                                    </div>

                                </div>

                                <i class="bi bi-chevron-right ms-auto"></i>

                            </a>


                            {{-- Both Sessions --}}

                            <a
                                href="{{ route('admin.milk.create', ['session' => 'both']) }}"
                                class="quick-action"
                            >

                                <div class="quick-action-icon">
                                    <i class="bi bi-calendar2-check"></i>
                                </div>

                                <div>

                                    <div class="quick-action-title">
                                        Both Sessions
                                    </div>

                                    <div class="quick-action-text">
                                        Record morning & evening
                                    </div>

                                </div>

                                <i class="bi bi-chevron-right ms-auto"></i>

                            </a>


                            {{-- Add Farmer --}}

                            <a
                                href="{{ route('admin.farmers.create') }}"
                                class="quick-action"
                            >

                                <div class="quick-action-icon">
                                    <i class="bi bi-person-plus"></i>
                                </div>

                                <div>

                                    <div class="quick-action-title">
                                        Add New Farmer
                                    </div>

                                    <div class="quick-action-text">
                                        Create a farmer account
                                    </div>

                                </div>

                                <i class="bi bi-chevron-right ms-auto"></i>

                            </a>


                            {{-- Milk History --}}

                            <a
                                href="{{ route('admin.milk.index') }}"
                                class="quick-action"
                            >

                                <div class="quick-action-icon">
                                    <i class="bi bi-clock-history"></i>
                                </div>

                                <div>

                                    <div class="quick-action-title">
                                        Milk History
                                    </div>

                                    <div class="quick-action-text">
                                        View collection records
                                    </div>

                                </div>

                                <i class="bi bi-chevron-right ms-auto"></i>

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             RECENT MILK ENTRIES
        ====================================================== --}}

        <div class="card dashboard-card shadow-sm">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h5 class="section-title">
                            Recent Milk Entries
                        </h5>

                        <p class="section-subtitle">
                            Latest collection records
                        </p>

                    </div>

                    <a
                        href="{{ route('admin.milk.index') }}"
                        class="view-all"
                    >
                        View All
                        <i class="bi bi-arrow-right ms-1"></i>
                    </a>

                </div>


                <div class="table-responsive">

                    <table class="table recent-table align-middle mb-0">

                        <thead>

                            <tr>

                                <th>Date</th>
                                <th>Farmer</th>
                                <th>Farmer ID</th>
                                <th>Cow</th>
                                <th>Buffalo</th>
                                <th>Total</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($recentEntries ?? [] as $entry)

                                @php

                                    $cow =
                                        (float) $entry->cow_morning +
                                        (float) $entry->cow_evening;

                                    $buffalo =
                                        (float) $entry->buffalo_morning +
                                        (float) $entry->buffalo_evening;

                                    $total = $cow + $buffalo;

                                @endphp

                                <tr>

                                    {{-- Date --}}

                                    <td>
                                        {{ $entry->entry_date->format('d M Y') }}
                                    </td>


                                    {{-- Farmer --}}

                                    <td>

                                        <span class="farmer-avatar">
                                            <i class="bi bi-person-fill"></i>
                                        </span>

                                        <span class="farmer-name">
                                            {{ $entry->farmer->user->name }}
                                        </span>

                                    </td>


                                    {{-- Farmer ID --}}

                                    <td>

                                        <span class="farmer-badge">
                                            {{ $entry->farmer->farmer_id }}
                                        </span>

                                    </td>


                                    {{-- Cow --}}

                                    <td>
                                        {{ number_format($cow, 2) }} L
                                    </td>


                                    {{-- Buffalo --}}

                                    <td>
                                        {{ number_format($buffalo, 2) }} L
                                    </td>


                                    {{-- Total --}}

                                    <td class="total-cell">
                                        {{ number_format($total, 2) }} L
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="6"
                                        class="empty-state"
                                    >

                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>

                                        No milk entries available yet.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
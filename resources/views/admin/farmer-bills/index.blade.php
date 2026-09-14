@extends('layouts.portal')

@section('title', 'Farmer Bills | Gourik Admin')

@section('content')

<style>
    .bill-page {
        background: #f7faf8;
        min-height: calc(100vh - 70px);
    }

    .bill-hero {
        background: linear-gradient(135deg, #06264A, #0b4d5c);
        color: white;
        border-radius: 18px;
        padding: 28px;
    }

    .bill-hero h1 {
        font-size: 28px;
        font-weight: 700;
    }

    .filter-card {
        background: white;
        border: 0;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
    }

    .stat-card {
        background: white;
        border: 0;
        border-radius: 16px;
        padding: 20px;
        height: 100%;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .stat-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e7f5ee;
        color: #198754;
        font-size: 20px;
        margin-bottom: 12px;
    }

    .stat-label {
        color: #667085;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .stat-value {
        color: #06264A;
        font-size: 22px;
        font-weight: 700;
    }

    .bill-preview {
        background: white;
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.07);
    }

    .bill-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding-bottom: 15px;
        border-bottom: 2px solid #198754;
    }

    .bill-brand {
        display: flex;
        align-items: flex-start;
    }

    .bill-logo {
        width: 180px;
        height: auto;
        display: block;
    }

    .bill-month {
        color: #06264A;
        font-size: 16px;
        font-weight: 700;
        text-align: right;
        padding-top: 8px;
    }

    .bill-month p {
        margin: 4px 0 0;
        font-size: 13px;
        font-weight: 500;
        color: #667085;
    }

    .farmer-details {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin: 22px 0;
        padding: 18px;
        background: #f7faf8;
        border-radius: 12px;
    }

    .farmer-details strong {
        display: block;
        color: #667085;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .farmer-details span {
        font-weight: 600;
        color: #172033;
    }

    .bill-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .bill-table th {
        background: #06264A;
        color: white;
        padding: 11px 8px;
        text-align: left;
        white-space: nowrap;
    }

    .bill-table td {
        padding: 10px 8px;
        border-bottom: 1px solid #e9ecef;
        color: #344054;
    }

    .bill-table tbody tr:hover {
        background: #f8faf9;
    }

    .bill-table tfoot th {
        background: #e7f5ee;
        color: #06264A;
        border-top: 2px solid #198754;
    }

    .bill-calculation {
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #dee2e6;
    }

    .calculation-row {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        padding: 7px 0;
        color: #344054;
    }

    .bill-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding: 18px 20px;
        background: #06264A;
        color: white;
        border-radius: 12px;
    }

    .bill-total span {
        font-size: 17px;
    }

    .bill-total strong {
        font-size: 24px;
    }

    .bill-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-bottom: 20px;
    }

    .empty-state {
        text-align: center;
        padding: 55px 20px;
        color: #667085;
    }

    .empty-state i {
        font-size: 45px;
        color: #198754;
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {

        .bill-header {
            flex-direction: column;
            gap: 10px;
        }

        .farmer-details {
            grid-template-columns: 1fr;
        }

        .bill-preview {
            padding: 18px;
            overflow-x: auto;
        }

        .bill-table {
            min-width: 800px;
        }

        .bill-actions {
            justify-content: stretch;
        }

        .bill-actions .btn {
            flex: 1;
        }
    }


    /* PRINT */

    @media print {

        body * {
            visibility: hidden !important;
        }

        #adminBill,
        #adminBill * {
            visibility: visible !important;
        }

        #adminBill {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            box-shadow: none;
            padding: 15px;
        }

        .farmer-details {
            display: grid !important;
            grid-template-columns: repeat(3, 1fr) !important;
            gap: 15px !important;

            margin: 14px 0 !important;
            padding: 12px !important;
        }

        .bill-header {
            display: flex !important;
            flex-direction: row !important;
            justify-content: space-between !important;
            align-items: flex-start !important;
        }

        .bill-brand {
            display: flex !important;
        }

        .bill-month {
            text-align: right !important;
            margin-left: auto !important;
        }

        .no-print {
            display: none !important;
        }

        .bill-table th {
            color: black !important;
            background: #e9ecef !important;
        }

        .bill-total {
            color: black !important;
            background: #e9ecef !important;
        }

        @page {
            size: A4;
            margin: 12mm;
        }
    }

    /* =========================================================
   PREMIUM FARMER SELECTOR
========================================================= */

    .farmer-selector {
        position: relative;
    }


    /* =========================================================
   SELECTOR BUTTON
========================================================= */

    .farmer-selector-button {
        width: 100%;
        height: 48px;
        min-height: 48px;

        display: flex;
        align-items: center;

        gap: 10px;

        padding: 7px 12px;

        border: 1px solid #dee5e1;
        border-radius: 9px;

        background: #fff;

        text-align: left;

        transition: all .2s ease;
    }

    .farmer-selector-button:hover {
        border-color: #198754;
    }

    .farmer-selector.open .farmer-selector-button {
        border-color: #198754;

        box-shadow: 0 0 0 3px rgba(25, 135, 84, .10);
    }


    /* =========================================================
   SELECTED FARMER
========================================================= */

    .selected-farmer-icon {
        width: 34px;
        height: 34px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        border-radius: 9px;

        background: #e8f5ef;
        color: #198754;

        font-size: 15px;
    }

    .selected-farmer-content {
        min-width: 0;
        flex: 1;
    }

    .selected-farmer-name {
        display: block;

        overflow: hidden;

        color: #172033;

        font-size: 14px;
        font-weight: 600;

        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .selected-farmer-id {
        display: block;

        margin-top: 1px;

        color: #98a2b3;

        font-size: 11px;

        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .farmer-chevron {
        color: #667085;
        font-size: 12px;

        transition: transform .2s ease;
    }

    .farmer-selector.open .farmer-chevron {
        transform: rotate(180deg);
        color: #198754;
    }


    /* =========================================================
   DROPDOWN
========================================================= */

    .farmer-dropdown {
        position: absolute;

        top: calc(100% + 6px);
        left: 0;
        right: 0;

        z-index: 1050;

        display: none;

        overflow: hidden;

        border: 1px solid #e0e8e4;
        border-radius: 12px;

        background: #fff;

        box-shadow: 0 12px 30px rgba(6, 38, 74, .14);
    }

    .farmer-selector.open .farmer-dropdown {
        display: block;
    }


    /* =========================================================
   SEARCH
========================================================= */

    .farmer-search {
        position: relative;

        padding: 9px;

        border-bottom: 1px solid #edf1ef;

        background: #fafcfb;
    }

    .farmer-search i {
        position: absolute;

        left: 20px;
        top: 50%;

        transform: translateY(-50%);

        color: #98a2b3;

        font-size: 13px;
    }

    .farmer-search input {
        width: 100%;
        height: 38px;

        padding: 0 10px 0 32px;

        border: 1px solid #e1e8e4;
        border-radius: 8px;

        outline: none;

        color: #172033;

        font-size: 13px;
    }

    .farmer-search input:focus {
        border-color: #198754;

        box-shadow: 0 0 0 3px rgba(25, 135, 84, .08);
    }


    /* =========================================================
   FARMER LIST
========================================================= */

    .farmer-list {
        max-height: 230px;

        overflow-y: auto;

        padding: 5px;
    }

    .farmer-option {
        width: 100%;

        display: flex;
        align-items: center;

        gap: 10px;

        padding: 9px;

        border: 0;
        border-radius: 8px;

        background: transparent;

        text-align: left;

        transition: background .15s ease;
    }

    .farmer-option:hover {
        background: #f2f8f5;
    }

    .farmer-option.selected {
        background: #eaf7f0;
    }


    /* =========================================================
   OPTION
========================================================= */

    .farmer-option-icon {
        width: 34px;
        height: 34px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        border-radius: 8px;

        background: #edf7f2;
        color: #198754;

        font-size: 14px;
    }

    .farmer-option-content {
        min-width: 0;
        flex: 1;
    }

    .farmer-option-name {
        display: block;

        overflow: hidden;

        color: #172033;

        font-size: 13px;
        font-weight: 600;

        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .farmer-option-id {
        display: block;

        margin-top: 1px;

        color: #98a2b3;

        font-size: 11px;
    }

    .farmer-check {
        display: none;

        color: #198754;
        font-size: 16px;
    }

    .farmer-option.selected .farmer-check {
        display: block;
    }


    /* =========================================================
   NO RESULT
========================================================= */

    .farmer-no-result {
        display: none;

        align-items: center;
        justify-content: center;

        gap: 7px;

        padding: 22px;

        color: #98a2b3;

        font-size: 13px;
    }

    /* =========================================================
   ALIGN FARMER / MONTH / VIEW BILL FILTERS
========================================================= */

    .filter-card .row {
        align-items: flex-end !important;
    }

    .filter-card .form-label {
        height: 24px;

        display: flex;
        align-items: center;

        margin-bottom: 8px;
    }


    /* Farmer selector */
    .farmer-selector-button {
        height: 48px;
    }


    /* Month selector */
    .filter-card #month {
        height: 48px;
    }


    /* View Bill button */
    .filter-card button[type="submit"] {
        height: 48px;

        border-radius: 9px;

        font-weight: 600;
    }


    /* Keep all three columns visually aligned */
    .filter-card .col-md-5,
    .filter-card .col-md-4,
    .filter-card .col-md-3 {
        display: flex;
        flex-direction: column;
    }

    /* =========================================================
   MOBILE
========================================================= */

    @media (max-width: 767.98px) {

        .farmer-dropdown {
            position: absolute;
        }

    }
</style>


<div class="bill-page">

    <div class="container py-5">


        {{-- PAGE HEADER --}}

        <div class="bill-hero mb-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>

                    <div class="small opacity-75 mb-1">
                        <i class="bi bi-file-earmark-text me-1"></i>
                        ADMIN BILLING
                    </div>

                    <h1 class="mb-1">
                        Farmer Bills
                    </h1>

                    <p class="mb-0 opacity-75">
                        Generate and manage monthly farmer statements.
                    </p>

                </div>

                <div class="text-end">

                    <i class="bi bi-receipt-cutoff"
                        style="font-size: 48px; opacity: .8;"></i>

                </div>

            </div>

        </div>



        {{-- FILTER --}}

        <div class="filter-card p-4 mb-4">

            <form method="GET"
                action="{{ route('admin.farmer-bills.index') }}">

                <div class="row align-items-end g-3">

                    {{-- ================= FARMER ================= --}}

                    <div class="col-md-5">

                        <label class="form-label fw-semibold">

                            <i class="bi bi-person-badge me-1 text-success"></i>
                            Select Farmer

                        </label>

                        <div class="farmer-selector" id="farmerSelector">

                            {{-- Selected Farmer Button --}}

                            <button
                                type="button"
                                class="farmer-selector-button"
                                id="farmerSelectorButton">

                                <div class="selected-farmer-icon">

                                    <i class="bi bi-person-fill"></i>

                                </div>

                                <div class="selected-farmer-content">

                                    <span
                                        class="selected-farmer-name"
                                        id="selectedFarmerName">

                                        Select a farmer

                                    </span>

                                    <span
                                        class="selected-farmer-id"
                                        id="selectedFarmerId">

                                        Choose a farmer for the statement

                                    </span>

                                </div>

                                <i class="bi bi-chevron-down farmer-chevron"></i>

                            </button>


                            {{-- Hidden Farmer ID --}}

                            <input
                                type="hidden"
                                name="farmer_id"
                                id="farmer_id"
                                value="{{ request('farmer_id') }}"
                                required>


                            {{-- Farmer Dropdown --}}

                            <div
                                class="farmer-dropdown"
                                id="farmerDropdown">

                                {{-- Search --}}

                                <div class="farmer-search">

                                    <i class="bi bi-search"></i>

                                    <input
                                        type="text"
                                        id="farmerSearch"
                                        placeholder="Search farmer or ID..."
                                        autocomplete="off">

                                </div>


                                {{-- Farmer List --}}

                                <div
                                    class="farmer-list"
                                    id="farmerList">

                                    @foreach($farmers as $item)

                                    <button
                                        type="button"
                                        class="farmer-option"
                                        data-id="{{ $item->id }}"
                                        data-name="{{ $item->user->name }}"
                                        data-farmer-id="{{ $item->farmer_id }}">

                                        <span class="farmer-option-icon">

                                            <i class="bi bi-person-fill"></i>

                                        </span>

                                        <span class="farmer-option-content">

                                            <span class="farmer-option-name">
                                                {{ $item->user->name }}
                                            </span>

                                            <span class="farmer-option-id">
                                                {{ $item->farmer_id }}
                                            </span>

                                        </span>

                                        <i class="bi bi-check2 farmer-check"></i>

                                    </button>

                                    @endforeach

                                </div>


                                {{-- No Result --}}

                                <div
                                    class="farmer-no-result"
                                    id="farmerNoResult">

                                    <i class="bi bi-person-x"></i>

                                    No farmer found

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- ================= MONTH ================= --}}

                    <div class="col-md-4">

                        <label
                            for="month"
                            class="form-label fw-semibold">

                            <i class="bi bi-calendar3 me-1 text-success"></i>
                            Select Month

                        </label>

                        <select
                            name="month"
                            id="month"
                            class="form-select">

                            @foreach($months as $monthOption)

                            <option
                                value="{{ $monthOption['value'] }}"
                                {{ $monthOption['value'] === $month->format('Y-m') ? 'selected' : '' }}>

                                {{ $monthOption['label'] }}

                            </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- ================= VIEW BILL ================= --}}

                    <div class="col-md-3">

                        <button
                            type="submit"
                            class="btn btn-success w-100">

                            <i class="bi bi-search me-1"></i>

                            View Bill

                        </button>

                    </div>

                </div>

            </form>

        </div>
        @if($farmer)


        {{-- SUMMARY CARDS --}}

        <div class="row g-3 mb-4">

            <div class="col-md-3">

                <div class="stat-card">

                    <div class="stat-icon">
                        <i class="bi bi-droplet-fill"></i>
                    </div>

                    <div class="stat-label">
                        Cow Milk
                    </div>

                    <div class="stat-value">
                        {{ number_format($cowMilk, 2) }} L
                    </div>

                </div>

            </div>


            <div class="col-md-3">

                <div class="stat-card">

                    <div class="stat-icon">
                        <i class="bi bi-droplet-half"></i>
                    </div>

                    <div class="stat-label">
                        Buffalo Milk
                    </div>

                    <div class="stat-value">
                        {{ number_format($buffaloMilk, 2) }} L
                    </div>

                </div>

            </div>


            <div class="col-md-3">

                <div class="stat-card">

                    <div class="stat-icon">
                        <i class="bi bi-bar-chart-fill"></i>
                    </div>

                    <div class="stat-label">

                        Total Milk
                    </div>

                    <div class="stat-value">
                        {{ number_format($totalMilk, 2) }} L
                    </div>

                </div>

            </div>


            <div class="col-md-3">

                <div class="stat-card">

                    <div class="stat-icon">
                        <i class="bi bi-currency-rupee"></i>
                    </div>

                    <div class="stat-label">
                        Total Amount
                    </div>

                    <div class="stat-value">
                        ₹{{ number_format($totalAmount, 2) }}
                    </div>

                </div>

            </div>

        </div>


        {{-- ACTIONS --}}

        <div class="bill-actions no-print">

            <button
                type="button"
                onclick="window.print()"
                class="btn btn-outline-success">

                <i class="bi bi-printer me-1"></i>
                Print / Save PDF

            </button>

            <a
                href="https://wa.me/?text={{ urlencode(
                        'Hello ' .
                        $farmer->user->name .
                        ', your Gourik Premium Milk statement for ' .
                        $month->format('F Y') .
                        ' is ready. Total milk: ' .
                        number_format($totalMilk, 2) .
                        ' L. Total amount: ₹' .
                        number_format($totalAmount, 2)
                    ) }}"
                target="_blank"
                class="btn btn-success">

                <i class="bi bi-whatsapp me-1"></i>
                WhatsApp

            </a>

        </div>


        {{-- BILL --}}

        <div id="adminBill"
            class="bill-preview">


            <div class="bill-header">

                <div class="bill-brand">

                    <img
                        src="{{ asset('images/gourik_logo.png') }}"
                        alt="Gourik Premium Milk"
                        class="bill-logo">

                </div>

                <div class="bill-month">

                    {{ $month->format('F Y') }}
                    <p class="text-small">
                        Monthly Milk Statement
                    </p>

                </div>

            </div>


            {{-- FARMER DETAILS --}}

            <div class="farmer-details">

                <div>

                    <strong>
                        Farmer Name
                    </strong>

                    <span>
                        {{ $farmer->user->name }}
                    </span>

                </div>


                <div>

                    <strong>
                        Farmer ID
                    </strong>

                    <span>
                        {{ $farmer->farmer_id }}
                    </span>

                </div>


                <div>

                    <strong>
                        Statement Period
                    </strong>

                    <span>

                        {{ $month->copy()->startOfMonth()->format('d M Y') }}

                        -

                        {{ $month->copy()->endOfMonth()->format('d M Y') }}

                    </span>

                </div>

            </div>


            {{-- TABLE --}}

            <div style="overflow-x:auto;">

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

                        @forelse($entries as $entry)

                        @php

                        $dailyTotal =
                        (float) $entry->cow_morning +
                        (float) $entry->cow_evening +
                        (float) $entry->buffalo_morning +
                        (float) $entry->buffalo_evening;

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

                        @empty

                        <tr>

                            <td colspan="6"
                                class="text-center py-4">

                                No milk entries found for
                                {{ $month->format('F Y') }}.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>


                    <tfoot>

                        <tr>

                            <th>
                                TOTAL
                            </th>

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

            </div>


            {{-- CALCULATION --}}

            <div class="bill-calculation">

                <div class="calculation-row">

                    <span>
                        Cow Milk
                    </span>

                    <strong>

                        {{ number_format($cowMilk, 2) }} L

                        ×

                        ₹{{ number_format(
                                $farmer->cow_rate ?? 0,
                                2
                            ) }}

                        =

                        ₹{{ number_format(
                                $cowAmount,
                                2
                            ) }}

                    </strong>

                </div>


                <div class="calculation-row">

                    <span>
                        Buffalo Milk
                    </span>

                    <strong>

                        {{ number_format($buffaloMilk, 2) }} L

                        ×

                        ₹{{ number_format(
                                $farmer->buffalo_rate ?? 0,
                                2
                            ) }}

                        =

                        ₹{{ number_format(
                                $buffaloAmount,
                                2
                            ) }}

                    </strong>

                </div>

            </div>


            {{-- TOTAL --}}

            <div class="bill-total">

                <span>
                    Total Amount
                </span>

                <strong>
                    ₹{{ number_format($totalAmount, 2) }}
                </strong>

            </div>


            {{-- FOOTER --}}

            <div class="text-center text-muted small mt-4">

                Gourik Premium Milk

                <span class="mx-2">•</span>

                Generated on
                {{ now()->format('d M Y') }}

            </div>

        </div>


        @else


        {{-- EMPTY STATE --}}

        <div class="filter-card">

            <div class="empty-state">

                <i class="bi bi-file-earmark-bar-graph d-block"></i>

                <h4 class="fw-bold text-dark">
                    Select a Farmer
                </h4>

                <p class="mb-0">
                    Choose a farmer and month above to generate
                    their monthly statement.
                </p>

            </div>

        </div>


        @endif


    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const selector =
            document.getElementById('farmerSelector');

        const button =
            document.getElementById('farmerSelectorButton');

        const search =
            document.getElementById('farmerSearch');

        const hiddenInput =
            document.getElementById('farmer_id');

        const selectedName =
            document.getElementById('selectedFarmerName');

        const selectedId =
            document.getElementById('selectedFarmerId');

        const options =
            document.querySelectorAll('.farmer-option');

        const noResult =
            document.getElementById('farmerNoResult');


        /* Open / Close */

        button.addEventListener('click', function(event) {

            event.stopPropagation();

            selector.classList.toggle('open');

            if (selector.classList.contains('open')) {

                setTimeout(function() {
                    search.focus();
                }, 50);

            }

        });


        /* Select Farmer */

        options.forEach(function(option) {

            option.addEventListener('click', function() {

                hiddenInput.value =
                    this.dataset.id;

                selectedName.textContent =
                    this.dataset.name;

                selectedId.textContent =
                    this.dataset.farmerId;


                options.forEach(function(item) {

                    item.classList.remove('selected');

                });


                this.classList.add('selected');


                selector.classList.remove('open');

                search.value = '';

                filterFarmers();

            });

        });


        /* Search */

        search.addEventListener('input', filterFarmers);


        function filterFarmers() {

            const searchText =
                search.value.toLowerCase().trim();

            let visibleCount = 0;


            options.forEach(function(option) {

                const name =
                    option.dataset.name.toLowerCase();

                const farmerId =
                    option.dataset.farmerId.toLowerCase();


                const matches =
                    name.includes(searchText) ||
                    farmerId.includes(searchText);


                option.style.display =
                    matches ? 'flex' : 'none';


                if (matches) {
                    visibleCount++;
                }

            });


            noResult.style.display =
                visibleCount === 0 ? 'flex' : 'none';

        }


        /* Close outside */

        document.addEventListener('click', function(event) {

            if (!selector.contains(event.target)) {

                selector.classList.remove('open');

            }

        });


        /* Restore selected farmer */

        const currentValue =
            hiddenInput.value;

        if (currentValue) {

            options.forEach(function(option) {

                if (option.dataset.id === currentValue) {

                    selectedName.textContent =
                        option.dataset.name;

                    selectedId.textContent =
                        option.dataset.farmerId;

                    option.classList.add('selected');

                }

            });

        }

    });
</script>
@endsection
@extends('layouts.portal')

@section('title', 'Milk History | Gourik Admin')

@section('content')

<div class="container py-5">
    {{-- Success Message --}}
    @if(session('success'))
    <div class="gourik-toast success-toast">

        <i class="bi bi-check-circle-fill"></i>

        <div>
            <strong>{{ session('success') }}</strong>

            <div class="small mt-1">
                Farmer:
                <strong>{{ session('updated_farmer') }}</strong>
                ({{ session('updated_farmer_id') }})

                <br>

                Date:
                {{ session('updated_date') }}
            </div>
        </div>

    </div>
    @endif

    {{-- Error Messages --}}
    @if($errors->any())
    <div class="gourik-toast error-toast">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <span>{{ $errors->first() }}</span>
    </div>
    @endif

    
{{-- Header --}}
<div class="milk-history-header mb-4">

    <div class="milk-history-header-content">

        <div>
            <div class="milk-history-label">
                <i class="bi bi-droplet-fill"></i>
                MILK MANAGEMENT
            </div>

            <h1>Milk History</h1>

            <p>
                View and manage daily milk collection records.
            </p>
        </div>

        <div class="milk-history-header-icon">
            <i class="bi bi-droplet-half"></i>
        </div>

    </div>

</div>

    {{-- Filters --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form method="GET"
                action="{{ route('admin.milk.index') }}">

                <div class="row align-items-end">

                    {{-- Farmer --}}
                    <div class="col-md-5 mb-3 mb-md-0">

                        <label class="form-label fw-semibold">
                            Farmer
                        </label>

                        <select name="farmer_id"
                            class="form-select">

                            <option value="">
                                All Farmers
                            </option>

                            @foreach($farmers as $farmer)

                            <option
                                value="{{ $farmer->id }}"
                                {{ request('farmer_id') == $farmer->id ? 'selected' : '' }}>
                                {{ $farmer->farmer_id }}
                                -
                                {{ $farmer->user->name }}
                            </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Date --}}
                    <div class="col-md-4 mb-3 mb-md-0">

                        <label class="form-label fw-semibold">
                            Date
                        </label>

                        <input
                            type="date"
                            name="entry_date"
                            class="form-control"
                            value="{{ request('entry_date') }}">

                    </div>


                    {{-- Buttons --}}
                    <div class="col-md-3">

                        <button type="submit"
                            class="btn btn-success">

                            <i class="bi bi-search"></i>
                            Filter

                        </button>

                        <a href="{{ route('admin.milk.index') }}"
                            class="btn btn-light">

                            Reset

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- History Table --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>
                            <th>Date</th>
                            <th>Farmer</th>
                            <th>Cow Morning</th>
                            <th>Cow Evening</th>
                            <th>Buffalo Morning</th>
                            <th>Buffalo Evening</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>

                    </thead>

                    <tbody>
                        @php
                        $totalCowMorning = $entries->sum('cow_morning');
                        $totalCowEvening = $entries->sum('cow_evening');
                        $totalBuffaloMorning = $entries->sum('buffalo_morning');
                        $totalBuffaloEvening = $entries->sum('buffalo_evening');

                        $grandTotal =
                        $totalCowMorning +
                        $totalCowEvening +
                        $totalBuffaloMorning +
                        $totalBuffaloEvening;
                        @endphp

                        @forelse($entries as $entry)
                        

                        @php

                        $total =
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

                                <strong>
                                    {{ $entry->farmer->user->name }}
                                </strong>

                                <br>

                                <small class="text-muted">
                                    {{ $entry->farmer->farmer_id }}
                                </small>

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
                                    {{ number_format($total, 2) }} L
                                </strong>
                            </td>

                            <td>
                                <a href="{{ route('admin.milk.edit', $entry) }}"
                                    class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-pencil"></i>
                                    Edit
                                </a>
                            </td>
                        </tr>

                        @empty

                        <tr>

                            <td colspan="8"
                                class="text-center py-5 text-muted">

                                <i class="bi bi-droplet fs-2 d-block mb-2"></i>

                                No milk entries found.

                            </td>

                        </tr>

                        @endforelse

                        @if($entries->count() > 0)
                        <tr class="table-light fw-semibold">
                            <td colspan="2">
                                Total
                            </td>

                            <td>
                                {{ number_format($totalCowMorning, 2) }} L
                            </td>

                            <td>
                                {{ number_format($totalCowEvening, 2) }} L
                            </td>

                            <td>
                                {{ number_format($totalBuffaloMorning, 2) }} L
                            </td>

                            <td>
                                {{ number_format($totalBuffaloEvening, 2) }} L
                            </td>

                            <td>
                                <strong class="text-success">
                                    {{ number_format($grandTotal, 2) }} L
                                </strong>
                            </td>

                            <td></td>
                        </tr>
                        @endif

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
<style>

    /* ========================================
   MILK HISTORY HEADER
======================================== */

.milk-history-header {
    background: linear-gradient(
        135deg,
        #06264A 0%,
        #0b4960 55%,
        #116b72 100%
    );

    border-radius: 20px;

    padding: 32px 34px;

    color: white;

    box-shadow: 0 10px 30px rgba(6, 38, 74, 0.15);

    overflow: hidden;

    position: relative;
}

.milk-history-header::after {
    content: "";

    position: absolute;

    width: 220px;
    height: 220px;

    right: -70px;
    top: -80px;

    background: rgba(255, 255, 255, 0.06);

    border-radius: 50%;
}

.milk-history-header-content {
    display: flex;

    align-items: center;

    justify-content: space-between;

    position: relative;

    z-index: 1;
}

.milk-history-label {
    font-size: 14px;

    font-weight: 600;

    letter-spacing: 0.5px;

    color: rgba(255, 255, 255, 0.75);

    margin-bottom: 8px;
}

.milk-history-label i {
    margin-right: 6px;
}

.milk-history-header h1 {
    margin: 0 0 6px;

    font-size: 32px;

    font-weight: 700;

    color: #ffffff;
}

.milk-history-header p {
    margin: 0;

    font-size: 16px;

    color: rgba(255, 255, 255, 0.75);
}

.milk-history-header-icon {
    width: 76px;
    height: 76px;

    display: flex;

    align-items: center;
    justify-content: center;

    border: 2px solid rgba(255, 255, 255, 0.35);

    border-radius: 18px;

    color: rgba(255, 255, 255, 0.85);

    font-size: 42px;

    margin-right: 10px;
}


/* Mobile */
@media (max-width: 576px) {

    .milk-history-header {
        padding: 25px 22px;
        border-radius: 16px;
    }

    .milk-history-header h1 {
        font-size: 26px;
    }

    .milk-history-header p {
        font-size: 14px;
    }

    .milk-history-header-icon {
        width: 58px;
        height: 58px;

        font-size: 30px;

        margin-left: 15px;
    }
}
    .gourik-toast {
        position: fixed;
        top: 80px;
        right: 25px;
        z-index: 9999;

        min-width: 300px;
        max-width: 400px;

        padding: 15px 20px;
        border-radius: 10px;

        display: flex;
        align-items: center;
        gap: 12px;

        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);

        animation: toastSlideIn 0.4s ease;
    }

    .success-toast {
        background: #198754;
        color: white;
    }

    .error-toast {
        background: #dc3545;
        color: white;
    }

    .gourik-toast i {
        font-size: 20px;
    }

    @keyframes toastSlideIn {
        from {
            opacity: 0;
            transform: translateX(100px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes toastFadeOut {
        from {
            opacity: 1;
            transform: translateX(0);
        }

        to {
            opacity: 0;
            transform: translateX(100px);
        }
    }

    .toast-hide {
        animation: toastFadeOut 0.5s ease forwards;
    }

    @media (max-width: 576px) {
        .gourik-toast {
            left: 15px;
            right: 15px;
            top: 70px;
            min-width: auto;
        }
    }
</style>
<script>
    setTimeout(function() {

        const toast = document.querySelector('.gourik-toast');

        if (toast) {
            toast.classList.add('toast-hide');

            setTimeout(function() {
                toast.remove();
            }, 500);
        }

    }, 3000);
</script>
@endsection
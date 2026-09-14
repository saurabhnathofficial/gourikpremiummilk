@extends('layouts.portal')

@section('title', 'Milk Collection | Gourik Admin')

@section('content')

<div class="container py-5">

    {{-- ========================================
        PREMIUM HEADER
    ========================================= --}}
    <div class="milk-collection-header mb-3">

        <div class="milk-collection-header-content">

            <div>
                <div class="milk-collection-label">
                    <i class="bi bi-droplet-fill"></i>
                    MILK MANAGEMENT
                </div>

                <h1>Milk Collection</h1>

                <p>
                    Record and manage daily farmer milk collection.
                </p>
            </div>

            <div class="milk-collection-header-icon">
                <i class="bi bi-droplet-half"></i>
            </div>

        </div>

    </div>


    {{-- ========================================
        SESSION BUTTONS
    ========================================= --}}
    <div class="collection-actions mb-4">

        <a href="{{ route('admin.milk.create', ['session' => 'morning']) }}"
            class="collection-session-btn {{ $session === 'morning' ? 'active' : '' }}">

            <span class="session-icon morning-icon">
                <i class="bi bi-sunrise"></i>
            </span>

            <span>
                <strong>Morning Entry</strong>
                <small>Morning collection</small>
            </span>

        </a>


        <a href="{{ route('admin.milk.create', ['session' => 'evening']) }}"
            class="collection-session-btn {{ $session === 'evening' ? 'active' : '' }}">

            <span class="session-icon evening-icon">
                <i class="bi bi-sunset"></i>
            </span>

            <span>
                <strong>Evening Entry</strong>
                <small>Evening collection</small>
            </span>

        </a>


        <a href="{{ route('admin.milk.create', ['session' => 'both']) }}"
            class="collection-session-btn {{ $session === 'both' ? 'active' : '' }}">

            <span class="session-icon both-icon">
                <i class="bi bi-calendar2-check"></i>
            </span>

            <span>
                <strong>Both Sessions</strong>
                <small>Morning & evening</small>
            </span>

        </a>

    </div>


    {{-- ========================================
        SUCCESS MESSAGE
    ========================================= --}}
    @if(session('success'))

        <div class="gourik-toast success-toast">

            <i class="bi bi-check-circle-fill"></i>

            <div>

                <strong>{{ session('success') }}</strong>

                <div class="small mt-1">

                    Farmer:
                    <strong>
                        {{ session('updated_farmer') }}
                    </strong>

                    ({{ session('updated_farmer_id') }})

                    <br>

                    Date:
                    {{ session('updated_date') }}

                    @if(session('updated_session'))

                        <br>

                        Session:
                        {{ session('updated_session') }}

                    @endif

                </div>

            </div>

        </div>

    @endif


    {{-- ========================================
        ERROR MESSAGE
    ========================================= --}}
    @if($errors->any())

        <div class="gourik-toast error-toast">

            <i class="bi bi-exclamation-triangle-fill"></i>

            <div>

                <strong>Something went wrong!</strong>

                <div class="small mt-1">
                    {{ $errors->first() }}
                </div>

            </div>

        </div>

    @endif


    {{-- ========================================
        COLLECTION CARD
    ========================================= --}}
    <div class="collection-card">

        <div class="collection-card-header">

            <div class="collection-card-title">

                <div class="collection-title-icon">
                    <i class="bi bi-clipboard2-data"></i>
                </div>

                <div>

                    <h4>Collection Details</h4>

                    <p>
                        Select farmer and collection date to begin.
                    </p>

                </div>

            </div>

        </div>


        <div class="collection-card-body">

            <form method="POST"
                action="{{ route('admin.milk.store') }}">

                @csrf

                <input type="hidden"
                    name="session"
                    value="{{ $session }}">


                {{-- ========================================
                    FARMER & DATE
                ========================================= --}}
                <div class="row g-4">

                    {{-- Farmer --}}
                    <div class="col-md-6">

                        <label for="farmer_id"
                            class="form-label custom-label">

                            <i class="bi bi-person-fill"></i>
                            Farmer

                        </label>

                        <select
                            name="farmer_id"
                            id="farmer_id"
                            class="form-select custom-input"
                            required>

                            <option value="">
                                Select Farmer
                            </option>

                            @foreach($farmers as $farmer)

                                <option
                                    value="{{ $farmer->id }}"
                                    data-cow-rate="{{ $farmer->cow_rate }}"
                                    data-buffalo-rate="{{ $farmer->buffalo_rate }}"
                                    {{ old('farmer_id') == $farmer->id ? 'selected' : '' }}>

                                    {{ $farmer->farmer_id }}
                                    -
                                    {{ $farmer->user->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Date --}}
                    <div class="col-md-6">

                        <label for="entry_date"
                            class="form-label custom-label">

                            <i class="bi bi-calendar-event"></i>
                            Collection Date

                        </label>

                        <input
                            type="date"
                            name="entry_date"
                            id="entry_date"
                            class="form-control custom-input"
                            value="{{ old('entry_date', date('Y-m-d')) }}"
                            required>

                    </div>

                </div>


                <div class="section-divider"></div>


                {{-- ========================================
                    BOTH SESSIONS
                ========================================= --}}
                @if($session === 'both')

                    {{-- Morning --}}
                    <div class="session-section morning-section">

                        <div class="session-section-title">

                            <div class="session-heading-icon morning-heading-icon">
                                <i class="bi bi-sunrise"></i>
                            </div>

                            <div>
                                <h5>Morning Session</h5>
                                <span>Enter morning milk collection</span>
                            </div>

                        </div>


                        <div class="row g-4">

                            {{-- Cow --}}
                            <div class="col-md-6">

                                <label for="morning_cow_milk"
                                    class="form-label custom-label">

                                    <i class="bi bi-droplet-fill"></i>
                                    Cow Milk
                                    <span>(Litres)</span>

                                </label>

                                <div class="milk-input-wrapper">

                                    <input
                                        type="number"
                                        name="morning_cow_milk"
                                        id="morning_cow_milk"
                                        class="form-control custom-input milk-input"
                                        step="0.01"
                                        min="0"
                                        value="{{ old('morning_cow_milk', 0) }}"
                                        placeholder="0.00">

                                    <span>L</span>

                                </div>

                            </div>


                            {{-- Buffalo --}}
                            <div class="col-md-6">

                                <label for="morning_buffalo_milk"
                                    class="form-label custom-label">

                                    <i class="bi bi-droplet-fill"></i>
                                    Buffalo Milk
                                    <span>(Litres)</span>

                                </label>

                                <div class="milk-input-wrapper">

                                    <input
                                        type="number"
                                        name="morning_buffalo_milk"
                                        id="morning_buffalo_milk"
                                        class="form-control custom-input milk-input"
                                        step="0.01"
                                        min="0"
                                        value="{{ old('morning_buffalo_milk', 0) }}"
                                        placeholder="0.00">

                                    <span>L</span>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Evening --}}
                    <div class="session-section evening-section">

                        <div class="session-section-title">

                            <div class="session-heading-icon evening-heading-icon">
                                <i class="bi bi-sunset"></i>
                            </div>

                            <div>
                                <h5>Evening Session</h5>
                                <span>Enter evening milk collection</span>
                            </div>

                        </div>


                        <div class="row g-4">

                            {{-- Cow --}}
                            <div class="col-md-6">

                                <label for="evening_cow_milk"
                                    class="form-label custom-label">

                                    <i class="bi bi-droplet-fill"></i>
                                    Cow Milk
                                    <span>(Litres)</span>

                                </label>

                                <div class="milk-input-wrapper">

                                    <input
                                        type="number"
                                        name="evening_cow_milk"
                                        id="evening_cow_milk"
                                        class="form-control custom-input milk-input"
                                        step="0.01"
                                        min="0"
                                        value="{{ old('evening_cow_milk', 0) }}"
                                        placeholder="0.00">

                                    <span>L</span>

                                </div>

                            </div>


                            {{-- Buffalo --}}
                            <div class="col-md-6">

                                <label for="evening_buffalo_milk"
                                    class="form-label custom-label">

                                    <i class="bi bi-droplet-fill"></i>
                                    Buffalo Milk
                                    <span>(Litres)</span>

                                </label>

                                <div class="milk-input-wrapper">

                                    <input
                                        type="number"
                                        name="evening_buffalo_milk"
                                        id="evening_buffalo_milk"
                                        class="form-control custom-input milk-input"
                                        step="0.01"
                                        min="0"
                                        value="{{ old('evening_buffalo_milk', 0) }}"
                                        placeholder="0.00">

                                    <span>L</span>

                                </div>

                            </div>

                        </div>

                    </div>


                @else

                    {{-- ========================================
                        SINGLE SESSION
                    ========================================= --}}

                    <div class="session-section">

                        <div class="session-section-title">

                            <div class="session-heading-icon">
                                @if($session === 'morning')
                                    <i class="bi bi-sunrise"></i>
                                @else
                                    <i class="bi bi-sunset"></i>
                                @endif
                            </div>

                            <div>

                                <h5>
                                    {{ ucfirst($session) }} Session
                                </h5>

                                <span>
                                    Enter {{ $session }} milk collection
                                </span>

                            </div>

                        </div>


                        <div class="row g-4">

                            {{-- Cow --}}
                            <div class="col-md-6">

                                <label for="cow_milk"
                                    class="form-label custom-label">

                                    <i class="bi bi-droplet-fill"></i>
                                    Cow Milk
                                    <span>(Litres)</span>

                                </label>

                                <div class="milk-input-wrapper">

                                    <input
                                        type="number"
                                        name="cow_milk"
                                        id="cow_milk"
                                        class="form-control custom-input milk-input"
                                        step="0.01"
                                        min="0"
                                        value="{{ old('cow_milk', 0) }}"
                                        placeholder="0.00">

                                    <span>L</span>

                                </div>

                            </div>


                            {{-- Buffalo --}}
                            <div class="col-md-6">

                                <label for="buffalo_milk"
                                    class="form-label custom-label">

                                    <i class="bi bi-droplet-fill"></i>
                                    Buffalo Milk
                                    <span>(Litres)</span>

                                </label>

                                <div class="milk-input-wrapper">

                                    <input
                                        type="number"
                                        name="buffalo_milk"
                                        id="buffalo_milk"
                                        class="form-control custom-input milk-input"
                                        step="0.01"
                                        min="0"
                                        value="{{ old('buffalo_milk', 0) }}"
                                        placeholder="0.00">

                                    <span>L</span>

                                </div>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- ========================================
                    RATES
                ========================================= --}}
                <div class="rates-section">

                    <div class="rates-header">

                        <div class="rates-icon">
                            <i class="bi bi-currency-rupee"></i>
                        </div>

                        <div>
                            <h5>Milk Rates</h5>
                            <span>
                                Rates are automatically loaded from farmer profile.
                            </span>
                        </div>

                    </div>


                    <div class="row g-4">

                        {{-- Cow Rate --}}
                        <div class="col-md-6">

                            <label for="cow_rate"
                                class="form-label custom-label">

                                <i class="bi bi-currency-rupee"></i>
                                Cow Rate
                                <span>(₹ / Litre)</span>

                            </label>

                            <div class="rate-input-wrapper">

                                <span>₹</span>

                                <input
                                    type="number"
                                    name="cow_rate"
                                    id="cow_rate"
                                    class="form-control custom-input rate-input"
                                    step="0.01"
                                    min="0"
                                    value="{{ old('cow_rate') }}"
                                    placeholder="Select farmer"
                                    readonly>

                            </div>

                            <div class="form-text rate-help">
                                <i class="bi bi-lock-fill"></i>
                                Managed from Farmer Profile
                            </div>

                        </div>


                        {{-- Buffalo Rate --}}
                        <div class="col-md-6">

                            <label for="buffalo_rate"
                                class="form-label custom-label">

                                <i class="bi bi-currency-rupee"></i>
                                Buffalo Rate
                                <span>(₹ / Litre)</span>

                            </label>

                            <div class="rate-input-wrapper">

                                <span>₹</span>

                                <input
                                    type="number"
                                    name="buffalo_rate"
                                    id="buffalo_rate"
                                    class="form-control custom-input rate-input"
                                    step="0.01"
                                    min="0"
                                    value="{{ old('buffalo_rate') }}"
                                    placeholder="Select farmer"
                                    readonly>

                            </div>

                            <div class="form-text rate-help">
                                <i class="bi bi-lock-fill"></i>
                                Managed from Farmer Profile
                            </div>

                        </div>

                    </div>

                </div>


                {{-- ========================================
                    SAVE
                ========================================= --}}
                <div class="form-footer">

                    <div class="footer-note">
                        <i class="bi bi-shield-check"></i>
                        Collection data will be saved securely.
                    </div>

                    <button type="submit"
                        class="save-collection-btn">

                        <i class="bi bi-check2-circle"></i>

                        @if($session === 'both')
                            Save Morning & Evening Entries
                        @else
                            Save {{ ucfirst($session) }} Entry
                        @endif

                    </button>

                </div>


            </form>

        </div>

    </div>

</div>


{{-- ========================================
    STYLES
========================================= --}}
<style>

/* ========================================
   MILK COLLECTION HEADER
======================================== */

.milk-collection-header {
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

.milk-collection-header::after {
    content: "";

    position: absolute;

    width: 220px;
    height: 220px;

    right: -70px;
    top: -80px;

    background: rgba(255, 255, 255, 0.06);

    border-radius: 50%;
}

.milk-collection-header-content {
    display: flex;

    align-items: center;

    justify-content: space-between;

    position: relative;

    z-index: 1;
}

.milk-collection-label {
    font-size: 14px;

    font-weight: 600;

    letter-spacing: 0.6px;

    color: rgba(255, 255, 255, 0.75);

    margin-bottom: 8px;
}

.milk-collection-label i {
    margin-right: 6px;
}

.milk-collection-header h1 {
    margin: 0 0 6px;

    font-size: 32px;

    font-weight: 700;

    color: #ffffff;
}

.milk-collection-header p {
    margin: 0;

    font-size: 16px;

    color: rgba(255, 255, 255, 0.75);
}

.milk-collection-header-icon {
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


/* ========================================
   SESSION ACTIONS
======================================== */

.collection-actions {
    display: flex;

    justify-content: flex-end;

    gap: 12px;
}

.collection-session-btn {
    display: flex;

    align-items: center;

    gap: 11px;

    min-width: 190px;

    padding: 11px 15px;

    border: 1px solid #dee5e2;

    border-radius: 12px;

    background: #ffffff;

    color: #172033;

    text-decoration: none;

    transition: all 0.2s ease;

    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.04);
}

.collection-session-btn:hover {
    transform: translateY(-2px);

    border-color: #198754;

    color: #198754;

    box-shadow: 0 6px 18px rgba(25, 135, 84, 0.12);
}

.collection-session-btn.active {
    background: #198754;

    border-color: #198754;

    color: #ffffff;

    box-shadow: 0 6px 18px rgba(25, 135, 84, 0.20);
}

.collection-session-btn strong {
    display: block;

    font-size: 14px;
}

.collection-session-btn small {
    display: block;

    margin-top: 2px;

    font-size: 11px;

    opacity: 0.65;
}

.collection-session-btn.active small {
    opacity: 0.8;
}

.session-icon {
    width: 40px;
    height: 40px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 10px;

    font-size: 19px;

    background: #f1f7f4;
}

.collection-session-btn.active .session-icon {
    background: rgba(255, 255, 255, 0.16);
    color: white;
}

.morning-icon {
    color: #d18b00;
}

.evening-icon {
    color: #5269a8;
}

.both-icon {
    color: #198754;
}


/* ========================================
   MAIN COLLECTION CARD
======================================== */

.collection-card {
    background: #ffffff;

    border: 1px solid #e8eeeb;

    border-radius: 20px;

    box-shadow: 0 8px 30px rgba(17, 24, 39, 0.06);

    overflow: hidden;
}

.collection-card-header {
    padding: 23px 28px;

    border-bottom: 1px solid #edf1ef;

    background: #fbfdfc;
}

.collection-card-title {
    display: flex;

    align-items: center;

    gap: 14px;
}

.collection-title-icon {
    width: 46px;
    height: 46px;

    display: flex;

    align-items: center;
    justify-content: center;

    background: #eaf6f0;

    color: #198754;

    border-radius: 12px;

    font-size: 21px;
}

.collection-card-header h4 {
    margin: 0;

    font-size: 19px;

    font-weight: 700;

    color: #172033;
}

.collection-card-header p {
    margin: 3px 0 0;

    color: #667085;

    font-size: 13px;
}

.collection-card-body {
    padding: 28px;
}


/* ========================================
   FORM INPUTS
======================================== */

.custom-label {
    color: #344054;

    font-size: 14px;

    font-weight: 600;

    margin-bottom: 8px;
}

.custom-label i {
    color: #198754;

    margin-right: 5px;
}

.custom-label span {
    color: #98a2b3;

    font-weight: 400;

    font-size: 12px;
}

.custom-input {
    min-height: 46px;

    border: 1px solid #d8e0dc;

    border-radius: 10px;

    padding: 10px 13px;

    color: #172033;

    box-shadow: none;

    transition: all 0.2s ease;
}

.custom-input:focus {
    border-color: #198754;

    box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.10);
}


/* ========================================
   DIVIDER
======================================== */

.section-divider {
    height: 1px;

    background: #edf1ef;

    margin: 28px 0;
}


/* ========================================
   SESSION SECTIONS
======================================== */

.session-section {
    padding: 22px;

    border: 1px solid #e7eeea;

    border-radius: 16px;

    background: #fbfdfc;

    margin-bottom: 24px;
}

.morning-section {
    border-left: 4px solid #e0a800;
}

.evening-section {
    border-left: 4px solid #667eea;
}

.session-section-title {
    display: flex;

    align-items: center;

    gap: 12px;

    margin-bottom: 20px;
}

.session-heading-icon {
    width: 42px;
    height: 42px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background: #eaf6f0;

    color: #198754;

    font-size: 19px;
}

.morning-heading-icon {
    background: #fff7df;

    color: #c48a00;
}

.evening-heading-icon {
    background: #eef1ff;

    color: #5c6bc0;
}

.session-section-title h5 {
    margin: 0;

    font-size: 16px;

    font-weight: 700;

    color: #172033;
}

.session-section-title span {
    display: block;

    margin-top: 2px;

    color: #98a2b3;

    font-size: 12px;
}


/* ========================================
   MILK INPUT
======================================== */

.milk-input-wrapper {
    position: relative;
}

.milk-input-wrapper input {
    padding-right: 42px;
}

.milk-input-wrapper > span {
    position: absolute;

    right: 14px;

    top: 50%;

    transform: translateY(-50%);

    color: #667085;

    font-size: 13px;

    font-weight: 600;

    pointer-events: none;
}


/* ========================================
   RATES
======================================== */

.rates-section {
    margin-top: 28px;

    padding: 22px;

    border-radius: 16px;

    background: #f5faf7;

    border: 1px solid #dfeee6;
}

.rates-header {
    display: flex;

    align-items: center;

    gap: 12px;

    margin-bottom: 20px;
}

.rates-icon {
    width: 42px;
    height: 42px;

    display: flex;

    align-items: center;
    justify-content: center;

    background: #e1f2e9;

    color: #198754;

    border-radius: 11px;

    font-size: 18px;
}

.rates-header h5 {
    margin: 0;

    font-size: 16px;

    font-weight: 700;
}

.rates-header span {
    display: block;

    margin-top: 2px;

    font-size: 12px;

    color: #667085;
}

.rate-input-wrapper {
    position: relative;
}

.rate-input-wrapper > span {
    position: absolute;

    left: 14px;

    top: 50%;

    transform: translateY(-50%);

    color: #198754;

    font-weight: 700;

    z-index: 2;
}

.rate-input {
    padding-left: 32px;

    background: #eef5f1;

    color: #344054;

    cursor: not-allowed;
}

.rate-help {
    color: #7a8b82;

    font-size: 11px;

    margin-top: 6px;
}

.rate-help i {
    margin-right: 3px;
}


/* ========================================
   FORM FOOTER
======================================== */

.form-footer {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    margin-top: 28px;

    padding-top: 22px;

    border-top: 1px solid #edf1ef;
}

.footer-note {
    color: #7a8b82;

    font-size: 12px;
}

.footer-note i {
    color: #198754;

    margin-right: 5px;
}

.save-collection-btn {
    border: 0;

    background: #198754;

    color: #ffffff;

    padding: 12px 22px;

    border-radius: 10px;

    font-size: 14px;

    font-weight: 600;

    box-shadow: 0 5px 14px rgba(25, 135, 84, 0.20);

    transition: all 0.2s ease;
}

.save-collection-btn:hover {
    background: #157347;

    transform: translateY(-1px);

    box-shadow: 0 7px 18px rgba(25, 135, 84, 0.25);
}

.save-collection-btn i {
    margin-right: 6px;
}


/* ========================================
   TOAST
======================================== */

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


/* ========================================
   RESPONSIVE
======================================== */

@media (max-width: 768px) {

    .milk-collection-header {
        padding: 25px 22px;
    }

    .milk-collection-header h1 {
        font-size: 27px;
    }

    .milk-collection-header p {
        font-size: 14px;
    }

    .milk-collection-header-icon {
        width: 58px;
        height: 58px;

        font-size: 30px;

        margin-left: 15px;
    }

    .collection-actions {
        justify-content: stretch;

        flex-direction: column;
    }

    .collection-session-btn {
        width: 100%;

        min-width: 0;
    }

    .collection-card-header,
    .collection-card-body {
        padding: 20px;
    }

    .session-section,
    .rates-section {
        padding: 18px;
    }

    .form-footer {
        align-items: stretch;

        flex-direction: column;
    }

    .save-collection-btn {
        width: 100%;
    }

}

@media (max-width: 576px) {

    .container.py-5 {
        padding-top: 25px !important;
    }

    .milk-collection-header {
        border-radius: 16px;
    }

    .milk-collection-header-icon {
        display: none;
    }

    .collection-card {
        border-radius: 16px;
    }

    .gourik-toast {
        left: 15px;
        right: 15px;

        top: 70px;

        min-width: auto;
    }

}

</style>


{{-- ========================================
    JAVASCRIPT
========================================= --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const farmerSelect =
        document.getElementById('farmer_id');

    const cowRateInput =
        document.getElementById('cow_rate');

    const buffaloRateInput =
        document.getElementById('buffalo_rate');


    function loadFarmerRates() {

        const selectedOption =
            farmerSelect.options[
                farmerSelect.selectedIndex
            ];


        if (!selectedOption || !selectedOption.value) {

            cowRateInput.value = '';
            buffaloRateInput.value = '';

            cowRateInput.placeholder =
                'Select farmer';

            buffaloRateInput.placeholder =
                'Select farmer';

            return;
        }


        const cowRate =
            selectedOption.dataset.cowRate;

        const buffaloRate =
            selectedOption.dataset.buffaloRate;


        cowRateInput.value =
            cowRate !== '' && cowRate !== 'null'
                ? cowRate
                : '';


        buffaloRateInput.value =
            buffaloRate !== '' && buffaloRate !== 'null'
                ? buffaloRate
                : '';


        cowRateInput.placeholder =
            cowRate
                ? 'Default: ₹' + cowRate
                : 'No cow rate';


        buffaloRateInput.placeholder =
            buffaloRate
                ? 'Default: ₹' + buffaloRate
                : 'No buffalo rate';

    }


    farmerSelect.addEventListener(
        'change',
        loadFarmerRates
    );


    // Load rates automatically if farmer
    // was already selected after validation error.

    loadFarmerRates();


    /* ========================================
       AUTO HIDE TOAST
    ========================================= */

    setTimeout(function () {

        const toast =
            document.querySelector('.gourik-toast');

        if (toast) {

            toast.classList.add('toast-hide');

            setTimeout(function () {

                toast.remove();

            }, 500);

        }

    }, 3000);

});

</script>

@endsection
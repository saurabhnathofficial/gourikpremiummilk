@extends('layouts.portal')

@section('title', 'Add Farmer | Gourik Admin')

@section('content')

<div class="container py-5">

    {{-- ========================================
        PREMIUM HEADER
    ========================================= --}}
    <div class="farmer-header mb-4">

        <div class="farmer-header-content">

            <div>

                <div class="farmer-header-label">
                    <i class="bi bi-people-fill"></i>
                    FARMER MANAGEMENT
                </div>

                <h1>Add Farmer</h1>

                <p>
                    Create a new farmer account and set their milk rates.
                </p>

            </div>

            <div class="farmer-header-icon">
                <i class="bi bi-person-plus-fill"></i>
            </div>

        </div>

    </div>


    {{-- ========================================
        VALIDATION ERRORS
    ========================================= --}}
    @if ($errors->any())

        <div class="farmer-error-card mb-4">

            <div class="farmer-error-icon">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>

            <div>

                <strong>Please fix the following errors:</strong>

                <ul class="mb-0 mt-2">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    {{-- ========================================
        FARMER FORM CARD
    ========================================= --}}
    <div class="farmer-form-card">

        <div class="farmer-form-header">

            <div class="farmer-form-title">

                <div class="farmer-title-icon">
                    <i class="bi bi-person-vcard"></i>
                </div>

                <div>

                    <h4>Farmer Details</h4>

                    <p>
                        Enter the farmer's account and contact information.
                    </p>

                </div>

            </div>

        </div>


        <div class="farmer-form-body">

            <form method="POST"
                action="{{ route('admin.farmers.store') }}">

                @csrf


                {{-- ========================================
                    BASIC DETAILS
                ========================================= --}}
                <div class="form-section">

                    <div class="form-section-heading">

                        <i class="bi bi-person-lines-fill"></i>

                        Basic Information

                    </div>


                    <div class="row g-4">

                        {{-- Farmer Name --}}
                        <div class="col-md-6">

                            <label class="custom-label">

                                <i class="bi bi-person-fill"></i>

                                Farmer Name

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control custom-input"
                                value="{{ old('name') }}"
                                placeholder="Enter farmer name"
                                required>

                        </div>


                        {{-- Farmer ID --}}
                        <div class="col-md-6">

                            <label class="custom-label">

                                <i class="bi bi-person-badge-fill"></i>

                                Farmer ID

                            </label>

                            <input
                                type="text"
                                name="farmer_id"
                                class="form-control custom-input"
                                value="{{ old('farmer_id') }}"
                                placeholder="Example: GM001"
                                required>

                            <div class="form-help">
                                <i class="bi bi-info-circle"></i>
                                This ID will be used by the farmer to log in.
                            </div>

                        </div>


                        {{-- Phone --}}
                        <div class="col-md-6">

                            <label class="custom-label">

                                <i class="bi bi-telephone-fill"></i>

                                Phone

                            </label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control custom-input"
                                value="{{ old('phone') }}"
                                placeholder="Enter phone number">

                        </div>


                        {{-- Password --}}
                        <div class="col-md-6">

                            <label class="custom-label">

                                <i class="bi bi-lock-fill"></i>

                                Password

                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control custom-input"
                                placeholder="Enter password"
                                required>

                            <div class="form-help">
                                <i class="bi bi-shield-check"></i>
                                Give this password to the farmer securely.
                            </div>

                        </div>


                        {{-- Address --}}
                        <div class="col-12">

                            <label class="custom-label">

                                <i class="bi bi-geo-alt-fill"></i>

                                Address

                            </label>

                            <textarea
                                name="address"
                                class="form-control custom-input"
                                rows="3"
                                placeholder="Enter farmer address">{{ old('address') }}</textarea>

                        </div>

                    </div>

                </div>


                {{-- ========================================
                    MILK RATES
                ========================================= --}}
                <div class="rates-section">

                    <div class="rates-header">

                        <div class="rates-icon">
                            <i class="bi bi-currency-rupee"></i>
                        </div>

                        <div>

                            <h5>Milk Rates</h5>

                            <span>
                                Set the payment rate for this farmer.
                            </span>

                        </div>

                    </div>


                    <div class="row g-4">

                        {{-- Cow Rate --}}
                        <div class="col-md-6">

                            <label class="custom-label">

                                <i class="bi bi-droplet-fill"></i>

                                Cow Rate

                                <span>
                                    (₹ / Litre)
                                </span>

                            </label>

                            <div class="rate-input-wrapper">

                                <span>₹</span>

                                <input
                                    type="number"
                                    name="cow_rate"
                                    class="form-control custom-input rate-input"
                                    value="{{ old('cow_rate') }}"
                                    step="0.01"
                                    min="0"
                                    placeholder="Example: 52">

                            </div>

                        </div>


                        {{-- Buffalo Rate --}}
                        <div class="col-md-6">

                            <label class="custom-label">

                                <i class="bi bi-droplet-fill"></i>

                                Buffalo Rate

                                <span>
                                    (₹ / Litre)
                                </span>

                            </label>

                            <div class="rate-input-wrapper">

                                <span>₹</span>

                                <input
                                    type="number"
                                    name="buffalo_rate"
                                    class="form-control custom-input rate-input"
                                    value="{{ old('buffalo_rate') }}"
                                    step="0.01"
                                    min="0"
                                    placeholder="Example: 62">

                            </div>

                        </div>

                    </div>


                    <div class="rate-note">

                        <i class="bi bi-lightbulb-fill"></i>

                        At least one milk rate is required for the farmer.

                    </div>

                </div>


                {{-- ========================================
                    FORM FOOTER
                ========================================= --}}
                <div class="form-footer">

                    <div class="footer-note">

                        <i class="bi bi-shield-check"></i>

                        Farmer account will be created securely.

                    </div>


                    <div class="footer-actions">

                        <a href="{{ route('admin.farmers.index') }}"
                            class="cancel-btn">

                            <i class="bi bi-x-lg"></i>

                            Cancel

                        </a>


                        <button type="submit"
                            class="create-farmer-btn">

                            <i class="bi bi-person-plus-fill"></i>

                            Create Farmer

                        </button>

                    </div>

                </div>


            </form>

        </div>

    </div>

</div>


<style>

/* ========================================
   FARMER HEADER
======================================== */

.farmer-header {

    background: linear-gradient(
        135deg,
        #06264A 0%,
        #0b4960 55%,
        #116b72 100%
    );

    border-radius: 20px;

    padding: 32px 34px;

    color: white;

    box-shadow:
        0 10px 30px rgba(6, 38, 74, 0.15);

    overflow: hidden;

    position: relative;
}

.farmer-header::after {

    content: "";

    position: absolute;

    width: 220px;
    height: 220px;

    right: -70px;
    top: -80px;

    background: rgba(255, 255, 255, 0.06);

    border-radius: 50%;
}

.farmer-header-content {

    display: flex;

    align-items: center;

    justify-content: space-between;

    position: relative;

    z-index: 1;
}

.farmer-header-label {

    font-size: 14px;

    font-weight: 600;

    letter-spacing: 0.6px;

    color: rgba(255, 255, 255, 0.75);

    margin-bottom: 8px;
}

.farmer-header-label i {

    margin-right: 6px;
}

.farmer-header h1 {

    margin: 0 0 6px;

    font-size: 32px;

    font-weight: 700;

    color: #ffffff;
}

.farmer-header p {

    margin: 0;

    font-size: 16px;

    color: rgba(255, 255, 255, 0.75);
}

.farmer-header-icon {

    width: 76px;
    height: 76px;

    display: flex;

    align-items: center;
    justify-content: center;

    border: 2px solid rgba(255, 255, 255, 0.35);

    border-radius: 18px;

    color: rgba(255, 255, 255, 0.85);

    font-size: 36px;

    margin-right: 10px;
}


/* ========================================
   ERROR
======================================== */

.farmer-error-card {

    display: flex;

    gap: 14px;

    padding: 17px 20px;

    background: #fff5f5;

    border: 1px solid #f5c2c7;

    border-radius: 14px;

    color: #842029;

}

.farmer-error-icon {

    font-size: 20px;

    padding-top: 2px;
}

.farmer-error-card strong {

    font-size: 14px;
}

.farmer-error-card li {

    font-size: 13px;

    margin-top: 3px;
}


/* ========================================
   FORM CARD
======================================== */

.farmer-form-card {

    background: #ffffff;

    border: 1px solid #e8eeeb;

    border-radius: 20px;

    box-shadow:
        0 8px 30px rgba(17, 24, 39, 0.06);

    overflow: hidden;
}

.farmer-form-header {

    padding: 23px 28px;

    border-bottom: 1px solid #edf1ef;

    background: #fbfdfc;
}

.farmer-form-title {

    display: flex;

    align-items: center;

    gap: 14px;
}

.farmer-title-icon {

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

.farmer-form-header h4 {

    margin: 0;

    font-size: 19px;

    font-weight: 700;

    color: #172033;
}

.farmer-form-header p {

    margin: 3px 0 0;

    color: #667085;

    font-size: 13px;
}

.farmer-form-body {

    padding: 28px;
}


/* ========================================
   FORM SECTION
======================================== */

.form-section {

    padding-bottom: 28px;
}

.form-section-heading {

    display: flex;

    align-items: center;

    gap: 8px;

    margin-bottom: 20px;

    color: #344054;

    font-size: 15px;

    font-weight: 700;
}

.form-section-heading i {

    color: #198754;

    font-size: 17px;
}


/* ========================================
   LABELS / INPUTS
======================================== */

.custom-label {

    display: block;

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

    font-size: 12px;

    font-weight: 400;
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

    box-shadow:
        0 0 0 3px rgba(25, 135, 84, 0.10);
}

textarea.custom-input {

    min-height: auto;

    resize: vertical;
}

.form-help {

    margin-top: 6px;

    color: #7a8b82;

    font-size: 11px;
}

.form-help i {

    color: #198754;

    margin-right: 3px;
}


/* ========================================
   RATES
======================================== */

.rates-section {

    padding: 22px;

    border-radius: 16px;

    background: #f5faf7;

    border: 1px solid #dfeee6;

    margin-top: 4px;
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
}

.rate-note {

    margin-top: 18px;

    color: #667085;

    font-size: 12px;
}

.rate-note i {

    color: #198754;

    margin-right: 4px;
}


/* ========================================
   FOOTER
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

.footer-actions {

    display: flex;

    gap: 10px;
}

.cancel-btn {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 6px;

    padding: 11px 18px;

    border: 1px solid #d8e0dc;

    border-radius: 10px;

    background: #ffffff;

    color: #475467;

    text-decoration: none;

    font-size: 14px;

    font-weight: 600;

    transition: all 0.2s ease;
}

.cancel-btn:hover {

    background: #f8faf9;

    color: #344054;

    border-color: #c5d0ca;
}

.create-farmer-btn {

    border: 0;

    background: #198754;

    color: #ffffff;

    padding: 11px 20px;

    border-radius: 10px;

    font-size: 14px;

    font-weight: 600;

    box-shadow:
        0 5px 14px rgba(25, 135, 84, 0.20);

    transition: all 0.2s ease;
}

.create-farmer-btn:hover {

    background: #157347;

    transform: translateY(-1px);

    box-shadow:
        0 7px 18px rgba(25, 135, 84, 0.25);
}

.create-farmer-btn i {

    margin-right: 5px;
}


/* ========================================
   RESPONSIVE
======================================== */

@media (max-width: 768px) {

    .farmer-header {

        padding: 25px 22px;
    }

    .farmer-header h1 {

        font-size: 27px;
    }

    .farmer-header p {

        font-size: 14px;
    }

    .farmer-header-icon {

        width: 58px;
        height: 58px;

        font-size: 28px;

        margin-left: 15px;
    }

    .farmer-form-header,
    .farmer-form-body {

        padding: 20px;
    }

    .rates-section {

        padding: 18px;
    }

    .form-footer {

        align-items: stretch;

        flex-direction: column;
    }

    .footer-actions {

        width: 100%;
    }

    .cancel-btn,
    .create-farmer-btn {

        flex: 1;
    }

}

@media (max-width: 576px) {

    .container.py-5 {

        padding-top: 25px !important;
    }

    .farmer-header {

        border-radius: 16px;
    }

    .farmer-header-icon {

        display: none;
    }

    .farmer-form-card {

        border-radius: 16px;
    }

    .footer-actions {

        flex-direction: column;
    }

    .cancel-btn,
    .create-farmer-btn {

        width: 100%;
    }

}

</style>

@endsection
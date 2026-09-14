@extends('layouts.portal')

@section('title', 'Edit Farmer | Gourik Admin')

@section('content')

<style>
    .edit-farmer-page {
        background: #f6f9f7;
        min-height: calc(100vh - 70px);
    }

    .edit-card {
        border: 0;
        border-radius: 20px;
        overflow: hidden;
    }

    .edit-header {
        background: linear-gradient(135deg, #06264A 0%, #0b3b6f 100%);
        color: white;
        padding: 28px;
    }

    .farmer-avatar {
        width: 54px;
        height: 54px;
        border-radius: 15px;
        background: rgba(255,255,255,0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .section-box {
        background: #f8faf9;
        border: 1px solid #e8eeeb;
        border-radius: 15px;
        padding: 20px;
    }

    .rate-box {
        border: 1px solid #dfe9e3;
        border-radius: 14px;
        padding: 18px;
        background: white;
    }

    .rate-icon {
        width: 42px;
        height: 42px;
        border-radius: 11px;
        background: #e5f5ed;
        color: #198754;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .form-control,
    .form-select {
        border-radius: 10px;
        padding: 10px 13px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.2rem rgba(25,135,84,.12);
    }

    .farmer-id-box {
        background: #eef6f1;
        color: #198754;
        padding: 7px 11px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
    }

    @media (max-width: 767px) {
        .edit-header {
            padding: 22px;
        }

        .edit-card .card-body {
            padding: 20px !important;
        }
    }
</style>


<div class="edit-farmer-page">

    <div class="container py-4 py-lg-5">

        {{-- Page Header --}}

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <a href="{{ route('admin.farmers.index') }}"
                   class="text-decoration-none text-success small">

                    <i class="bi bi-arrow-left me-1"></i>
                    Back to Farmers

                </a>

                <h1 class="fw-bold mt-2 mb-1">
                    Edit Farmer
                </h1>

                <p class="text-muted mb-0">
                    Update farmer information and milk rates.
                </p>

            </div>

        </div>


        {{-- Validation Errors --}}

        @if ($errors->any())

            <div class="alert alert-danger border-0 shadow-sm">

                <strong>Please fix the following:</strong>

                <ul class="mb-0 mt-2">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <div class="card edit-card shadow-sm">

            {{-- Header --}}

            <div class="edit-header">

                <div class="d-flex align-items-center gap-3">

                    <div class="farmer-avatar">

                        <i class="bi bi-person-fill"></i>

                    </div>

                    <div>

                        <h4 class="fw-bold mb-1">
                            {{ $farmer->user->name }}
                        </h4>

                        <span class="farmer-id-box">
                            {{ $farmer->farmer_id }}
                        </span>

                    </div>

                </div>

            </div>


            <div class="card-body p-4 p-lg-5">

                <form method="POST"
                      action="{{ route('admin.farmers.update', $farmer) }}">

                    @csrf
                    @method('PUT')


                    {{-- ================= PERSONAL INFORMATION ================= --}}

                    <div class="section-box mb-4">

                        <div class="mb-4">

                            <h5 class="fw-bold mb-1">
                                Farmer Information
                            </h5>

                            <p class="text-muted small mb-0">
                                Update the farmer's basic details.
                            </p>

                        </div>


                        <div class="row g-3">

                            {{-- Name --}}

                            <div class="col-md-6">

                                <label for="name"
                                       class="form-label fw-semibold">

                                    Farmer Name

                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control"
                                    value="{{ old('name', $farmer->user->name) }}"
                                    required
                                >

                            </div>


                            {{-- Farmer ID --}}

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Farmer ID
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ $farmer->farmer_id }}"
                                    disabled
                                >

                                <div class="form-text">
                                    Farmer ID cannot be changed.
                                </div>

                            </div>


                            {{-- Phone --}}

                            <div class="col-md-6">

                                <label for="phone"
                                       class="form-label fw-semibold">

                                    Phone

                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    id="phone"
                                    class="form-control"
                                    value="{{ old('phone', $farmer->phone) }}"
                                    placeholder="Enter phone number"
                                >

                            </div>


                            {{-- Status --}}

                            <div class="col-md-6">

                                <label for="status"
                                       class="form-label fw-semibold">

                                    Status

                                </label>

                                <select
                                    name="status"
                                    id="status"
                                    class="form-select"
                                    required
                                >

                                    <option value="1"
                                        {{ old('status', $farmer->status) == 1 ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="0"
                                        {{ old('status', $farmer->status) == 0 ? 'selected' : '' }}>
                                        Disabled
                                    </option>

                                </select>

                            </div>


                            {{-- Address --}}

                            <div class="col-12">

                                <label for="address"
                                       class="form-label fw-semibold">

                                    Address

                                </label>

                                <textarea
                                    name="address"
                                    id="address"
                                    rows="3"
                                    class="form-control"
                                    placeholder="Enter farmer address"
                                >{{ old('address', $farmer->address) }}</textarea>

                            </div>

                        </div>

                    </div>


                    {{-- ================= MILK RATES ================= --}}

                    <div class="section-box mb-4">

                        <div class="mb-4">

                            <h5 class="fw-bold mb-1">

                                <i class="bi bi-currency-rupee text-success me-1"></i>

                                Milk Rates

                            </h5>

                            <p class="text-muted small mb-0">

                                These rates will automatically appear
                                when recording new milk collection.

                            </p>

                        </div>


                        <div class="row g-3">

                            {{-- Cow Rate --}}

                            <div class="col-md-6">

                                <div class="rate-box h-100">

                                    <div class="d-flex align-items-center gap-3 mb-3">

                                        <div class="rate-icon">

                                            <i class="bi bi-droplet-fill"></i>

                                        </div>

                                        <div>

                                            <div class="fw-bold">
                                                Cow Milk
                                            </div>

                                            <small class="text-muted">
                                                Rate per litre
                                            </small>

                                        </div>

                                    </div>


                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₹
                                        </span>

                                        <input
                                            type="number"
                                            name="cow_rate"
                                            id="cow_rate"
                                            class="form-control"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('cow_rate', $farmer->cow_rate) }}"
                                            placeholder="0.00"
                                        >

                                        <span class="input-group-text">
                                            / L
                                        </span>

                                    </div>

                                </div>

                            </div>


                            {{-- Buffalo Rate --}}

                            <div class="col-md-6">

                                <div class="rate-box h-100">

                                    <div class="d-flex align-items-center gap-3 mb-3">

                                        <div class="rate-icon">

                                            <i class="bi bi-droplet-fill"></i>

                                        </div>

                                        <div>

                                            <div class="fw-bold">
                                                Buffalo Milk
                                            </div>

                                            <small class="text-muted">
                                                Rate per litre
                                            </small>

                                        </div>

                                    </div>


                                    <div class="input-group">

                                        <span class="input-group-text">
                                            ₹
                                        </span>

                                        <input
                                            type="number"
                                            name="buffalo_rate"
                                            id="buffalo_rate"
                                            class="form-control"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('buffalo_rate', $farmer->buffalo_rate) }}"
                                            placeholder="0.00"
                                        >

                                        <span class="input-group-text">
                                            / L
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- ================= BUTTONS ================= --}}

                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-2">

                        <a href="{{ route('admin.farmers.index') }}"
                           class="btn btn-outline-secondary px-4">

                            <i class="bi bi-x-lg me-1"></i>
                            Cancel

                        </a>

                        <button type="submit"
                                class="btn btn-success px-4">

                            <i class="bi bi-check-lg me-1"></i>
                            Update Farmer

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
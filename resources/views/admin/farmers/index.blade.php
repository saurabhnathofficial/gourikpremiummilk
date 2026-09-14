@extends('layouts.portal')

@section('title', 'Farmers | Gourik Admin')

@section('content')

<div class="container py-5">

    {{-- ========================================
        PREMIUM HEADER
    ========================================= --}}
    <div class="farmers-header mb-3">

        <div class="farmers-header-content">

            <div>

                <div class="farmers-header-label">
                    <i class="bi bi-people-fill"></i>
                    FARMER MANAGEMENT
                </div>

                <h1>Farmers</h1>

                <p>
                    Manage Gourik farmers and their accounts.
                </p>

            </div>

            <div class="farmers-header-icon">
                <i class="bi bi-people-fill"></i>
            </div>

        </div>

    </div>


    {{-- ========================================
        ADD FARMER ACTION
    ========================================= --}}
    <div class="farmer-action-bar mb-4">

        <div>

            <strong>
                Farmer Accounts
            </strong>

            <span>
                Manage farmer details, rates and account status.
            </span>

        </div>

        <a href="{{ route('admin.farmers.create') }}"
            class="add-farmer-btn">

            <i class="bi bi-person-plus-fill"></i>

            Add Farmer

        </a>

    </div>


    {{-- ========================================
        SUCCESS MESSAGE
    ========================================= --}}
    @if(session('success'))

        <div class="farmer-success-alert mb-4">

            <i class="bi bi-check-circle-fill"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- ========================================
        FARMERS TABLE
    ========================================= --}}
    <div class="farmers-table-card">

        <div class="farmers-table-header">

            <div>

                <h4>
                    <i class="bi bi-person-lines-fill"></i>
                    Farmer List
                </h4>

                <p>
                    All registered Gourik farmers
                </p>

            </div>

            <div class="farmer-count">

                <i class="bi bi-people-fill"></i>

                {{ $farmers->count() }}

                <span>
                    {{ $farmers->count() == 1 ? 'Farmer' : 'Farmers' }}
                </span>

            </div>

        </div>


        <div class="table-responsive">

            <table class="table farmers-table align-middle mb-0">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Farmer</th>

                        <th>Farmer ID</th>

                        <th>Phone</th>

                        <th>Cow Rate</th>

                        <th>Buffalo Rate</th>

                        <th>Status</th>

                        <th class="text-end">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($farmers as $farmer)

                    <tr>

                        {{-- Number --}}
                        <td>

                            <span class="row-number">
                                {{ $loop->iteration }}
                            </span>

                        </td>


                        {{-- Farmer --}}
                        <td>

                            <div class="farmer-info">

                                <div class="farmer-avatar">
                                    <i class="bi bi-person-fill"></i>
                                </div>

                                <div>

                                    <strong>
                                        {{ $farmer->user->name }}
                                    </strong>

                                    <small>
                                        Farmer Account
                                    </small>

                                </div>

                            </div>

                        </td>


                        {{-- Farmer ID --}}
                        <td>

                            <span class="farmer-id-badge">
                                {{ $farmer->farmer_id }}
                            </span>

                        </td>


                        {{-- Phone --}}
                        <td>

                            @if($farmer->phone)

                                <span class="phone-value">

                                    <i class="bi bi-telephone-fill"></i>

                                    {{ $farmer->phone }}

                                </span>

                            @else

                                <span class="text-muted">
                                    —
                                </span>

                            @endif

                        </td>


                        {{-- Cow Rate --}}
                        <td>

                            <div class="rate-value">

                                <span>₹</span>

                                {{ number_format($farmer->cow_rate, 2) }}

                                <small>/L</small>

                            </div>

                        </td>


                        {{-- Buffalo Rate --}}
                        <td>

                            <div class="rate-value">

                                <span>₹</span>

                                {{ number_format($farmer->buffalo_rate, 2) }}

                                <small>/L</small>

                            </div>

                        </td>


                        {{-- Status --}}
                        <td>

                            @if($farmer->status)

                                <span class="status-badge active-status">

                                    <span class="status-dot"></span>

                                    Active

                                </span>

                            @else

                                <span class="status-badge disabled-status">

                                    <span class="status-dot"></span>

                                    Disabled

                                </span>

                            @endif

                        </td>


                        {{-- Action --}}
                        <td class="text-end">

                            <a href="{{ route('admin.farmers.edit', $farmer) }}"
                                class="edit-farmer-btn">

                                <i class="bi bi-pencil-square"></i>

                                Edit

                            </a>

                        </td>

                    </tr>


                    @empty

                    <tr>

                        <td colspan="8">

                            <div class="empty-farmers">

                                <div class="empty-icon">
                                    <i class="bi bi-people"></i>
                                </div>

                                <h5>
                                    No Farmers Yet
                                </h5>

                                <p>
                                    Start by adding your first farmer account.
                                </p>

                                <a href="{{ route('admin.farmers.create') }}"
                                    class="add-farmer-btn">

                                    <i class="bi bi-person-plus-fill"></i>

                                    Add First Farmer

                                </a>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


<style>

/* ========================================
   FARMERS HEADER
======================================== */

.farmers-header {

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

.farmers-header::after {

    content: "";

    position: absolute;

    width: 220px;
    height: 220px;

    right: -70px;
    top: -80px;

    background: rgba(255, 255, 255, 0.06);

    border-radius: 50%;
}

.farmers-header-content {

    display: flex;

    align-items: center;

    justify-content: space-between;

    position: relative;

    z-index: 1;
}

.farmers-header-label {

    font-size: 14px;

    font-weight: 600;

    letter-spacing: 0.6px;

    color: rgba(255, 255, 255, 0.75);

    margin-bottom: 8px;
}

.farmers-header-label i {

    margin-right: 6px;
}

.farmers-header h1 {

    margin: 0 0 6px;

    font-size: 32px;

    font-weight: 700;

    color: #ffffff;
}

.farmers-header p {

    margin: 0;

    font-size: 16px;

    color: rgba(255, 255, 255, 0.75);
}

.farmers-header-icon {

    width: 76px;
    height: 76px;

    display: flex;

    align-items: center;
    justify-content: center;

    border: 2px solid rgba(255, 255, 255, 0.35);

    border-radius: 18px;

    color: rgba(255, 255, 255, 0.85);

    font-size: 34px;

    margin-right: 10px;
}


/* ========================================
   ACTION BAR
======================================== */

.farmer-action-bar {

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 15px 18px;

    background: #ffffff;

    border: 1px solid #e8eeeb;

    border-radius: 14px;

    box-shadow:
        0 4px 15px rgba(17, 24, 39, 0.04);
}

.farmer-action-bar strong {

    display: block;

    color: #172033;

    font-size: 14px;
}

.farmer-action-bar span {

    display: block;

    color: #98a2b3;

    font-size: 12px;

    margin-top: 2px;
}

.add-farmer-btn {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 7px;

    padding: 10px 17px;

    border-radius: 10px;

    background: #198754;

    color: #ffffff;

    text-decoration: none;

    border: 0;

    font-size: 13px;

    font-weight: 600;

    box-shadow:
        0 5px 14px rgba(25, 135, 84, 0.18);

    transition: all 0.2s ease;
}

.add-farmer-btn:hover {

    background: #157347;

    color: #ffffff;

    transform: translateY(-1px);

    box-shadow:
        0 7px 18px rgba(25, 135, 84, 0.24);
}


/* ========================================
   SUCCESS
======================================== */

.farmer-success-alert {

    display: flex;

    align-items: center;

    gap: 10px;

    padding: 13px 17px;

    background: #eaf7f0;

    border: 1px solid #bce3cd;

    border-radius: 12px;

    color: #146c43;

    font-size: 13px;
}

.farmer-success-alert i {

    font-size: 18px;
}


/* ========================================
   TABLE CARD
======================================== */

.farmers-table-card {

    background: #ffffff;

    border: 1px solid #e8eeeb;

    border-radius: 20px;

    overflow: hidden;

    box-shadow:
        0 8px 30px rgba(17, 24, 39, 0.06);
}

.farmers-table-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 21px 24px;

    border-bottom: 1px solid #edf1ef;

    background: #fbfdfc;
}

.farmers-table-header h4 {

    margin: 0;

    font-size: 17px;

    font-weight: 700;

    color: #172033;
}

.farmers-table-header h4 i {

    color: #198754;

    margin-right: 7px;
}

.farmers-table-header p {

    margin: 3px 0 0;

    color: #98a2b3;

    font-size: 12px;
}

.farmer-count {

    display: flex;

    align-items: center;

    gap: 5px;

    padding: 7px 11px;

    border-radius: 9px;

    background: #eaf6f0;

    color: #198754;

    font-size: 13px;

    font-weight: 700;
}

.farmer-count span {

    font-weight: 500;

    color: #667085;
}


/* ========================================
   TABLE
======================================== */

.farmers-table {

    min-width: 1000px;
}

.farmers-table thead th {

    padding: 14px 16px;

    background: #f7faf8;

    border-bottom: 1px solid #e5ebe7;

    color: #667085;

    font-size: 11px;

    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: 0.4px;

    white-space: nowrap;
}

.farmers-table tbody td {

    padding: 15px 16px;

    border-bottom: 1px solid #f0f3f1;

    color: #344054;

    font-size: 13px;
}

.farmers-table tbody tr {

    transition: background 0.2s ease;
}

.farmers-table tbody tr:hover {

    background: #fbfdfc;
}

.farmers-table tbody tr:last-child td {

    border-bottom: 0;
}


/* ========================================
   ROW NUMBER
======================================== */

.row-number {

    display: inline-flex;

    width: 28px;
    height: 28px;

    align-items: center;
    justify-content: center;

    border-radius: 8px;

    background: #f1f5f3;

    color: #667085;

    font-size: 12px;

    font-weight: 600;
}


/* ========================================
   FARMER
======================================== */

.farmer-info {

    display: flex;

    align-items: center;

    gap: 10px;
}

.farmer-avatar {

    width: 38px;
    height: 38px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #eaf6f0;

    color: #198754;

    font-size: 17px;
}

.farmer-info strong {

    display: block;

    color: #172033;

    font-size: 13px;
}

.farmer-info small {

    display: block;

    margin-top: 2px;

    color: #98a2b3;

    font-size: 10px;
}


/* ========================================
   FARMER ID
======================================== */

.farmer-id-badge {

    display: inline-block;

    padding: 5px 9px;

    border-radius: 7px;

    background: #f1f5f3;

    color: #344054;

    font-size: 12px;

    font-weight: 600;
}


/* ========================================
   PHONE
======================================== */

.phone-value {

    display: inline-flex;

    align-items: center;

    gap: 5px;

    color: #475467;

}

.phone-value i {

    color: #198754;

    font-size: 11px;
}


/* ========================================
   RATES
======================================== */

.rate-value {

    color: #172033;

    font-weight: 600;

    white-space: nowrap;
}

.rate-value > span {

    color: #198754;

    font-weight: 700;

}

.rate-value small {

    color: #98a2b3;

    font-size: 10px;

    font-weight: 500;
}


/* ========================================
   STATUS
======================================== */

.status-badge {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 5px 9px;

    border-radius: 20px;

    font-size: 11px;

    font-weight: 600;
}

.active-status {

    background: #e8f6ee;

    color: #157347;
}

.disabled-status {

    background: #f1f3f4;

    color: #667085;
}

.status-dot {

    width: 6px;
    height: 6px;

    border-radius: 50%;

    background: currentColor;
}


/* ========================================
   EDIT
======================================== */

.edit-farmer-btn {

    display: inline-flex;

    align-items: center;

    gap: 5px;

    padding: 7px 11px;

    border: 1px solid #cfe3d8;

    border-radius: 8px;

    background: #ffffff;

    color: #198754;

    text-decoration: none;

    font-size: 12px;

    font-weight: 600;

    transition: all 0.2s ease;
}

.edit-farmer-btn:hover {

    background: #198754;

    color: #ffffff;

    border-color: #198754;
}


/* ========================================
   EMPTY
======================================== */

.empty-farmers {

    display: flex;

    align-items: center;

    flex-direction: column;

    justify-content: center;

    padding: 55px 20px;

    text-align: center;
}

.empty-icon {

    width: 64px;
    height: 64px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 16px;

    background: #eaf6f0;

    color: #198754;

    font-size: 28px;

    margin-bottom: 15px;
}

.empty-farmers h5 {

    margin: 0;

    color: #344054;

    font-size: 16px;
}

.empty-farmers p {

    margin: 5px 0 18px;

    color: #98a2b3;

    font-size: 13px;
}


/* ========================================
   RESPONSIVE
======================================== */

@media (max-width: 768px) {

    .farmers-header {

        padding: 25px 22px;
    }

    .farmers-header h1 {

        font-size: 27px;
    }

    .farmers-header p {

        font-size: 14px;
    }

    .farmers-header-icon {

        width: 58px;
        height: 58px;

        font-size: 27px;
    }

    .farmer-action-bar {

        align-items: stretch;

        flex-direction: column;

        gap: 13px;
    }

    .add-farmer-btn {

        width: 100%;
    }

    .farmers-table-header {

        padding: 18px;
    }

}

@media (max-width: 576px) {

    .container.py-5 {

        padding-top: 25px !important;
    }

    .farmers-header {

        border-radius: 16px;
    }

    .farmers-header-icon {

        display: none;
    }

    .farmers-table-card {

        border-radius: 16px;
    }

}

</style>

@endsection
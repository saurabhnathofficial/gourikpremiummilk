@extends('layouts.portal')

@section('title', 'Edit Milk Entry | Gourik Admin')

@section('content')

<div class="container py-5">

    <div class="mb-4">
        <h1 class="mb-1">Edit Milk Entry</h1>

        <p class="text-muted mb-0">
            {{ $milkEntry->farmer->farmer_id }}
            - {{ $milkEntry->farmer->user->name }}
        </p>
    </div>

    @if ($errors->any())

        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif

    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form method="POST"
                  action="{{ route('admin.milk.update', $milkEntry) }}">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Date
                        </label>

                        <input
                            type="date"
                            name="entry_date"
                            class="form-control"
                            value="{{ $milkEntry->entry_date->format('Y-m-d') }}"
                            required
                        >

                    </div>

                </div>

                <hr class="my-4">

                <h5 class="mb-3">Cow Milk</h5>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Morning (Litres)
                        </label>

                        <input
                            type="number"
                            name="cow_morning"
                            class="form-control"
                            step="0.01"
                            min="0"
                            value="{{ $milkEntry->cow_morning }}"
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Evening (Litres)
                        </label>

                        <input
                            type="number"
                            name="cow_evening"
                            class="form-control"
                            step="0.01"
                            min="0"
                            value="{{ $milkEntry->cow_evening }}"
                        >

                    </div>

                </div>

                <h5 class="mb-3 mt-3">Buffalo Milk</h5>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Morning (Litres)
                        </label>

                        <input
                            type="number"
                            name="buffalo_morning"
                            class="form-control"
                            step="0.01"
                            min="0"
                            value="{{ $milkEntry->buffalo_morning }}"
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Evening (Litres)
                        </label>

                        <input
                            type="number"
                            name="buffalo_evening"
                            class="form-control"
                            step="0.01"
                            min="0"
                            value="{{ $milkEntry->buffalo_evening }}"
                        >

                    </div>

                </div>

                <div class="mt-4">

                    <button type="submit"
                            class="btn btn-success">

                        <i class="bi bi-check-lg"></i>
                        Update Entry

                    </button>

                    <a href="{{ route('admin.milk.index') }}"
                       class="btn btn-light ms-2">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
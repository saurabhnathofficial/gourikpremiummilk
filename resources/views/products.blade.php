@extends('layouts.app')

@section('title', 'Our Products | Gourik Premium Milk')

@section('content')

    <section class="page-header">
        <div class="container">
            <h1>Our Products</h1>
            <p>Pure and traditional dairy products from trusted farmers.</p>
        </div>
    </section>

    <x-products />

    <x-contact />

    <x-footer />

@endsection
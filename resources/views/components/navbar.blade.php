<!-- Top Information Bar -->
<div class="gourik-topbar">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-4 text-center text-md-start">
                <span>📍 Bhopal, Madhya Pradesh</span>
            </div>

            <div class="col-md-4 text-center d-none d-md-block">
                <span>🚚 Daily Home Delivery</span>
            </div>

            <div class="col-md-4 text-center text-md-end">
                <span>📞 +91 8225003837</span>
            </div>

        </div>
    </div>
</div>


<!-- Main Navbar -->
<nav class="navbar navbar-expand-lg gourik-navbar">

    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand gourik-logo" href="{{ url('/') }}">
            <img
                src="{{ asset('images/gourik_logo.png') }}"
                alt="Gourik Premium Milk"
                class="gourik-logo-image">
        </a>


        <!-- Mobile Toggle -->
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#gourikNavbar"
            aria-controls="gourikNavbar"
            aria-expanded="false"
            aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>


        <!-- Navigation -->
        <div class="collapse navbar-collapse" id="gourikNavbar">

            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                        href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                        href="{{ route('about') }}">
                        About Us
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products') ? 'active' : '' }}"
                        href="{{ route('products') }}">
                        Products
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#farmers">
                        Our Farmers
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#why-choose-us">
                        Why Choose Us
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#reviews">
                        Reviews
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                        href="{{ route('contact') }}">
                        Contact Us
                    </a>
                </li>

            </ul>


            <!-- WhatsApp Button -->
            <a
                href="https://wa.me/918225003837"
                target="_blank"
                class="btn gourik-whatsapp-btn">

                <i class="bi bi-whatsapp"></i> Order on WhatsApp

            </a>

        </div>

    </div>

</nav>
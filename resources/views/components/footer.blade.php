<footer class="gourik-footer">

    {{-- Main Footer --}}
    <div class="container">

        <div class="row g-5">

            {{-- Brand --}}
            <div class="col-lg-4">

                <a href="{{ url('/') }}" class="footer-logo">

                    <img
                        src="{{ asset('images/gourik_logo.png') }}"
                        alt="Gourik Premium Milk"
                    >

                </a>

                <p>
                    At Gourik Premium Milk, we bring you pure,
                    fresh and nutritious dairy products with care.
                    Goodness of nature, delivered to your family.
                </p>

                <div class="footer-social">

<a
    href="https://wa.me/918225003837"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="WhatsApp"
>
    <i class="bi bi-whatsapp"></i>
</a>

<a
    href="https://www.instagram.com/gourikpremiummilk/"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="Instagram"
>
    <i class="bi bi-instagram"></i>
</a>

<a
    href="YOUR_FACEBOOK_URL"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="Facebook"
>
    <i class="bi bi-facebook"></i>
</a>

                </div>

            </div>


            {{-- Quick Links --}}
            <div class="col-6 col-lg-2">

                <h3>Quick Links</h3>

                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{url('/about')}}">About Us</a></li>
                    <li><a href="{{url('/products')}}">Products</a></li>
                    <li><a href="#why-us">Why Choose Us</a></li>
                    <li><a href="#reviews">Reviews</a></li>
                    <li><a href="{{url('/contact')}}">Contact Us</a></li>
                </ul>

            </div>


            {{-- Products --}}
            <div class="col-6 col-lg-2">

                <h3>Our Products</h3>

                <ul>
                    <li><a href="#products">Cow Milk</a></li>
                    <li><a href="#products">Buffalo Milk</a></li>
                    <li><a href="#products">Desi Ghee</a></li>
                    <li><a href="#products">Curd</a></li>
                    <li><a href="#products">Paneer</a></li>
                    <li><a href="#products">Upla</a></li>
                </ul>

            </div>


            {{-- Contact --}}
            <div class="col-lg-4">

                <h3>Contact Us</h3>

                <div class="footer-contact">

                    <p>
                        <i class="bi bi-geo-alt-fill"></i> Bhopal, Madhya Pradesh
                    </p>

                    <p>
                        <i class="bi bi-telephone-fill"></i>
                        <a href="tel:+918225003837">
                            +91 8225003837
                        </a>
                    </p>

                    <p>
                        <i class="bi bi-whatsapp"></i>
                        <a href="https://wa.me/918225003837">
                            WhatsApp Us
                        </a>
                    </p>

                    <p>
                        
                        <a href="mailto:gourikpremiummilk@gmail.com">
                             <i class="bi bi-envelope-fill"></i>
                            Gourikpremiummilk@gmail.com
                        </a>
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- Copyright --}}
    <div class="footer-bottom">

        <div class="container">

            <div class="d-flex flex-column flex-md-row
                        justify-content-between gap-2">

                <span>
                    © {{ date('Y') }} Gourik Premium Milk.
                    All Rights Reserved.
                </span>

                <div>
                    <a href="#">Privacy Policy</a>
                    <span>|</span>
                    <a href="#">Terms & Conditions</a>
                </div>

            </div>

        </div>

    </div>

</footer>
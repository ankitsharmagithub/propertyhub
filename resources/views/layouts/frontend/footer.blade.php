<footer class="site-footer">
    <div class="container-xl">
        <div class="footer-top">
            <div class="footer-brand">
                <a href="index.html" class="brand" style="color:var(--paper);"><span class="brand-mark">A</span>ureate
                    Estates</a>
                <p class="text-white">A premium real estate platform connecting discerning buyers and tenants with
                    exceptional villas, apartments and penthouses.</p>
                <div class="footer-social">
                    <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <div class="footer-col-title">Company</div>
                <ul>
                    <li><a href="about.html">About</a></li>
                    <li><a href="agents.html">Our Team</a></li>
                    <li><a href="about.html">Careers</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <div class="footer-col-title">Properties</div>
                <ul>
                    <li><a href="sale.html">Buy</a></li>
                    <li><a href="rent.html">Rent</a></li>
                    <li><a href="apartments.html">Apartments</a></li>
                    <li><a href="villas.html">Villas</a></li>
                    <li><a href="penthouses.html">Penthouses</a></li>
                    <li><a href="commercial.html">Commercial</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <div class="footer-col-title">Resources</div>
                <ul>
                    <li><a href="blog.html">Property Guide</a></li>
                    <li><a href="blog.html">Investment Guide</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="faq.html">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-col footer-newsletter">
                <div class="footer-col-title">Stay Updated</div>
                <p style="font-size:14px;margin:0;">New listings, market insight, and investment tips — monthly.</p>
                <form data-aureate-form>
                    <input type="email" required placeholder="Your email address" aria-label="Email address">
                    <button type="submit" aria-label="Subscribe"><i class="fa-solid fa-paper-plane"></i></button>
                </form>
                <div class="form-success-aureate" style="margin-top:14px;padding:12px 16px;font-size:13px;">Thanks —
                    you're subscribed.</div>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© <span data-year></span> Aureate Estates. All rights reserved.</span>
            <div class="legal-links">
                <a href="#">Privacy Policy</a><a href="#">Terms &amp; Conditions</a><a href="#">Cookie
                    Policy</a>
            </div>
        </div>
    </div>
</footer>

<!-- ============================= FLOATING ACTIONS ============================= -->
<div class="floating-actions">
    <a href="https://wa.me/911145678900" class="fa-btn wa" aria-label="Chat on WhatsApp"><i
            class="fa-brands fa-whatsapp"></i></a>
    <a href="tel:+911145678900" class="fa-btn call" aria-label="Call us"><i class="fa-solid fa-phone"></i></a>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>


<script>
    $(function() {
        $('.property-carousel').owlCarousel({
            loop: true,
            margin: 15,
            nav: true,
            //  rewind: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            smartSpeed: 700,
            mouseDrag: true,
            touchDrag: true,
            pullDrag: true,
            //  lazyLoad: true,
            navText: [
                '<i class="fa-solid fa-arrow-left"></i>',
                '<i class="fa-solid fa-arrow-right"></i>'
            ],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 3
                }
            }
        });
    });



    $(function() {
        $('.project-carousel').owlCarousel({
            loop: true,
            margin: 15,
            nav: true,
            //  rewind: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            smartSpeed: 700,
            mouseDrag: true,
            touchDrag: true,
            // pullDrag: true,
            //  lazyLoad: true,
            navText: [
                '<i class="fa-solid fa-arrow-left"></i>',
                '<i class="fa-solid fa-arrow-right"></i>'
            ],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 3
                }
            }
        });
    });




    $(function() {
        $('.builder-carousel').owlCarousel({
            loop: true,
            margin: 15,
            nav: true,
            //  rewind: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            smartSpeed: 700,
            mouseDrag: true,
            touchDrag: true,
            // pullDrag: true,
            //  lazyLoad: true,
            navText: [
                '<i class="fa-solid fa-arrow-left"></i>',
                '<i class="fa-solid fa-arrow-right"></i>'
            ],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        });
    });



    $(function() {
        $('.latestpro-carousel').owlCarousel({
            loop: true,
            margin: 15,
            nav: true,
            //  rewind: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            smartSpeed: 700,
            mouseDrag: true,
            touchDrag: true,
            // pullDrag: true,
            //  lazyLoad: true,
            navText: [
                '<i class="fa-solid fa-arrow-left"></i>',
                '<i class="fa-solid fa-arrow-right"></i>'
            ],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        });
    });


    $(function() {
        $('.testimonial-carousel').owlCarousel({
            loop: true,
            margin: 15,
            nav: false,
            //  rewind: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            smartSpeed: 700,
            mouseDrag: true,
            touchDrag: true,
            // pullDrag: true,
            //  lazyLoad: true,
            navText: [
                '<i class="fa-solid fa-arrow-left"></i>',
                '<i class="fa-solid fa-arrow-right"></i>'
            ],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 1
                },
                992: {
                    items: 2
                },
                1200: {
                    items: 3
                }
            }
        });
    });
</script>

</body>

</html>



<!-- <footer class="border-top mt-5">

    <div class="container py-4">

        <div class="row">

            <div class="col-md-6">

                <h5 class="fw-bold">
                    Property Portal
                </h5>

                <p class="text-muted mb-0">
                    Find your perfect property.
                </p>

            </div>

            <div class="col-md-6 text-md-end">

                <p class="text-muted mb-0">
                    &copy; {{ date('Y') }}
                    Property Portal.
                    All rights reserved.
                </p>

            </div>

        </div>

    </div>

</footer> -->

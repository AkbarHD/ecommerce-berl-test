<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Shop</title>
    @include('frontend.partials.head')
</head>

<body>

    <!-- Navbar -->
    @include('frontend.partials.navbar')

    @yield('content')

   @include('frontend.partials.script')

    <!-- Custom Script -->
    <script>
        $(document).ready(function() {
            // Initialize carousel
            $('.carousel').carousel({
                interval: 5000
            });

            // Demo toggle for showing logged in/out state
            $('.btn-login').click(function(e) {
                e.preventDefault();
                $(this).addClass('d-none');
                $('.user-dropdown').removeClass('d-none');
                $('.cart-icon-wrapper').removeClass('d-none');
            });

            // Demo toggle for logout
            $('.dropdown-item:contains("Logout")').click(function(e) {
                e.preventDefault();
                $('.user-dropdown').addClass('d-none');
                $('.cart-icon-wrapper').addClass('d-none');
                $('.btn-login').removeClass('d-none');
            });

            // Cart icon hover effect
            $('.cart-icon').hover(
                function() {
                    $(this).find('i').addClass('fa-shake');
                },
                function() {
                    $(this).find('i').removeClass('fa-shake');
                }
            );

            // Add to cart button click
            $('.btn-cart').click(function() {
                var currentItems = parseInt($('.cart-badge').text());
                $('.cart-badge').text(currentItems + 1);

                // If user is logged in, show animation
                if (!$('.user-dropdown').hasClass('d-none')) {
                    $('.cart-badge').addClass('animate__animated animate__rubberBand');
                    setTimeout(function() {
                        $('.cart-badge').removeClass('animate__animated animate__rubberBand');
                    }, 1000);
                } else {
                    // Prompt login
                    alert('Silahkan login terlebih dahulu untuk menambahkan item ke keranjang.');
                }
            });
        });
    </script>
</body>

</html>

<section class="container clearfix">
    <div class="grid_12">
        <div class="wrapper grid3">

            <article class="col">
                <div class="footer-nav">
                    <a id="footer-btn" href="misc/faq.php">FAQ</a>
                    <div id="footer-btn-bullet"></div>
                    <a id="footer-btn" href="misc/terms.php">TERMS</a>
                    <div id="footer-btn-bullet"></div>
                    <a id="footer-btn" href="misc/privacy-policy.php">PRIVACY POLICY</a>
                </div>
            </article>

            <article class="col3"
                     style=" width:38%; font-size:11px; color:#333; margin-top:20px; letter-spacing:1px; font-family:Georgia, 'Times New Roman', Times, serif; font-weight:bold;">
                MYDM : Inspiring handcraft patterns created for your everyday life
            </article>

            <article class="col4" style="width:24%;">
                <div class="contain">
                    <div class="cont">
                        <ul>
                            <li><a href="https://www.facebook.com/MYDM.ME" target="_blank"><img
                                        src="/store/images/bullet-fb.svg"></a></li>
                            <li><a href="https://www.instagram.com/mydm.me" target="_blank"><img
                                        src="/store/images/bullet-insta.svg"></a></li>
                            <li><a href="https://www.pinterest.com/mydmme" target="_blank"><img
                                        src="/store/images/bullet-pin.svg"></a></li>
                        </ul>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
<footer>
    <div class="container clearfix">
        <div class="grid_12" style="margin:0 !important;">
            <div class="cpr">© 2015 MYDM Co., Ltd.</div>
        </div>
    </div>
</footer>


<script>
    $(document).ready(function () {
        $('nav').before('<div id="smartbutton"></div>');
        $('#smartbutton').append('<div class="buttonline"></div>');
        $('#smartbutton').append('<div class="buttonline"></div>');
        $('#smartbutton').append('<div class="buttonline"></div>');

        // add click listener
        $('#smartbutton').click(function (event) {
            $('nav').animate({height: 'toggle'}, 200);
        });
    });
</script>
<script>
    $(window).on("scroll", function () {
        if ($(window).scrollTop() > 50) {
            $(".header").addClass("active");
        } else {
            //remove the background property so it comes transparent again (defined in your css)
            $(".header").removeClass("active");
        }
    });

</script>

<script>
    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $('header').outerHeight();

    $(window).scroll(function (event) {
        didScroll = true;
    });

    setInterval(function () {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 250);

    function hasScrolled() {
        var st = $(this).scrollTop();

        // Make sure they scroll more than delta
        if (Math.abs(lastScrollTop - st) <= delta)
            return;

        // If they scrolled down and are past the navbar, add class .nav-up.
        // This is necessary so you never see what is "behind" the navbar.
        if (st > lastScrollTop && st > navbarHeight) {
            // Scroll Down
            $('header').removeClass('header').addClass('nav-up');
        } else {
            // Scroll Up
            if (st + $(window).height() < $(document).height()) {
                $('header').removeClass('nav-up').addClass('header');
            }
        }

        lastScrollTop = st;
    }
//        $(function () {
//
//            $('#st-accordion').accordion();
//
//        });
</script>
<script src="/store/shops/js/jquery.light-carousel.js"></script>
<script>
    $('.gallcontainer').lightCarousel();
</script>
</body>
</html>
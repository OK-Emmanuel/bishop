<!-- footer -->
    <footer class="footer py-md-5 pt-md-3 pb-sm-5" data-aos-duration="1800">
        <div class="container-fluid">
            <div class="row p-sm-4 px-3 py-5">
                <div class="col-lg-4 col-md-6 footer-top mt-md-0 mt-sm-5">
                    <h2>
                        <a class="navbar-brand" href="index.php">
                            Bishop Oyedola
                        </a>
                    </h2>
                   <p class="text-white">My heartbeat is to bring people together in worship to glorify God. Win souls for God
                    on a daily basis and reach out to ministers and empower the less privileged among ministers
                    </p>
                </div>
                <div class="col-lg-2  col-md-6 mt-md-0 mt-5">
                    <div class="footerv2-w3ls">
                        <h3 class="mb-3 w3f_title">Navigation</h3>
                        <hr>
                        <ul class="list-w3pvtits">
                            <li>
                                <a href="index.php">
                                    Home
                                </a>
                            </li>
                            <li class="my-2">
                                <a href="about.php">
                                    About Me
                                </a>
                            </li>
                            <li class="my-2">
                                <a href="blog.php">
                                    Blog
                                </a>
                            </li>
                            
                            <li>
                                <a href="contact.php">
                                    Contact Me
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mt-lg-0 mt-5">
                    <div class="footerv2-w3ls">
                        <h3 class="mb-3 w3f_title">Links</h3>
                        <hr>
                        <ul class="list-w3pvtits">
                            <li>
                                <a href="#about" class="scroll">
                                    Our Mission
                                </a>
                            </li>
                            <li class="my-2">
                                <a href="blog.php">
                                    Latest posts
                                </a>
                            </li>
                            <li class="my-2">
                                <a href="#explore" class="scroll">
                                    Explore
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="contact.php">
                                    Find me
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mt-lg-0 mt-5">
                    <div class="footerv2-w3ls">
                        <h3 class="mb-3 w3f_title">Contact Me</h3>
                        <hr>
                        <div class="fv3-contact">
                            <p>
                                <a href="mailto:example@email.com">info@example.com</a>
                            </p>
                        </div>
                        <div class="fv3-contact my-2">
                            <p>+456 123 7890</p>
                        </div>
                        <div class="fv3-contact">
                            <p>2016 Minesotta
                                <br>Columbus, USA</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- //footer bottom -->
    </footer>
    <!-- //footer -->
    <!-- copyright -->
    <div class="cpy-right text-center bg-theme">
        <p class="text-white">&copy; <?= date('Y'); ?> Bishop O.J. Oyedola  All rights reserved <br>
         Designed by <a href="https://okemmanuel.com">Olawuni Emmanuel K</a> || <a href="https://www.techifice.com">OK Emmanuel.</a>
        </p>
    </div>
    <!-- //copyright -->   
    <!-- js -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- //js -->
    <!-- explore responsive slider -->
    <script src="js/responsiveslides.min.js"></script>
    <script>
        // You can also use "$(window).load(function() {"
        $(function () {
            // Slideshow 4
            $(".slider3").responsiveSlides({
                auto: true,
                pager: true,
                nav: false,
                speed: 500,
                namespace: "callbacks",
                before: function () {
                    $('.events').append("<li>before event fired.</li>");
                },
                after: function () {
                    $('.events').append("<li>after event fired.</li>");
                }
            });

        });
    </script>
    <!-- start-smooth-scrolling -->
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
    <script>
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();

                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>
    <!-- //end-smooth-scrolling -->
    <!-- smooth-scrolling-of-move-up -->
    <script>
        $(document).ready(function () {
            /*
            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear' 
            };
            */
            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <script src="js/SmoothScroll.min.js"></script>
    <!-- //smooth-scrolling-of-move-up -->
    <!-- Bootstrap core JavaScript
        ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Initialize AOS -->
    <script>
      AOS.init();
    </script>
</body>

</html>
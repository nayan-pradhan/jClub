 <!-- Footer -->
    <footer id="footer">
        <div id="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 text-center">
                        <img src="Logo/logowhitetrans.png" width="200">
                        <p class="footer-text">Copyright &copy;2020<br>All rights reserved
                        <div class="credits">
                            Made with <i class="fa fa-heart" style="color: orangered;"></i> by Arnav, Ankit
                            and Nayan
                            </p>
                            <i class="fab fa-facebook fa-lg"></i>
                            <i class="fab fa-instagram fa-lg"></i>
                            <i class="fab fa-twitter fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Javascript and Jquery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>

    <!-- LAX -->
    <script src="https://cdn.jsdelivr.net/npm/lax.js"></script>
    <script>
        window.onload = function () {
            lax.setup() // init

            const updateLax = () => {
                lax.update(window.scrollY)
                window.requestAnimationFrame(updateLax)
            }

            window.requestAnimationFrame(updateLax)
        }
    </script>

    <script>
        function toggleDropdown(e) {
            const _d = $(e.target).closest('.dropdown'),
                _m = $('.dropdown-menu', _d);
            setTimeout(function () {
                const shouldOpen = e.type !== 'click' && _d.is(':hover');
                _m.toggleClass('show', shouldOpen);
                _d.toggleClass('show', shouldOpen);
                $('[data-toggle="dropdown"]', _d).attr('aria-expanded', shouldOpen);
            }, e.type === 'mouseleave' ? 30 : 0);
        }

        $('body')
            .on('mouseenter mouseleave', '.dropdown', toggleDropdown)
            .on('click', '.dropdown-menu a', toggleDropdown);
    </script>

</body>

</html>
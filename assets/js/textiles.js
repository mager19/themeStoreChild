
//Run Functions Theme
(function ($) {

    $(document).ready(function () {
        // new menu
        document.querySelector('#openMenu').addEventListener('click', (e) => {
            e.preventDefault();
            fps_mmenu.open();
        });

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    });

})(jQuery);
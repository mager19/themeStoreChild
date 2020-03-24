
//Run Functions Theme
(function ($) {

    $(document).ready(function () {
        // new menu
        document.querySelector('#openMenu').addEventListener('click', (e) => {
            e.preventDefault();
            fps_mmenu.open();
        });
    });

})(jQuery);
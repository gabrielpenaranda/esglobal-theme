(function ($) {
    "use strict";
    
    
    // Initiate the wowjs
    new WOW().init();
    
    
   // Back to top button
   $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
        $('.back-to-top').fadeIn('slow');
    } else {
        $('.back-to-top').fadeOut('slow');
    }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Stats Counter
    /* $(document).ready(function(){
        $('.counter-value').each(function(){
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
            },{
                duration: 2000,
                easing: 'easeInQuad',
                step: function (now){
                    $(this).text(Math.ceil(now));
                }
            });
        });
    }); */

    document.addEventListener('DOMContentLoaded', function () {
        // Verifica si jQuery está disponible
        if (typeof jQuery === 'undefined') return;

        // Crea el observador
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const $counter = jQuery(entry.target);

                    // Solo anima si aún no se ha animado
                    if (!$counter.hasClass('counter-animated')) {
                        $counter.addClass('counter-animated').prop('Counter', 0).animate({
                            Counter: $counter.text()
                        }, {
                            duration: 2000,
                            easing: 'easeInQuad',
                            step: function (now) {
                                jQuery(this).text(Math.ceil(now));
                            }
                        });
                    }

                    // Deja de observar este elemento (solo se ejecuta una vez)
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.5 // Se activa cuando el 50% del elemento es visible
        });

        // Observa todos los elementos con clase .counter-value
        document.querySelectorAll('.counter-value').forEach(el => {
            observer.observe(el);
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const button = document.getElementById('backToTop');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                button.classList.add('show');
            } else {
                button.classList.remove('show');
            }
        });

        button.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });



})(jQuery);


/*!
    * Start Bootstrap - SB UI Kit Pro v2.0.5 (https://shop.startbootstrap.com/product/sb-ui-kit-pro)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under SEE_LICENSE (https://github.com/BlackrockDigital/sb-ui-kit-pro/blob/master/LICENSE)
    * 
    * * Start Bootstrap - Clean Blog v6.0.9 (https://startbootstrap.com/theme/clean-blog)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-clean-blog/blob/master/LICENSE)
    */
window.addEventListener('DOMContentLoaded', event => {

    
    // Activate feather
    feather.replace();

    // Enable tooltips globally
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Enable popovers globally
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Activate Bootstrap scrollspy for the sticky nav component
    const navStick = document.body.querySelector('#navStick');
    if (navStick) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#navStick',
            offset: 82,
        });
    }

    // Collapse Navbar
    // Add styling fallback for when a transparent background .navbar-marketing is scrolled
    var navbarCollapse = function() {
        const navbarMarketingTransparentFixed = document.body.querySelector('.navbar-marketing.bg-transparent.fixed-top');
        if (!navbarMarketingTransparentFixed) {
            return;
        }
        if (window.scrollY === 0) {
            navbarMarketingTransparentFixed.classList.remove('navbar-scrolled')
        } else {
            navbarMarketingTransparentFixed.classList.add('navbar-scrolled')
        }

    };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    document.addEventListener('scroll', navbarCollapse);

});

let scrollPos = 0;
const mainNav = document.getElementById('mainNav');
const headerHeight = mainNav.clientHeight;
window.addEventListener('scroll', function () {
    const currentTop = document.body.getBoundingClientRect().top * -1;
    if (currentTop < scrollPos) {
        // Scrolling Up
        if (currentTop > 0 && mainNav.classList.contains('is-fixed')) {
            mainNav.classList.add('is-visible');
        } else {
            console.log(123);
            mainNav.classList.remove('is-visible', 'is-fixed');
        }
    } else {
        // Scrolling Down
        mainNav.classList.remove(['is-visible']);
        if (currentTop > headerHeight && !mainNav.classList.contains('is-fixed')) {
            mainNav.classList.add('is-fixed');
        }
    }
    scrollPos = currentTop;
});


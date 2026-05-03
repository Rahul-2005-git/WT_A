// jQuery for Dynamic Tab/Pills Functionality
$(document).ready(function () {
    // ===== Tab Click Handler =====
    $('.pill-btn').on('click', function () {
        let tabId = $(this).data('bs-target');

        // Log which tab is clicked
        console.log('Tab clicked:', tabId);

        // Add active animation
        $(this).closest('.nav-pills').find('.pill-btn').removeClass('animate-active');
        $(this).addClass('animate-active');
    });

    // ===== Tab Show Event =====
    const triggerTabList = document.querySelectorAll('.pill-btn');
    triggerTabList.forEach(triggerEl => {
        const tabTrigger = new bootstrap.Tab(triggerEl);

        triggerEl.addEventListener('show.bs.tab', event => {
            // Animation on tab show
            const target = event.target.getAttribute('data-bs-target');
            console.log('Showing tab:', target);

            // Add fade-in animation to tab content
            $(target).addClass('animated-in');
        });
    });

    // ===== Table Row Hover Effects =====
    $('.table tbody tr').on('mouseenter', function () {
        $(this).find('td').each(function (index) {
            $(this).delay(index * 50).animate({
                paddingLeft: '20px'
            }, 200);
        });
    }).on('mouseleave', function () {
        $(this).find('td').animate({
            paddingLeft: '15px'
        }, 200);
    });

    // ===== Icon Box Animation on Scroll =====
    function animateIconOnScroll() {
        const iconBox = $('.icon-box');
        iconBox.each(function () {
            const elementTop = $(this).offset().top;
            const elementBottom = elementTop + $(this).outerHeight();
            const viewportTop = $(window).scrollTop();
            const viewportBottom = viewportTop + $(window).height();

            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('animate-in');
            }
        });
    }

    $(window).on('scroll', animateIconOnScroll);
    animateIconOnScroll();

    // ===== Smooth Scroll for Pills =====
    $('.pill-btn').on('click', function (e) {
        e.preventDefault();
        const target = $(this).data('bs-target');

        $('html, body').animate({
            scrollTop: $(target).offset().top - 100
        }, 500);
    });

    // ===== Add Counter Animation to Feature List =====
    function animateFeatureList() {
        $('.feature-list li').each(function (index) {
            $(this).css({
                'opacity': '0',
                'transform': 'translateX(-20px)'
            });

            $(this).delay(index * 100).animate({
                'opacity': '1'
            }, 600, function () {
                $(this).css('transform', 'translateX(0)');
            });
        });
    }

    // Animate on tab change
    $('.pill-btn').on('click', function () {
        setTimeout(animateFeatureList, 300);
    });

    animateFeatureList();

    // ===== Badge Animation =====
    function animateBadges() {
        $('.badge').each(function (index) {
            $(this).css({
                'opacity': '0',
                'transform': 'scale(0.8)'
            });

            $(this).delay(index * 80).animate({
                'opacity': '1'
            }, 400, function () {
                $(this).css('transform', 'scale(1)');
            });
        });
    }

    $('.pill-btn').on('click', function () {
        setTimeout(animateBadges, 300);
    });

    animateBadges();

    // ===== Content Card Animation =====
    function animateContentCard() {
        $('.content-card').each(function () {
            $(this).css({
                'opacity': '0',
                'transform': 'translateY(20px)'
            });

            $(this).animate({
                'opacity': '1'
            }, 600, function () {
                $(this).css('transform', 'translateY(0)');
            });
        });
    }

    animateContentCard();

    // ===== Table Animation =====
    function animateTable() {
        $('.table tbody tr').each(function (index) {
            $(this).css({
                'opacity': '0',
                'transform': 'translateY(10px)'
            });

            $(this).delay(index * 80).animate({
                'opacity': '1'
            }, 400, function () {
                $(this).css('transform', 'translateY(0)');
            });
        });
    }

    // Animate table on first load and on tab change
    animateTable();

    $('.pill-btn').on('click', function () {
        setTimeout(animateTable, 300);
    });

    // ===== Active Tab Indicator =====
    function updateActiveTab() {
        let currentScrollTop = $(window).scrollTop();

        // Update active pill based on scroll position (optional feature)
        if (currentScrollTop > 500) {
            // You can add logic here
        }
    }

    $(window).on('scroll', updateActiveTab);

    // ===== Keyboard Navigation =====
    $(document).on('keydown', function (e) {
        let pills = $('.pill-btn');
        let currentActive = $('.pill-btn.active');
        let currentIndex = pills.index(currentActive);

        // Left arrow key
        if (e.keyCode === 37) {
            if (currentIndex > 0) {
                pills.eq(currentIndex - 1).click();
            }
        }
        // Right arrow key
        else if (e.keyCode === 39) {
            if (currentIndex < pills.length - 1) {
                pills.eq(currentIndex + 1).click();
            }
        }
    });

    // ===== Console Logging =====
    console.log('VIT Projects - SDP, EDI, DT, Course initialization complete!');

    // ===== Page Load Animation =====
    $('body').css('opacity', '0').animate({
        'opacity': '1'
    }, 800);
});

// Global utility functions
function toggleTab(tabName) {
    $(tabName).click();
}

function logTabChange(tabName) {
    console.log('Current tab:', tabName);
}

// jQuery Document Ready
$(document).ready(function () {
    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        const target = $(this.getAttribute('href'));
        if (target.length) {
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 70
            }, 1000);
        }
    });

    // Active navbar link on scroll
    $(window).on('scroll', function () {
        let scrollPosition = $(window).scrollTop();

        $('section').each(function () {
            let sectionTop = $(this).offset().top - 100;
            let sectionId = $(this).attr('id');

            if (scrollPosition >= sectionTop) {
                $('.navbar-nav a').removeClass('active');
                $('.navbar-nav a[href="#' + sectionId + '"]').addClass('active');
            }
        });

        // Show/hide navbar shadow on scroll
        if (scrollPosition > 50) {
            $('.navbar').addClass('scrolled');
        } else {
            $('.navbar').removeClass('scrolled');
        }
    });

    // Collapse navbar on link click (mobile)
    $('.navbar-nav a').on('click', function () {
        $('.navbar-collapse').collapse('hide');
    });

    // Animate elements on scroll
    function animateOnScroll() {
        $('.skill-card, .experience-card, .edu-card, .project-card').each(function () {
            let elementTop = $(this).offset().top;
            let elementBottom = elementTop + $(this).outerHeight();
            let viewportTop = $(window).scrollTop();
            let viewportBottom = viewportTop + $(window).height();

            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('fade-in');
            }
        });
    }

    $(window).on('scroll', animateOnScroll);
    animateOnScroll(); // Run on page load

    // Form submission handler
    $('#contactForm').on('submit', function (e) {
        e.preventDefault();

        let $btn = $(this).find('button[type="submit"]');
        let originalText = $btn.text();

        // Show loading state
        $btn.text('Sending...').prop('disabled', true);

        // Simulate form submission (replace with actual backend)
        setTimeout(function () {
            $btn.text('Message Sent!').removeClass('btn-light').addClass('btn-success');

            // Reset form
            $('#contactForm')[0].reset();

            // Reset button after 3 seconds
            setTimeout(function () {
                $btn.text(originalText).prop('disabled', false).removeClass('btn-success').addClass('btn-light');
            }, 3000);
        }, 1500);
    });

    // Video background responsiveness
    function adjustVideoBackground() {
        let $video = $('#bgVideo');
        let windowWidth = $(window).width();
        let windowHeight = $(window).height();

        // Optional: Add fallback or adjust video attributes
        if (windowWidth < 768) {
            // On mobile, you might want to reduce video size
            $video.css('transform', 'scale(1.2)');
        } else {
            $video.css('transform', 'scale(1)');
        }
    }

    $(window).on('resize', adjustVideoBackground);
    adjustVideoBackground();

    // Add fade-in animation to profile image
    $('.profile-img').on('load', function () {
        $(this).fadeIn();
    });

    // Skill cards hover effect
    $('.skill-card').on('mouseenter', function () {
        $(this).find('.skill-icon').animate({ fontSize: '3.5rem' }, 300);
    }).on('mouseleave', function () {
        $(this).find('.skill-icon').animate({ fontSize: '3rem' }, 300);
    });

    // Add scroll progress indicator (optional)
    function updateScrollProgress() {
        let scrollPercentage = ($(window).scrollTop() / ($(document).height() - $(window).height())) * 100;
        // You can use this to update a progress bar if needed
    }

    $(window).on('scroll', updateScrollProgress);

    // Lazy load images if needed
    if ('IntersectionObserver' in window) {
        let imageObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    let img = entry.target;
                    img.src = img.dataset.src;
                    imageObserver.unobserve(img);
                }
            });
        });

        $('img[data-src]').each(function () {
            imageObserver.observe(this);
        });
    }

    // Print CV functionality
    $(document).on('keydown', function (e) {
        // Ctrl+P or Cmd+P will trigger browser print
        if ((e.ctrlKey || e.metaKey) && e.keyCode == 80) {
            window.print();
            return false;
        }
    });

    // Initialize tooltips (Bootstrap 5)
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Back to top button (optional)
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 300) {
            if (!$('#backToTop').length) {
                $('body').append('<button id="backToTop" class="btn btn-primary" style="position:fixed;bottom:20px;right:20px;display:none;z-index:99;"><i class="fas fa-arrow-up"></i></button>');
                $('#backToTop').on('click', function () {
                    $('html, body').animate({ scrollTop: 0 }, 1000);
                });
            }
            $('#backToTop').fadeIn();
        } else {
            $('#backToTop').fadeOut();
        }
    });

    // Add more interactive features
    console.log('CV Portfolio loaded successfully!');
});

// Global utility functions
function toggleDarkMode() {
    $('body').toggleClass('dark-mode');
    localStorage.setItem('darkMode', $('body').hasClass('dark-mode'));
}

function downloadCV() {
    window.print();
}

// Page load complete message
$(window).on('load', function () {
    console.log('All resources loaded!');
});

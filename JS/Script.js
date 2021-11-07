
$(document).ready(function() {
    $(".menu-icon").on("click", function() {
          $("nav ul").toggleClass("showing");
    });
});

// Scrolling Effect

$(window).on("scroll", function() {
    if($(window).scrollTop()) {
          $('nav').addClass('black');
    }

    else {
          $('nav').removeClass('black');
    }
})

AOS.init();


//EMAIL

if(window.history.replaceState){
  window.history.replaceState(null, null, window.location.href);
}

// SMOOTH SCROLLL

$('a.smooth-scroll')
.click(function(event) {
// On-page links
if (
location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
&& 
location.hostname == this.hostname
) {
// Figure out element to scroll to
var target = $(this.hash);
target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
// Does a scroll target exist?
if (target.length) {
  // Only prevent default if animation is actually gonna happen
  event.preventDefault();
  $('html, body').animate({
    scrollTop: target.offset().top
  }, 1000, function() {
    // Callback after animation
    // Must change focus!
    var $target = $(target);
    $target.focus();
    if ($target.is(":focus")) { // Checking if the target was focused
      return false;
    } else {
      $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
      $target.focus(); // Set focus again
    };
  });
}
}
});

var typed = new Typed('.bienvenue', {
strings: ['<h1>Bienvenue sur mon CV</h1>','<h3>Ce CV a était produit et hébergé par moi même.</3> ','<h3>Pour plus d&apos;information veillez vous rendre dans la partie information.</h3>' ],
typeSpeed: 50,
loop: true,
});

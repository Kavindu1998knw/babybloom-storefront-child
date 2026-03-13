document.addEventListener('DOMContentLoaded', function () {
  var navToggle = document.querySelector('.babybloom-mobile-toggle');
  var nav = document.querySelector('.babybloom-header__menu');
  var navLinks = nav ? nav.querySelectorAll('a') : [];

  function closeMenu() {
    if (!navToggle || !nav) {
      return;
    }

    navToggle.setAttribute('aria-expanded', 'false');
    nav.classList.remove('is-open');
  }

  if (navToggle && nav) {
    navToggle.addEventListener('click', function () {
      var expanded = navToggle.getAttribute('aria-expanded') === 'true';
      navToggle.setAttribute('aria-expanded', String(!expanded));
      nav.classList.toggle('is-open', !expanded);
    });

    window.addEventListener('resize', function () {
      if (window.innerWidth > 1100) {
        closeMenu();
      }
    });

    navLinks.forEach(function (link) {
      link.addEventListener('click', closeMenu);
    });
  }
});

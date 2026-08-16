document.addEventListener('DOMContentLoaded', function () {

  // ---- Scroll reveal ----
  const revealEls = document.querySelectorAll('[data-reveal]');

  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const delay = entry.target.getAttribute('data-reveal-delay') || 0;
          setTimeout(() => entry.target.classList.add('sk-visible'), delay);
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });

    revealEls.forEach((el) => observer.observe(el));
  } else {
    // Fallback: no IntersectionObserver support
    revealEls.forEach((el) => el.classList.add('sk-visible'));
  }

  // ---- Sticky navbar shadow on scroll ----
  const navbar = document.querySelector('.sk-navbar');
  if (navbar) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 12) {
        navbar.style.boxShadow = '0 8px 24px rgba(15,82,87,0.08)';
      } else {
        navbar.style.boxShadow = 'none';
      }
    });
  }

  // ---- Newsletter form (demo only — replace with real POST route) ----
  const form = document.querySelector('.sk-newsletter-form');
  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      const btn = form.querySelector('button');
      const original = btn.textContent;
      btn.textContent = 'ধন্যবাদ! ✓';
      btn.disabled = true;
      setTimeout(() => {
        btn.textContent = original;
        btn.disabled = false;
        form.reset();
      }, 2000);
    });
  }

});
/**
 * Afrochick — Main JavaScript
 * Handles: dark mode, mobile nav, FAQ accordion, scroll reveals, newsletter, floating CTA
 */

document.addEventListener('DOMContentLoaded', () => {
  initLucide();
  initTheme();
  initNavbar();
  initMobileMenu();
  initFAQ();
  initScrollReveal();
  initFloatingCTA();
  initNewsletter();
});

function initLucide() {
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }
}

/* ─── Dark Mode ─── */
function initTheme() {
  const toggle = document.getElementById('theme-toggle');
  const stored = localStorage.getItem('afrochick-theme');
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

  if (stored === 'dark' || (!stored && prefersDark)) {
    document.documentElement.classList.add('dark');
  }

  toggle?.addEventListener('click', () => {
    const isDark = document.documentElement.classList.toggle('dark');
    localStorage.setItem('afrochick-theme', isDark ? 'dark' : 'light');
  });
}

/* ─── Sticky Navbar ─── */
function initNavbar() {
  const navbar = document.getElementById('navbar');
  if (!navbar) return;

  const onScroll = () => {
    navbar.classList.toggle('scrolled', window.scrollY > 20);
  };

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();
}

/* ─── Mobile Menu ─── */
function initMobileMenu() {
  const hamburger = document.getElementById('hamburger');
  const nav = document.getElementById('navbar-nav');
  if (!hamburger || !nav) return;

  hamburger.addEventListener('click', () => {
    const open = nav.classList.toggle('open');
    hamburger.setAttribute('aria-expanded', open);
    document.body.classList.toggle('menu-open', open);
  });

  nav.querySelectorAll('.nav-link').forEach((link) => {
    link.addEventListener('click', () => {
      nav.classList.remove('open');
      hamburger.setAttribute('aria-expanded', 'false');
      document.body.classList.remove('menu-open');
    });
  });
}

/* ─── FAQ Accordion ─── */
function initFAQ() {
  document.querySelectorAll('.faq-item').forEach((item) => {
    const btn = item.querySelector('.faq-question');
    btn?.addEventListener('click', () => {
      const isOpen = item.classList.contains('open');

      document.querySelectorAll('.faq-item.open').forEach((openItem) => {
        openItem.classList.remove('open');
        openItem.querySelector('.faq-question')?.setAttribute('aria-expanded', 'false');
      });

      if (!isOpen) {
        item.classList.add('open');
        btn.setAttribute('aria-expanded', 'true');
      }
    });
  });
}

/* ─── Scroll Reveal ─── */
function initScrollReveal() {
  const reveals = document.querySelectorAll('.reveal');
  if (!reveals.length) return;

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
  );

  reveals.forEach((el) => observer.observe(el));
}

/* ─── Floating CTA ─── */
function initFloatingCTA() {
  const cta = document.getElementById('floating-cta');
  const hero = document.getElementById('hero');
  if (!cta || !hero) return;

  const observer = new IntersectionObserver(
    ([entry]) => {
      cta.classList.toggle('show', !entry.isIntersecting);
    },
    { threshold: 0.1 }
  );

  observer.observe(hero);
}

/* ─── Newsletter Form ─── */
function initNewsletter() {
  const form = document.getElementById('newsletter-form');
  const message = document.getElementById('newsletter-message');
  if (!form) return;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const btn = form.querySelector('button[type="submit"]');
    const emailInput = form.querySelector('input[name="email"]');
    const originalText = btn.textContent;

    btn.disabled = true;
    btn.textContent = 'Subscribing…';
    message.hidden = true;

    try {
      const formData = new FormData(form);
      const res = await fetch(form.action, { method: 'POST', body: formData });
      const data = await res.json();

      message.textContent = data.message;
      message.className = 'form-message ' + (data.success ? 'success' : 'error');
      message.hidden = false;

      if (data.success) {
        emailInput.value = '';
      }
    } catch {
      message.textContent = 'Something went wrong. Please try again.';
      message.className = 'form-message error';
      message.hidden = false;
    } finally {
      btn.disabled = false;
      btn.textContent = originalText;
    }
  });
}

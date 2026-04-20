/* ===================================================
   Power Supply Feedback System — Client-side JS
   =================================================== */

document.addEventListener('DOMContentLoaded', () => {

  // ── Mobile Nav Toggle ──
  const toggle = document.querySelector('.navbar-toggle');
  const nav = document.querySelector('.navbar-nav');
  if (toggle && nav) {
    toggle.addEventListener('click', () => {
      nav.classList.toggle('open');
      const isOpen = nav.classList.contains('open');
      toggle.setAttribute('aria-expanded', isOpen);
      toggle.innerHTML = isOpen ? '&#10005;' : '&#9776;';
    });

    // Close nav when a link is clicked
    nav.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        nav.classList.remove('open');
        toggle.innerHTML = '&#9776;';
      });
    });
  }

  // ── Form Validation ──
  const feedbackForm = document.getElementById('feedbackForm');
  if (feedbackForm) {
    feedbackForm.addEventListener('submit', (e) => {
      const location = feedbackForm.querySelector('[name="location"]');
      const issueType = feedbackForm.querySelector('[name="issue_type"]');
      const description = feedbackForm.querySelector('[name="description"]');
      let valid = true;

      // Clear previous errors
      feedbackForm.querySelectorAll('.field-error').forEach(el => el.remove());

      if (!location.value.trim()) {
        showFieldError(location, 'Location is required');
        valid = false;
      }
      if (!issueType.value) {
        showFieldError(issueType, 'Please select an issue type');
        valid = false;
      }
      if (!description.value.trim()) {
        showFieldError(description, 'Please describe the issue');
        valid = false;
      }

      if (!valid) {
        e.preventDefault();
      }
    });
  }

  function showFieldError(input, message) {
    const err = document.createElement('p');
    err.className = 'field-error';
    err.style.cssText = 'color:#9B1C1C;font-size:0.8rem;margin-top:4px;';
    err.textContent = message;
    input.parentNode.appendChild(err);
    input.style.borderColor = '#F87171';
  }

  // ── Admin: Status Toggle (Preview only) ──
  document.querySelectorAll('.btn-toggle-status').forEach(btn => {
    btn.addEventListener('click', () => {
      const card = btn.closest('.card');
      const badge = card.querySelector('.badge');
      if (!badge) return;

      if (badge.classList.contains('badge-pending')) {
        badge.classList.remove('badge-pending');
        badge.classList.add('badge-resolved');
        badge.textContent = 'Resolved';
        btn.textContent = '↩ Mark Pending';
      } else {
        badge.classList.remove('badge-resolved');
        badge.classList.add('badge-pending');
        badge.textContent = 'Pending';
        btn.textContent = '✓ Mark Resolved';
      }
    });
  });

  // ── Admin: Delete Confirmation (Preview only) ──
  document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', () => {
      if (confirm('Are you sure you want to delete this complaint?')) {
        const card = btn.closest('.card');
        card.style.opacity = '0';
        card.style.transform = 'scale(0.95)';
        card.style.transition = 'all 0.3s ease';
        setTimeout(() => card.remove(), 300);
      }
    });
  });

  // ── Admin Login (Preview only) ──
  const loginForm = document.getElementById('loginForm');
  if (loginForm) {
    loginForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const email = loginForm.querySelector('[name="email"]').value;
      const password = loginForm.querySelector('[name="password"]').value;

      if (email === 'admin@power.gov' && password === 'admin123') {
        window.location.href = 'admin-dashboard.html';
      } else {
        let alert = loginForm.querySelector('.alert');
        if (!alert) {
          alert = document.createElement('div');
          alert.className = 'alert alert-error';
          loginForm.prepend(alert);
        }
        alert.textContent = 'Invalid credentials. Try admin@power.gov / admin123';
      }
    });
  }

  // ── Active Nav Highlight ──
  const currentPage = window.location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.navbar-nav a').forEach(link => {
    const href = link.getAttribute('href');
    if (href === currentPage || (currentPage === '' && href === 'index.html')) {
      link.classList.add('active');
    }
  });

  // ── Fade-in animation on scroll ──
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('fade-in-up');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.card').forEach(card => {
    observer.observe(card);
  });
});

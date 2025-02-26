// Import the main CSS file
import '../css/style.css';

/**
 * Mobile menu toggle
 */
document.addEventListener('DOMContentLoaded', () => {
  // Mobile menu toggle
  const menuToggle = document.querySelector('.menu-toggle');
  const mobileMenu = document.querySelector('.mobile-menu');
  
  if (menuToggle && mobileMenu) {
    menuToggle.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
      const expanded = menuToggle.getAttribute('aria-expanded') === 'true' || false;
      menuToggle.setAttribute('aria-expanded', !expanded);
    });
  }
  
  // Close mobile menu on window resize
  window.addEventListener('resize', () => {
    if (window.innerWidth >= 768 && mobileMenu && !mobileMenu.classList.contains('hidden')) {
      mobileMenu.classList.add('hidden');
      if (menuToggle) {
        menuToggle.setAttribute('aria-expanded', 'false');
      }
    }
  });
});

/**
 * Handle Contact Form 7 submission styling
 */
document.addEventListener('wpcf7submit', function(event) {
  const form = event.detail.apiResponse;
  const formElement = document.querySelector(`#${event.detail.id}`);
  
  if (formElement) {
    // Remove any existing status classes
    formElement.classList.remove('form-success', 'form-error');
    
    // Add appropriate class based on submission status
    if (form.status === 'mail_sent') {
      formElement.classList.add('form-success');
    } else {
      formElement.classList.add('form-error');
    }
  }
});
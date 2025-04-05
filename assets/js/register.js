document.addEventListener("DOMContentLoaded", function () {
    // Get the form elements
    const loginForm = document.getElementById('first');
    const registerForm = document.getElementById('second');
    
    // Get the links for toggling between forms
    const toRegisterLink = document.getElementById('signup');
    const toLoginLink = document.getElementById('signin');
    
    // Handle the click event to show the registration form
    toRegisterLink.addEventListener('click', function (e) {
      e.preventDefault();  // Prevent default link behavior
      loginForm.style.display = 'none';  // Hide login form
      registerForm.style.display = 'block';  // Show registration form
    });
    
    // Handle the click event to show the login form
    toLoginLink.addEventListener('click', function (e) {
      e.preventDefault();  // Prevent default link behavior
      registerForm.style.display = 'none';  // Hide registration form
      loginForm.style.display = 'block';  // Show login form
    });
  });
  
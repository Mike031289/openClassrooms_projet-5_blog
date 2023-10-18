    document.getElementById('show-password').addEventListener('click', function () {
        const passwordField = document.getElementById('inputPassword');
        const passwordIcon = document.getElementById('password-icon');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    });

    function validateEmail(emailInput) {
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    const isValid = emailRegex.test(emailInput.value);

    if (isValid) {
      emailInput.classList.remove('is-invalid');
      emailInput.classList.add('is-valid');
    } else {
      emailInput.classList.remove('is-valid');
      emailInput.classList.add('is-invalid');
    }
  }

  function validatePassword(passwordInput) {
    // Add your password validation regex here
    const passwordRegex = /^[A-Za-z0-9!@#$%^&*()_+={}\[\]:;<>,.?~\\-]{8,}$/;
    const isValid = passwordRegex.test(passwordInput.value);

    if (isValid) {
      passwordInput.classList.remove('is-invalid');
      passwordInput.classList.add('is-valid');
    } else {
      passwordInput.classList.remove('is-valid');
      passwordInput.classList.add('is-invalid');
    }
  }

  function togglePasswordVisibility() {
    // Your password visibility toggle logic here
  }


// Toggle password visibility
$(document).ready(function () {
  $('#showPasswordBtn').on('click', function () {
    togglePasswordVisibility('#inputPassword', '#password-icon');
  });

  $('#showConfirmPasswordBtn').on('click', function () {
    togglePasswordVisibility('#inputConfirmPassword', '#confirm-password-icon');
  });

  function togglePasswordVisibility(inputId, iconId) {
    var passwordInput = $(inputId);
    var passwordIcon = $(iconId);

    if (passwordInput.attr('type') === 'password') {
      passwordInput.attr('type', 'text');
      passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
      passwordInput.attr('type', 'password');
      passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
    }
  }
});

$(document).ready(function () {

  $("#show-password").click(function () {
    const passwordField = $("#inputPassword");
    const passwordIcon = $("#password-icon");
    if (passwordField.attr("type") === "password") {
      passwordField.attr("type", "text");
      passwordIcon.removeClass("fa-eye");
      passwordIcon.addClass("fa-eye-slash");
    } else {
      passwordField.attr("type", "password");
      passwordIcon.removeClass("fa-eye-slash");
      passwordIcon.addClass("fa-eye");
    }
  });

  $("#show-passWord").click(function () {
    const passwordField1 = $("#inputPassWord");
    const passwordConfirmField = $("#inputPassWordConfirm");
    const passwordIcon = $("#passWord-icon");
    if (passwordField1.attr("type") === "password" && passwordConfirmField.attr("type") === "password") {
      passwordField1.attr("type", "text");
      passwordConfirmField.attr("type", "text");
      passwordIcon.removeClass("fa-eye");
      passwordIcon.addClass("fa-eye-slash");
    } else {
      passwordField1.attr("type", "password");
      passwordConfirmField.attr("type", "password");
      passwordIcon.removeClass("fa-eye-slash");
      passwordIcon.addClass("fa-eye");
    }
  });
});

// Show login form and hide register form
function showLogin() {
  hideAlert();
  document.getElementById("loginContainer").style.display = "block";
  document.getElementById("registerContainer").style.display = "none";
}

// Show register form and hide login form
function showRegister() {
  hideAlert();
  document.getElementById("loginContainer").style.display = "none";
  document.getElementById("registerContainer").style.display = "block";
}

// Hide the alert box
function hideAlert() {
  const alertBox = document.getElementById('alertMessage');
  if (alertBox) {
    alertBox.style.display = 'none';
    alertBox.innerText = '';
  }
}

// Show alert with message and background color
function showAlert(message, bgColor) {
  const alertBox = document.getElementById('alertMessage');
  if (alertBox) {
    alertBox.style.display = 'block';
    alertBox.style.backgroundColor = bgColor;
    alertBox.innerText = message;
    history.replaceState({}, document.title, window.location.pathname);
  }
}

// Run on page load
window.onload = function () {
  showLogin(); // Default: show login form

  const urlParams = new URLSearchParams(window.location.search);
  const status = urlParams.get('status');

  if (status === 'password_mismatch') {
    showAlert('Passwords do not match!', '#f44336');
  } else if (status === 'failed') {
    showAlert('Registration failed, please try again!', '#f44336');
  } else if (status === 'db_error') {
    showAlert('Database connection error!', '#f44336');
  } else if (status === 'success') {
    showAlert('Registration successful, you can now login!', '#4CAF50');
  } else if (status === 'user_not_found') {
    showAlert('Account not found!', '#f44336');
  } else if (status === 'incorrect_password') {
    showAlert('Incorrect password!', '#f44336');
  }
};

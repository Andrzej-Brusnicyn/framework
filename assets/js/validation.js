document.querySelector('.form-signin').addEventListener('submit', function(e) {
  clearErrors();

  let hasErrors = false;

  const name = document.getElementById('name').value.trim();
  if (name.length < 2) {
    showError('name', 'Имя должно содержать минимум 2 символа');
    hasErrors = true;
  }

  const password = document.getElementById('password').value.trim();
  if (password.length < 6) {
    showError('password', 'Пароль должен содержать минимум 6 символов');
    hasErrors = true;
  }

  const email = document.getElementById('email').value.trim();
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    showError('email', 'Введите корректный email адрес');
    hasErrors = true;
  }

  const gender = document.getElementById('gender');
  if (!gender.value || gender.value === ' ') {
    showError('gender', 'Выберите пол');
    hasErrors = true;
  }

  const status = document.getElementById('status');
  if (!status.value || status.value === ' ') {
    showError('status', 'Выберите статус');
    hasErrors = true;
  }

  if (hasErrors) {
    e.preventDefault();
  }
});

function showError(fieldId, message) {
  const field = document.getElementById(fieldId);
  const errorDiv = document.createElement('div');
  errorDiv.className = 'error-message';
  errorDiv.style.color = 'red';
  errorDiv.style.fontSize = '12px';
  errorDiv.style.marginTop = '5px';
  errorDiv.textContent = message;
  field.parentNode.appendChild(errorDiv);
  field.style.borderColor = 'red';
}

function clearErrors() {
  document.querySelectorAll('.error-message').forEach(error => error.remove());
  document.querySelectorAll('.form-control, select').forEach(field => {
    field.style.borderColor = '';
  });
}

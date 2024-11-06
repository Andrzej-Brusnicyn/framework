document.addEventListener('DOMContentLoaded', function() {
  const deleteButtons = document.querySelectorAll('.delete-button');

  deleteButtons.forEach(button => {
    button.addEventListener('click', function(event) {
      event.preventDefault();

      if (confirm('Вы уверены, что хотите удалить этого пользователя?')) {
        this.closest('form').submit();
      }
    });
  });
});

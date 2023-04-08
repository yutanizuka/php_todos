'use strict';

{
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');
  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
      checkbox.parentNode.submit();
    });
  });
}

{
  const checkboxes = document.querySelectorAll('input[type="delete"]');
  deletes.forEach(span => {
    span.addEventListener('change', () => {
      span.parentNode.submit();
    });
  });
}
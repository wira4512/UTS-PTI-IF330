document.addEventListener('DOMContentLoaded', function() {
    // Form Validation for Empty Fields
    const forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            const inputs = form.querySelectorAll('input, textarea');
            let valid = true;

            inputs.forEach(function(input) {
                if (input.required && input.value.trim() === '') {
                    valid = false;
                    input.classList.add('invalid');
                    input.placeholder = 'This field is required';
                } else {
                    input.classList.remove('invalid');
                }
            });

            if (!valid) {
                event.preventDefault(); // Prevent form submission if validation fails
                alert('Please fill out all required fields.');
            }
        });
    });

    // Confirm Deletion or Cancellation
    const deleteLinks = document.querySelectorAll('.delete-link, .cancel-link');
    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            const confirmed = confirm('Are you sure you want to proceed? This action cannot be undone.');
            if (!confirmed) {
                event.preventDefault(); // Prevent the action if user cancels
            }
        });
    });
});

const behavior_forms = {
    init() {
        const form = document.getElementById('dynamic-form');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validate data
                const errors = {};
                const inputs = form.querySelectorAll('input:not([type="hidden"]):not([type="file"]), textarea');
                const sumbitButton = document.getElementById('submit-button')
                const ajaxurl = sumbitButton.getAttribute('data-url');

                inputs.forEach(input => {
                    const value = input.value;
                    const name = input.getAttribute('name');

                    if (value === '') {
                        errors[name] = 'Ce champ est requis';
                    } else {
                        if (name === 'email' && !this.validateEmail(value)) {
                            errors[name] = 'Email invalide';
                        }
                    }
                });

                if (Object.keys(errors).length > 0) {
                    console.error('ERRORS', errors);
                    this.displayErrors(errors);
                    return;
                }

                // Submit the form
                const formData = new FormData(form);
                formData.append('action', 'submit_dynamic_form');

                fetch(ajaxurl, {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Formulaire soumis avec succès');
                        } else {
                            alert('Erreur: ' + data.data);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                    });
            }.bind(this));
        }
    },

    validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    },

    clearErrors() {
        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(msg => msg.remove());
    },

    displayErrors(errors) {
        for (const [fieldName, errorMessage] of Object.entries(errors)) {
            const field = document.querySelector(`[name="${fieldName}"]`);
            if (field) {
                const errorElement = document.createElement('div');
                errorElement.className = 'error-message';
                errorElement.style.color = 'red';
                errorElement.textContent = errorMessage;
                field.parentNode.insertBefore(errorElement, field);
            }
        }
    }
};

export default behavior_forms;

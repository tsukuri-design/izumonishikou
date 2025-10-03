document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector('.form_block');
    const submitButton = form.querySelector('input[type="submit"]');
    const validationRules = {
        'sender_name': {
            element: document.getElementById('name'),
            errorSelector: '.name .error_label',
            errorMessage: 'お名前は必須です。',
            validate: value => /[\u3040-\u30FF\u4E00-\u9FFF]/.test(value.trim())
        },
        'company': {
            element: document.getElementById('company'),
            errorSelector: '.company .error_label',
            errorMessage: '会社名は必須です。',
            validate: value => value.trim().length > 0
        },
        'email': {
            element: document.getElementById('email'),
            errorSelector: '.email .error_label',
            errorMessage: '有効なメールアドレスは必須です。',
            validate: value => /^([\w\d-]+)(\.[\w\d-]+)*@([\w\d-]+)(\.[\w\d-]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2}$/.test(value.trim())
        },
        'tel': {
            element: document.getElementById('tel'),
            errorSelector: '.tel .error_label',
            errorMessage: '有効な電話番号は必須です。',
            validate: value => /^(\d{2,4}-\d{2,4}-\d{3,4}|\d{10,11})$/.test(value.trim())
        },
        'content': {
            element: document.getElementById('content'),
            errorSelector: '.content .error_label',
            errorMessage: 'お問い合わせ内容は必須です。',
            validate: value => value.trim().length > 0
        },
        'privacy': {
            element: document.getElementById('privacy'),
            errorSelector: '.privacy_con .error_label',
            errorMessage: 'プライバシーポリシーへの同意が必要です。',
            validate: () => document.getElementById('privacy')?.checked ?? false
        }
    };

    function isFieldValid(rule) {
        return rule.validate(rule.element.value.trim());
    }

    function isFormValid() {
        return Object.values(validationRules).every(isFieldValid);
    }

    function toggleSubmitButtonClass() {
        if (isFormValid()) {
            submitButton.classList.add('validated');
        } else {
            submitButton.classList.remove('validated');
        }
    }

    function displayErrors() {
        let firstErrorElement = null;

        Object.values(validationRules).forEach(rule => {
            if (!rule.element) return; // Skip if the element does not exist

            const errorLabel = document.querySelector(rule.errorSelector);
            const parent = rule.element.closest('.item') || rule.element.closest('.privacy_con');
            const isValid = isFieldValid(rule);

            if (!isValid) {
                errorLabel.textContent = rule.errorMessage;
                parent.classList.add("error");

                // Store the first invalid element
                if (!firstErrorElement) {
                    firstErrorElement = rule.element;
                }
            } else {
                errorLabel.textContent = '';
                parent.classList.remove("error");
            }
        });

        // Scroll to the first error element (handle checkboxes separately)
        if (firstErrorElement) {
            const yOffset = -100;
            let elementPosition = firstErrorElement.getBoundingClientRect().top + window.pageYOffset;
            let scrollPosition = elementPosition + yOffset;

            window.scrollTo({
                top: scrollPosition,
                behavior: 'smooth'
            });

            if (firstErrorElement.type !== "checkbox") {
                firstErrorElement.focus();
            }
        }
    }

    if (form) {
        // Blur listeners to validate fields without showing errors
        Object.values(validationRules).forEach(rule => {
            if (rule.element && rule.element.type !== "checkbox") {
                rule.element.addEventListener('blur', () => {
                    isFieldValid(rule);
                });
            }
            rule.element.addEventListener('blur', () => {
                if (isFormValid()) {
                    submitButton.classList.add('validated');
                } else {
                    submitButton.classList.remove('validated');
                }
            });

        });

        const privacyCheckbox = document.getElementById('privacy');
        if (privacyCheckbox) {
            privacyCheckbox.addEventListener('change', () => {
                if (isFormValid()) {
                    submitButton.classList.add('validated');
                } else {
                    submitButton.classList.remove('validated');
                }
            });
        }

        // Validate on button click
        submitButton.addEventListener('click', function (event) {
            if (!isFormValid()) {
                event.preventDefault();
                displayErrors();
                submitButton.classList.remove('validated');
            }
        });

        // Validate on form submit (backup for "Enter" key submissions)
        form.addEventListener('submit', function (event) {
            if (!isFormValid()) {
                event.preventDefault();
                displayErrors();
                submitButton.classList.remove('validated');
            }
        });
    }
});

const formElement = document.querySelector('.form_block');
const recaptchaResponseElement = document.getElementById('recaptchaResponse');

const refreshRecaptcha = () => {
    grecaptcha.execute(recaptcha_site_key, { action: 'submit' })
        .then(token => {
            if (recaptchaResponseElement) {
                recaptchaResponseElement.value = token;
            }
        })
        .catch(error => {
            console.error(`reCAPTCHAエラー: ${error}`);
        });
};

// Check if recaptcha_site_key is defined
if (typeof recaptcha_site_key === 'undefined') {
    console.error('recaptcha_site_key is not defined.');
} else {
    // Initial reCAPTCHA token generation
    grecaptcha.ready(() => {
        refreshRecaptcha();
    });

    // Form submission check
    if (formElement && recaptchaResponseElement) {
        formElement.addEventListener('submit', event => {
            if (!recaptchaResponseElement.value) {
                event.preventDefault(); // Prevent form submission if the token is not set
                alert('reCAPTCHAの検証が必要です');
            }
        });
    }

    // Refresh reCAPTCHA token every 90 seconds
    document.addEventListener('DOMContentLoaded', () => {
        setInterval(refreshRecaptcha, 90000);
    });
}

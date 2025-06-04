function checkAnalyticsTools() {
    // Check if Google Analytics 4 (gtag.js) is loaded
    if (typeof gtag === 'undefined') {
        // If GA4 is not loaded, check for Google Tag Manager
        if (typeof dataLayer === 'undefined' || !dataLayer.length) {
            // If GTM is also not loaded
            alert('Neither Google Analytics 4 nor Google Tag Manager is loaded on the website!');
        } else {
            // GTM is loaded, check if it's linked with Google Analytics
            const gaLinked = dataLayer.some(entry => {
                return entry['event'] === 'gtm.js' || // The GTM initial event, often first step for GA integration
                    (entry['config'] && entry['config'].includes('G-')); // Looking for a GA4 config event with a GA tracking ID
            });

            if (gaLinked) {
                console.log('Google Tag Manager and Google Analytics 4 are linked and loaded correctly.');
            } else {
                console.log('Google Tag Manager is loaded, but not linked with Google Analytics 4.');
            }
        }
    } else {
        // GA4 is loaded correctly
        console.log('Google Analytics 4 is working correctly.');
    }
}

window.onload = function () {
    checkAnalyticsTools();
};

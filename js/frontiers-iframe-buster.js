/**
 * Frontiers Simple Iframe Buster - Client Side Implementation
 */
(function() {
    'use strict';

    function unhideBody() {
        const body = document.body || document.getElementsByTagName('body');
        if (body) {
            // Using requestAnimationFrame allows Lodestar's sticky nav calculations to complete smoothly
            window.requestAnimationFrame(function() {
                body.style.setProperty('display', 'block', 'important');
                
                // Trigger a native resize event to navigation scripts to recalculate menu layouts
                if (typeof window.Event === 'function') {
                    window.dispatchEvent(new Event('resize'));
                }
            });
        }
    }

    // Check if the current window is embedded inside an iframe
    if (window.self === window.top) {
        if (document.readyState === 'interactive' || document.readyState === 'complete') {
            unhideBody();
        } else {
            document.addEventListener('DOMContentLoaded', unhideBody);
        }
    } else {
        try {
            const parentUrl = document.referrer;
            
            if (parentUrl) {
                // Authorized regional Eventbrite extensions
                const allowedDomains = [
                    'eventbrite.com',
                    'eventbrite.nl',
                    'eventbrite.be',
                    'eventbrite.de',
                    'eventbrite.co.uk'
                ];

                // Whitelist verification pass
                for (var i = 0; i < allowedDomains.length; i++) {
                    if (parentUrl.indexOf(allowedDomains[i]) !== -1) {
                        unhideBody();
                        return;
                    }
                }
            }
        } catch (error) {
            // Secure cross-origin structural fallback protection
        }

        // Break out of hostile third-party iframe frame attempts
        window.top.location.replace(window.self.location.href);
    }
})();

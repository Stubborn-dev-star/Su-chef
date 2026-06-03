import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const loader = document.getElementById('page-loader');
    if (!loader) {
        return;
    }

    const showLoader = () => loader.classList.remove('hidden');
    const hideLoader = () => loader.classList.add('hidden');

    const isInternalNavigation = (anchor) => {
        const href = anchor.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('mailto:') || href.startsWith('tel:')) {
            return false;
        }
        if (anchor.target && anchor.target !== '_self') {
            return false;
        }
        if (anchor.hasAttribute('download')) {
            return false;
        }
        try {
            const url = new URL(href, window.location.href);
            return url.origin === window.location.origin;
        } catch (error) {
            return false;
        }
    };

    document.body.addEventListener('click', function (event) {
        const anchor = event.target.closest('a');
        if (!anchor || !isInternalNavigation(anchor)) {
            return;
        }
        showLoader();
    });

    document.body.addEventListener('submit', function () {
        showLoader();
    });

    window.addEventListener('beforeunload', showLoader);
    window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
            hideLoader();
        }
    });

    if (document.readyState === 'complete') {
        hideLoader();
    } else {
        window.addEventListener('load', hideLoader);
    }
});

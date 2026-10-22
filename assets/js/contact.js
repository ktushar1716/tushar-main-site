/* ==========================================
   Contact form — posts to contact.php with fetch().
   Kept separate from script.js so the form still works if the
   animation libraries fail to load.
   ========================================== */
(function () {
    const form = document.getElementById('contactForm');
    if (!form) return;

    const button = document.getElementById('contactSubmit');
    const label = button.querySelector('.btn-label');
    const status = document.getElementById('contactStatus');
    const idleLabel = label.textContent;

    const messages = {
        'contact-name': 'Please enter your name.',
        'contact-email': 'Please enter a valid email address.',
        'contact-message': 'Please write a message (at least 10 characters).',
    };

    function showStatus(type, text) {
        status.className = 'form-status is-' + type;
        status.textContent = text;
    }

    function clearStatus() {
        status.className = 'form-status';
        status.textContent = '';
    }

    function markInvalid(id) {
        const field = document.getElementById(id);
        if (!field) return;
        field.classList.add('is-invalid');
        field.setAttribute('aria-invalid', 'true');
        field.focus();
    }

    function setLoading(on) {
        button.disabled = on;
        button.classList.toggle('is-loading', on);
        button.setAttribute('aria-busy', on ? 'true' : 'false');
        label.textContent = on ? 'SENDING...' : idleLabel;
    }

    // Clear a field's error as soon as the user edits it.
    form.addEventListener('input', (e) => {
        if (e.target.classList.contains('is-invalid')) {
            e.target.classList.remove('is-invalid');
            e.target.removeAttribute('aria-invalid');
        }
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        if (button.disabled) return;

        clearStatus();
        form.querySelectorAll('.is-invalid').forEach((el) => {
            el.classList.remove('is-invalid');
            el.removeAttribute('aria-invalid');
        });

        // Client-side check first; the server validates again.
        for (const el of form.querySelectorAll('.form-input')) {
            el.value = el.value.trim();
            if (!el.checkValidity()) {
                showStatus('error', messages[el.id] || el.validationMessage);
                markInvalid(el.id);
                return;
            }
        }

        setLoading(true);

        try {
            const res = await fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: { 'X-Requested-With': 'fetch', 'Accept': 'application/json' },
            });

            let data;
            try {
                data = await res.json();
            } catch {
                throw new Error('Bad response');
            }

            if (data.ok) {
                form.reset();
                showStatus('success', data.message);
            } else {
                showStatus('error', data.message || 'Something went wrong. Please try again.');
                if (data.field) markInvalid(data.field);
            }
        } catch (err) {
            showStatus('error', "Couldn't reach the server. Check your connection and try again, or email me at khampariatushar@gmail.com.");
        } finally {
            setLoading(false);
        }
    });
})();

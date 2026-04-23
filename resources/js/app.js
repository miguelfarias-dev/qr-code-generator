import './bootstrap';

// INPUTS
const textInput = document.getElementById('textInput');
const sizeInput = document.getElementById('sizeInput');
const marginInput = document.getElementById('marginInput');
const logoInput = document.getElementById('logoInput');

// PREVIEW
const qrPreview = document.getElementById('qrPreview');
const previewContainer = document.getElementById('previewContainer');
const qrLogo = document.getElementById('qrLogo');

// CONTROL DE LOGO
let hasLogo = false;

// DARK MODE
const toggle = document.getElementById('darkToggle');

if (localStorage.getItem('theme') === 'dark') {
    document.documentElement.classList.add('dark');
}

toggle.addEventListener('click', () => {
    document.documentElement.classList.toggle('dark');

    const isDark = document.documentElement.classList.contains('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
});

// 📸 LOGO UPLOAD
logoInput.addEventListener('change', (e) => {
    const file = e.target.files[0];

    if (!file) {
        hasLogo = false;
        qrLogo.classList.add('hidden');
        return;
    }

    const url = URL.createObjectURL(file);

    qrLogo.src = url;
    qrLogo.classList.remove('hidden');
    hasLogo = true;
});

// 🔥 FUNCIÓN PRINCIPAL
function updateQR() {
    const text = textInput.value.trim();
    const size = sizeInput.value;
    const margin = marginInput.value;

    if (!text) {
        qrPreview.src = '';
        previewContainer.classList.add('hidden');
        qrLogo.classList.add('hidden');
        return;
    }

    const url = `/api/qr?text=${encodeURIComponent(text)}&size=${size}&margin=${margin}`;

    // evitar cache
    qrPreview.src = url + '&t=' + new Date().getTime();

    previewContainer.classList.remove('hidden');

    if (hasLogo) {
        qrLogo.classList.remove('hidden');
    } else {
        qrLogo.classList.add('hidden');
    }
}

// EVENTOS
textInput.addEventListener('input', updateQR);
sizeInput.addEventListener('input', updateQR);
marginInput.addEventListener('input', updateQR);

// INICIAL
updateQR();
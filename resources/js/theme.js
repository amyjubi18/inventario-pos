// On page load or when changing themes, best to add inline in `head` to avoid FOUC
if (!localStorage.getItem('color-theme')) {
    localStorage.setItem('color-theme', 'light');
}

const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
const themeToggleBtn = document.getElementById('theme-toggle');

// Function to set the theme and update icons
function applyTheme() {
    const userTheme = localStorage.getItem('color-theme');
    if (userTheme === 'dark') {
        // Dark mode: show moon, hide sun
        if (themeToggleLightIcon) themeToggleLightIcon.classList.add('hidden');
        if (themeToggleDarkIcon) themeToggleDarkIcon.classList.remove('hidden');
        document.documentElement.classList.add('dark');
    } else {
        // Light mode: show sun, hide moon
        if (themeToggleDarkIcon) themeToggleDarkIcon.classList.add('hidden');
        if (themeToggleLightIcon) themeToggleLightIcon.classList.remove('hidden');
        document.documentElement.classList.remove('dark');
    }
}

// Apply the theme on initial load
applyTheme();

if (themeToggleBtn) {
    themeToggleBtn.addEventListener('click', function() {
        // Toggle theme
        const current = localStorage.getItem('color-theme');
        if (current === 'dark') {
            localStorage.setItem('color-theme', 'light');
        } else {
            localStorage.setItem('color-theme', 'dark');
        }
        applyTheme();
    });
}

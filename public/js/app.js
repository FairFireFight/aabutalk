// temporary theme switch toggle.
function toggleTheme() {
    const currentTheme = document.body.getAttribute('data-bs-theme');
    document.body.setAttribute('data-bs-theme', currentTheme === 'light' ? 'dark' : 'light');
}

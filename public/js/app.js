// temporary theme switch toggle.
function toggleTheme() {
    const currentTheme = document.body.getAttribute('data-bs-theme');
    const newTheme = currentTheme === 'light' ? 'dark' : 'light';

    document.body.setAttribute('data-bs-theme', newTheme);

    localStorage.setItem('theme', newTheme);
}

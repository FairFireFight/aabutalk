const avatarInput = document.getElementById('avatar-input');
const coverInput = document.getElementById('cover-input');
function updateImageInput(fileInput, previews) {
    const file = fileInput.files[0];

    // update previews
    const fileReader = new FileReader();

    fileReader.onload = (e) => {
        const image = e.target.result;

        for(let i = 0; i < previews.length; i++) {
            previews.item(i).setAttribute('src', image);
        }
    };

    fileReader.readAsDataURL(file);
}

avatarInput.addEventListener("change", () => {
    updateImageInput(avatarInput, document.getElementsByClassName('avatar-preview'));
});

coverInput.addEventListener("change", () => {
    updateImageInput(coverInput, document.getElementsByClassName('cover-preview'));
});

const themeButtons = document.querySelectorAll(".theme-setting");

// add click event listeners to all buttons
themeButtons.forEach(button => {
    button.addEventListener("click", function () {
        // get the selected theme from the button's text content
        const selectedTheme = this.getAttribute('data-value');
        
        // Save the selected theme to local storage
        localStorage.setItem("preferredTheme", selectedTheme);

        // Apply the selected theme
        if (selectedTheme === 'auto') {
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.body.setAttribute('data-bs-theme', 'dark');
            } else {
                document.body.setAttribute('data-bs-theme', 'light');
            }
        } else {
            document.body.setAttribute('data-bs-theme', selectedTheme);
        }
    });
});

// initialization
updateImageInput(avatarInput, document.getElementsByClassName('avatar-preview'));
updateImageInput(coverInput, document.getElementsByClassName('cover-preview'));

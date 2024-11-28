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

// initialization
updateImageInput(avatarInput, document.getElementsByClassName('avatar-preview'));
updateImageInput(coverInput, document.getElementsByClassName('cover-preview'));

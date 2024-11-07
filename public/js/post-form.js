let textAreaValid = false;
let fileInputValid = false;

const textArea = document.getElementById('text-area');
const fileInput = document.getElementById('file-input');
const submitButton = document.getElementById('submit-button');

textArea.addEventListener("input", () => {
    updateTextArea(textArea);
    updateSubmitButton();
});

fileInput.addEventListener("change", () => {
    updateImageInput(fileInput);
    updateSubmitButton();
});

function updateSubmitButton() {
    if (textAreaValid || fileInputValid) {
        submitButton.removeAttribute("disabled");
    } else {
        submitButton.setAttribute("disabled", "");
    }
}

function updateTextArea(textArea) {
    const charCount = textArea.value.length;
    const charDisplay = document.getElementById('char-limit');

    charDisplay.textContent = `${charCount} / 512 Characters`;

    textAreaValid = charCount > 0;

    if (charCount === 512) {
        charDisplay.classList.remove("text-secondary");
        charDisplay.classList.add("text-danger");
    } else {
        charDisplay.classList.remove("text-danger");
        charDisplay.classList.add("text-secondary");
    }
}

function updateImageInput(fileInput) {
    const files = fileInput.files;

    fileInputValid = files.length > 0;

    if(fileInputValid) {
        const imageContainer = document.getElementById('image-container');

        // add image to image container
        for (let i = 0; i < files.length; i++) {
            const fileReader = new FileReader();

            fileReader.onload = (e) => {
                imageContainer.innerHTML += `
                        <img src="${e.target.result}" class="rounded-0" style="width: 100px; aspect-ratio: 1; object-fit: cover;" alt="Uploaded Image Preview">
                    `;
            };

            fileReader.readAsDataURL(files[i]);
        }
    }
}

updateTextArea(textArea);
updateImageInput(fileInput);
updateSubmitButton();

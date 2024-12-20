$(document).ready(function () {
    // Toolbar options for the Quill editor
    const toolbarOptions = [
        [{ header: [1, 2, 3, true] }],
        ['bold', 'italic', 'underline'],
        ['link', 'image'],
        [{ list: 'ordered' }, { list: 'bullet' }],
        [{ direction: 'rtl' }]
    ];

    // Initialize Quill editor
    const quill = new Quill('#content', {
        modules: { toolbar: toolbarOptions },
        theme: 'snow'
    });

    const submitButton = document.getElementById('submit-button');
    const submitButtonContent = submitButton.innerHTML;
    const processingSpinner = document.getElementById('processing-spinner');

    // Submit button click event handler
    submitButton.addEventListener('click', async () => {
        if (!validateForm()) return; // Validate form input

        // disable post button and show loading screen
        submitButton.innerHTML = '<div class="spinner-border m-0"></div>';
        submitButton.classList.add('disabled');
        processingSpinner.classList.remove('d-none');

        const images = extractImagesFromEditor(quill); // Extract Base64 images
        for (const image of images) {
            await uploadImage(image); // Upload each image
        }

        uploadPost(); // Submit the post
    });

    /**
     * Validate form fields
     */
    function validateForm() {
        const title = document.getElementById('title').value.trim();

        const titleError = document.getElementById('title-error');
        const contentError = document.getElementById('content-error');

        let content = document.querySelector('.ql-editor').innerHTML.trim();

        let isValid = true;

        // Reset error messages
        titleError.classList.add('d-none');
        contentError.classList.add('d-none');

        // Validate title
        if (!title) {
            titleError.classList.remove('d-none');
            isValid = false;
        }

        // Validate content
        let emptyContent = '<p><br></p>';

        // remove all starting <p><br></p>
        while(content.startsWith(emptyContent)) {
            content = content.indexOf(emptyContent) === 0 ? content.substring(11) : content;
        }

        // remove all trailing ones
        while(content.endsWith(emptyContent)) {
            content = content.replace(new RegExp(emptyContent + '$'), '')
        }

        // check if it's nothing
        if (content === '') {
            contentError.classList.remove('d-none');
            isValid = false;
        }

        if (document.querySelector('.ql-editor').innerText.trim() === '') {
            contentError.classList.remove('d-none');
            isValid = false;
        }

        return isValid;
    }

    /**
     * Upload the post content
     */
    function uploadPost() {
        $.ajax({
            url: window.location.pathname.substring(3),
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                title: document.getElementById('title').value.trim(),
                content: document.querySelector('.ql-editor').innerHTML.trim()
            },
            success(response) {
                const { redirect } = JSON.parse(response);
                window.location.href = redirect;
            },
            error(xhr, status, error) {
                console.error('Error:', error);

                // return button and hide loading screen
                submitButton.innerHTML = submitButtonContent;
                submitButton.classList.remove('disabled');
                processingSpinner.classList.add('d-none');

                alert('Something went wrong while submitting...');
            }
        });
    }

    /**
     * Convert Base64 to a File object
     */
    function base64ToFile(base64String, filename) {
        const [header, data] = base64String.split(',');
        const mime = header.match(/:(.*?);/)[1];
        const binary = atob(data);
        const array = Uint8Array.from(binary, char => char.charCodeAt(0));

        return new File([array], filename, { type: mime });
    }

    /**
     * Extract Base64 image strings from the editor
     */
    function extractImagesFromEditor(editor) {
        return editor.getContents().ops
            .filter(op => op.insert && op.insert.image)
            .map(op => op.insert.image);
    }

    /**
     * Upload a single image
     */
    function uploadImage(image) {
        const formData = new FormData();
        formData.append('image', base64ToFile(image, 'image'));

        return $.ajax({
            url: '/upload/images',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success(response) {
                const { path } = JSON.parse(response);
                updateEditorImage(quill, image, path);
                console.log('Upload success:', path);
            },
            error(jqXHR, textStatus, errorThrown) {
                console.error('Upload failed:', textStatus, errorThrown);
            }
        });
    }

    /**
     * Update editor images with server URLs
     */
    function updateEditorImage(editor, base64Image, imageUrl) {
        const newContents = editor.getContents().ops.map(op => {
            if (op.insert && op.insert.image === base64Image) {
                op.insert.image = imageUrl; // Replace Base64 with the server URL
            }
            return op;
        });

        editor.setContents(newContents);
    }
});

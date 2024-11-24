$( document ).ready(function() {
    const toolbarOptions = [
        [{ 'header': [3, 4, 5, false] }],
        ['bold', 'italic', 'underline'],
        ['link', 'image'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'align': [] }],
        [{ 'direction': 'rtl' }],
    ];

    const quill = new Quill('#content', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });

    const submitButton = document.getElementById('submit-button');
    const submitButtonContent = submitButton.innerHTML;

    submitButton.addEventListener('click', () => {
        if (! validateForm()) {
            return;
        }

        submitForm();
    });

    function validateForm() {
        const title = document.getElementById('title').value;
        const content = document.getElementsByClassName('ql-editor').item(0).innerHTML;

        const titleError = document.getElementById('title-error')
        const contentError = document.getElementById('content-error')

        let isValid = true;

        // reset errors
        titleError.classList.add('d-none');
        contentError.classList.add('d-none');

        if (title == '') {
            titleError.classList.remove('d-none');
            isValid = false;
        }

        if (content === '<p><br></p>') {
            contentError.classList.remove('d-none');
            isValid = false;
        }

        return isValid;
    }

    function submitForm() {
        submitButton.innerHTML = '<div class="spinner-border m-0"></div>';
        submitButton.classList.add('disabled')

        $.ajax({
            url: window.location.pathname.substring(3),
            type: 'POST',
            dataType: '',
            data: {
                title: document.getElementById('title').value,
                content: document.getElementsByClassName('ql-editor').item(0).innerHTML
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                response = JSON.parse(response);
                window.location.href = response.redirect;
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);

                submitButton.innerHTML = submitButtonContent;
                submitButton.classList.remove('disabled')

                alert('Something went wrong while submitting...')
            }
        });
    }
});


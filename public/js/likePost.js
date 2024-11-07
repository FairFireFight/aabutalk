// handle like button
function likePost(evn) {
    let button = evn;

    const likeCount = parseInt(button.innerHTML.substring(0, button.innerHTML.indexOf('<') - 1));
    const icon = '<i class="bi bi-hand-thumbs-up"></i>'

    $.ajax({
        url: `/posts/${button.id}/like`,
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify({ "_token": $('meta[name="csrf-token"]').attr('content')}),
        success: function(response) {
            response = JSON.parse(response);

            if(response.state === "liked") {
                button.classList.add("btn-aabu");
                button.classList.remove("btn-outline-aabu");

                button.innerHTML = (likeCount + 1) + " <i class=\"bi bi-hand-thumbs-up\"></i>";
            } else {
                button.classList.add("btn-outline-aabu");
                button.classList.remove("btn-aabu");

                button.innerHTML = (likeCount - 1) + " <i class=\"bi bi-hand-thumbs-up\"></i>";
            }
        },
        error: function(error) {
            // TODO: replace with modal.
            alert("Oops, something went wrong trying to like this post.");
        }
    });
}

$(document).ready(() => {
    let page = 1;
    let isLoading = false;
    let isLast = false;

    const locale = window.location.pathname.substring(1, 3);

    $(window).scroll(() => {
        if($(window).scrollTop() + $(window).height() +
            /* distance to bottom of page to start loading more */ 150 >= $(document).height()) {
            if (!isLoading && !isLast) {
                page++;

                isLoading = true;
                loadMorePosts(page);
            }
        }
    });

    function loadMorePosts(page) {
        $.ajax({
            url: `load/posts/feed?page=${page}`,
            type: "GET",
            success: function(response) {
                document.getElementById("posts-container").innerHTML = response.content;

                // delete spinner if that's the last post.
                if (response.isLast) {
                    $("#loading-spinner").remove();
                }

                isLoading = false;
            }, error: function(error) {
                isLoading = false;

                alert("Oops, something went wrong trying to load more posts.");
            }});
    }

    loadMorePosts(0);
});


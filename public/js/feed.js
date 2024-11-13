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


    const postsContainer =  document.getElementById("posts-container");
    let isFirstLoad = true;
    function loadMorePosts(page) {
        $.ajax({
            url: `load/posts/feed?page=${page}`,
            type: "GET",
            success: function(response) {
                if (isFirstLoad) {
                    postsContainer.innerHTML = '';
                    isFirstLoad = false;
                }

                postsContainer.innerHTML += response.content;

                // delete spinner if that's the last post.
                if (response.isLast) {
                    isLast = true;
                    $("#loading-spinner").remove();
                }

                isLoading = false;
            }, error: function(error) {
                page--;
                isLoading = false;

                alert("Oops, something went wrong trying to load more posts.");
            }}
        );
    }

    loadMorePosts(1);
});


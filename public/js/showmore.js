document.addEventListener("DOMContentLoaded", () => {
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("ellipsis-readmore")) {            
            const postId = event.target.getAttribute("data-post-id");
            const postElement = document.querySelector(`#post-${postId}`);

            if (postElement) {                
                const shortDescription = postElement.querySelector(".short-description");
                const fullDescription = postElement.querySelector(".full-description");
                const ellipsisReadmore = postElement.querySelector(".ellipsis-readmore");

                if (shortDescription && fullDescription && ellipsisReadmore) {
                    shortDescription.classList.add("d-none");
                    fullDescription.classList.remove("d-none");
                    ellipsisReadmore.classList.add("d-none");
                }
            }
        }
    });
});

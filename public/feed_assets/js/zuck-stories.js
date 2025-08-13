// Zuck stories and stories data

var timestamp = function () {
    var timeIndex = 0;
    var shifts = [
        35,
        60,
        60 * 3,
        60 * 60 * 2,
        60 * 60 * 25,
        60 * 60 * 24 * 4,
        60 * 60 * 24 * 10,
    ];

    var now = new Date();
    var shift = shifts[timeIndex++] || 0;
    var date = new Date(now - shift * 1000);

    return date.getTime() / 1000;
};

// Stories data

// Update your story below
function initZuckStories(storiesData) {
    new Zuck("stories", {
        backNative: false,
        previousTap: true,
        skin: "snapgram",
        autoFullScreen: false,
        avatars: true,
        list: false,
        openEffect: true,
        cubeEffect: true,
        backButton: true,
        localStorage: true,
        stories: storiesData,
        callbacks: {
            onView: function (storyId) {
                if (!storyId.includes("member-{{ $myUserId }}")) return;

                // Avoid duplicate buttons
                if (document.querySelector("#deleteStoryBtn")) return;

                setTimeout(() => {
                    const deleteBtn = document.createElement("button");
                    deleteBtn.id = "deleteStoryBtn";
                    deleteBtn.innerText = "Delete";
                    Object.assign(deleteBtn.style, {
                        position: "fixed",
                        top: "15px",
                        right: "15px",
                        zIndex: 9999,
                        padding: "10px 15px",
                        backgroundColor: "#e74c3c",
                        color: "white",
                        border: "none",
                        borderRadius: "4px",
                        fontWeight: "bold",
                    });

                    deleteBtn.onclick = function () {
                        const activeItem = document.querySelector(
                            ".story-viewer-item.active"
                        );
                        if (!activeItem) return;

                        const storyIdAttr =
                            activeItem.getAttribute("data-id") || "";
                        const storyIdNum = storyIdAttr.replace("story-", "");

                        if (
                            confirm(
                                "Are you sure you want to delete this story?"
                            )
                        ) {
                            deleteStory(storyIdNum);
                        }
                    };

                    document.body.appendChild(deleteBtn);

                    // Remove button when modal closes
                    document
                        .querySelector(".zuck-modal")
                        .addEventListener("click", () => {
                            const btn =
                                document.querySelector("#deleteStoryBtn");
                            if (btn) btn.remove();
                        });
                }, 500); // Slight delay ensures Zuck viewer is rendered
            },
        },
    });
}

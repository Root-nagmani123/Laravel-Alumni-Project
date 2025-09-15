(function () {
    // Utility: get CSRF token from meta
    function getCsrfToken() {
        var meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute("content") : "";
    }

    // -------------------------
    // Edit Group Post
    // -------------------------
    window.editGrp_post = function (postId) {
        $.ajax({
            url: "/user/group/edit_data_get/" + postId + "/edit",
            type: "GET",
            success: function (response) {
                $("#postContent").val(response.post.content);
                $("#videoLink").val(response.post.video_link);
                $("#currentMediaPreview").html("");

                if (response.post.media.length > 0) {
                    response.post.media.forEach(function (media) {
                        var imgHtml =
                            '\n        <div class="position-relative d-inline-block m-2" id="media-' +
                            media.id +
                            '">\n            <img src="/storage/' +
                            media.file_path +
                            '" class="img-thumbnail rounded shadow-sm"\n                 style="max-height: 150px; max-width: 150px; object-fit: cover;">\n            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 rounded-circle"\n                    onclick="removeMedia(' +
                            media.id +
                            ')">\n                <i class="fa fa-times"></i>\n            </button>\n        </div>\n    ';
                        $("#currentMediaPreview").append(imgHtml);
                    });
                }

                $("#editPostId").val(postId);
                $("#editPostModal").modal("show");
            },
        });
    };

    window.removeMedia = function (mediaId) {
        $.ajax({
            url: "/user/post/media_remove/" + mediaId,
            type: "DELETE",
            data: {
                _token: getCsrfToken(),
            },
            success: function (response) {
                if (response.success) {
                    $("#media-" + mediaId).remove();
                }
            },
        });
    };

    $(document).ready(function () {
        $("#postMedia").on("change", function () {
            $("#currentMediaPreview").append("");
            var files = this.files;

            Array.from(files).forEach(function (file, index) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var tempId = "new-" + index;
                    var imgHtml =
                        '\n                <div class="position-relative d-inline-block m-2" id="' +
                        tempId +
                        '">\n                    <img src="' +
                        e.target.result +
                        '" class="img-thumbnail rounded shadow-sm"\n                         style="max-height: 150px; max-width: 150px; object-fit: cover;">\n                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 rounded-circle"\n                            onclick="document.getElementById(\'' +
                        tempId +
                        '\').remove()">\n                        <i class="fa fa-times"></i>\n                    </button>\n                </div>\n            ';
                    $("#currentMediaPreview").append(imgHtml);
                };
                reader.readAsDataURL(file);
            });
        });
    });

    // -------------------------
    // Tribute (mentions)
    // -------------------------
    var tribute = new Tribute({
        trigger: "@",
        itemClass: "tribute-item",
        fillAttr: "username",
        lookup: "name",
        values: function (text, cb) {
            fetch("/user-search?q=" + encodeURIComponent(text))
                .then(function (res) {
                    return res.json();
                })
                .then(function (data) {
                    cb(data);
                });
        },
        menuItemTemplate: function (item) {
            return (
                '\n            <div class="d-flex align-items-center">\n                <img src="' +
                (item.original.avatar ||
                    "https://ui-avatars.com/api/?name=" + item.original.name) +
                '"\n                     class="rounded-circle me-2"\n                     width="36" height="36"\n                     style="object-fit: cover;">\n                <div class="info">\n                    <div class="name">' +
                item.original.name +
                '</div>\n                    <div class="meta">' +
                (item.original.meta || "") +
                "</div>\n                </div>\n            </div>\n        "
            );
        },
        positionMenu: function (menu, el) {
            var rects = tribute.range.getClientRects();
            if (!rects || rects.length === 0) return;
            var caretRect = rects[0];
            var menuHeight = menu.offsetHeight;
            var spaceBelow = window.innerHeight - caretRect.bottom;
            var spaceAbove = caretRect.top;
            menu.style.width = "";
            menu.style.height = "";
            var parentRect = el.getBoundingClientRect();
            var availableWidth = parentRect.right - caretRect.left;
            if (spaceBelow < menuHeight && spaceAbove > menuHeight) {
                menu.style.top =
                    caretRect.top - menuHeight + window.scrollY - 5 + "px";
            } else {
                menu.style.top = caretRect.bottom + window.scrollY + 5 + "px";
            }
            menu.style.left = caretRect.left + window.scrollX + "px";
            menu.style.width = availableWidth + "px";
        },
    });

    function attachTributeTo(element) {
        if (element && !element.hasAttribute("data-tribute-attached")) {
            tribute.attach(element);
            element.setAttribute("data-tribute-attached", "true");
        }
    }

    document.querySelectorAll(".user_feed_comment").forEach(attachTributeTo);
    var observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (mutation) {
            mutation.addedNodes.forEach(function (node) {
                if (node.nodeType === 1 && node.matches(".user_feed_comment")) {
                    attachTributeTo(node);
                }
                if (node.nodeType === 1) {
                    node.querySelectorAll(".user_feed_comment").forEach(
                        attachTributeTo
                    );
                }
            });
        });
    });
    observer.observe(document.body, { childList: true, subtree: true });

    // -------------------------
    // Like button
    // -------------------------
    $(document).on("click", ".like-button", function () {
        var $btn = $(this);
        var url = $btn.data("url");
        $.ajax({
            url: url,
            type: "POST",
            data: { _token: getCsrfToken() },
            success: function (response) {
                $btn.toggleClass("active text-primary");
                if (response.like_count != 0) {
                    $btn.find(".like-count").html(
                        "(" + response.like_count + ")"
                    );
                } else {
                    $btn.find(".like-count").html("");
                }
                $btn.attr("data-bs-title", response.tooltip_html)
                    .tooltip("dispose")
                    .tooltip();
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            },
        });
    });

    // -------------------------
    // Delete comment button
    // -------------------------
    $(document).on("click", ".delete-comment-btn", function () {
        var commentId = $(this).data("comment-id");
        if (confirm("Are you sure you want to delete this comment?")) {
            $.ajax({
                url: "/user/comments/" + commentId,
                type: "DELETE",
                data: { _token: getCsrfToken() },
                success: function () {
                    $("#comment-" + commentId).fadeOut(300, function () {
                        $(this).remove();
                        var $postCard = $(this).closest(".card");
                        var $countSpan = $postCard.find(".comment-count");
                        var countText = $countSpan.text().replace(/[()]/g, "");
                        var count = parseInt(countText) || 0;
                        count = count - 1;
                        if (count > 0) {
                            $countSpan.text("(" + count + ")");
                        } else {
                            $countSpan.text("");
                        }
                    });
                },
                error: function () {
                    alert("Failed to delete comment.");
                },
            });
        }
    });

    // -------------------------
    // Add Story Modal trigger
    // -------------------------
    var openAddStoryModalEl = document.getElementById("openAddStoryModal");
    if (openAddStoryModalEl) {
        openAddStoryModalEl.addEventListener("click", function () {
            var fileInput = document.getElementById("story_file");
            var fileError = document.getElementById("fileError");
            var fileInfo = document.getElementById("fileInfo");
            var form = document.getElementById("storyForm");
            if (fileInput) fileInput.value = "";
            if (fileError) fileError.innerText = "";
            if (fileInfo) fileInfo.innerText = "";
            if (form) form.reset();
            var myModal = new bootstrap.Modal(
                document.getElementById("addStoryModal")
            );
            myModal.show();
        });
    }

    // -------------------------
    // Copy URL buttons
    // -------------------------
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".copy-url-btn").forEach(function (el) {
            el.addEventListener("click", function (e) {
                e.preventDefault();
                var url = el.getAttribute("data-url");
                navigator.clipboard
                    .writeText(url)
                    .then(function () {
                        alert("Link copied to clipboard!");
                    })
                    .catch(function (err) {
                        console.error("Failed to copy: ", err);
                    });
            });
        });
    });

    // -------------------------
    // Direct message modal
    // -------------------------
    document
        .querySelectorAll(".send-direct-message-btn")
        .forEach(function (btn) {
            btn.addEventListener("click", function (e) {
                e.preventDefault();
                var userId = this.getAttribute("data-user-id");
                var input = document.getElementById("messageUserId");
                if (input) input.value = userId;
                var modal = new bootstrap.Modal(
                    document.getElementById("directMessageModal")
                );
                modal.show();
            });
        });

    // -------------------------
    // Share to feed demo
    // -------------------------
    document.querySelectorAll(".share-to-feed-btn").forEach(function (el) {
        el.addEventListener("click", function (e) {
            e.preventDefault();
            var postId = el.getAttribute("data-post-id");
            alert("Open share-to-feed modal for post ID: " + postId);
        });
    });

    // -------------------------
    // Inline comment edit helpers
    // -------------------------
    document.addEventListener("DOMContentLoaded", function () {
        document
            .querySelectorAll(".edit-comment-btn")
            .forEach(function (button) {
                button.addEventListener("click", function () {
                    var commentId = this.dataset.commentId;
                    var commentText = this.dataset.comment;
                    var commentDiv = document.getElementById(
                        "comment-text-" + commentId
                    );
                    if (!commentDiv) return;
                    commentDiv.innerHTML =
                        '\n                <input type="text" id="edit-input-' +
                        commentId +
                        '" class="form-control form-control-sm mb-1 user_feed_comment" value="' +
                        commentText.replace(/"/g, "&quot;") +
                        '">\n                <button class="btn btn-sm btn-success" onclick="saveEditedComment(' +
                        commentId +
                        ')">Update</button>\n               <button class="btn btn-sm btn-danger" onclick="deleteComment(' +
                        commentId +
                        ')">Delete</button>\n            ';
                    var inputEl = document.getElementById(
                        "edit-input-" + commentId
                    );
                    if (inputEl) tribute.attach(inputEl);
                });
            });
    });

    window.cancelEdit = function (id, originalText) {
        var el = document.getElementById("comment-text-" + id);
        if (el) el.innerHTML = originalText;
    };

    window.saveEditedComment = function (id) {
        var newCommentEl = document.getElementById("edit-input-" + id);
        var newComment = newCommentEl ? newCommentEl.value : "";
        fetch("/user/comments/" + id, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": getCsrfToken(),
                Accept: "application/json",
            },
            body: JSON.stringify({ comment: newComment }),
        })
            .then(function (res) {
                return res.json();
            })
            .then(function (data) {
                if (data.success) {
                    var el = document.getElementById("comment-text-" + id);
                    if (el) el.innerHTML = newComment;
                } else {
                    alert(data.message || "Failed to update comment");
                }
            })
            .catch(function (err) {
                console.error("Edit failed", err);
                alert("An error occurred while editing the comment.");
            });
    };

    window.deleteComment = function (commentId) {
        if (!confirm("Are you sure you want to delete this comment?")) return;
        fetch("/user/comments/" + commentId, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": getCsrfToken(),
                Accept: "application/json",
            },
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (data.success) {
                    var wrap = document.getElementById(
                        "comment-wrapper-" + commentId
                    );
                    if (wrap) wrap.remove();
                } else {
                    alert(data.error || "Failed to delete comment.");
                }
            })
            .catch(function (error) {
                console.error("Error deleting comment:", error);
                alert("An error occurred while deleting the comment.");
            });
    };

    // -------------------------
    // Load more comments (client-side)
    // -------------------------
    document.addEventListener("click", function (e) {
        var trigger = e.target.closest(".load-more-comments");
        if (!trigger) return;
        e.preventDefault();
        var step = parseInt(trigger.dataset.step) || 5;
        var card = trigger.closest(".card");
        var lists = card ? card.querySelectorAll("ul.comment-wrap") : null;
        var list = lists && lists.length ? lists[lists.length - 1] : null;
        if (!list) return;
        var hiddenItems = Array.from(
            list.querySelectorAll("li.comment-item.d-none")
        );
        hiddenItems.slice(0, step).forEach(function (li) {
            li.classList.remove("d-none");
        });
        if (list.querySelectorAll("li.comment-item.d-none").length === 0) {
            var footer = trigger.closest(".card-footer");
            if (footer) footer.remove();
        }
    });

    // -------------------------
    // Stories init (expects window.storiesData)
    // -------------------------
    document.addEventListener("DOMContentLoaded", function () {
        var currentTime = Math.floor(Date.now() / 1000);
        var storiesData = Array.isArray(window.storiesData)
            ? window.storiesData
            : [];
        var filteredStories = storiesData
            .map(function (story) {
                story.items = story.items.filter(function (item) {
                    return currentTime - item.time <= 7200;
                });
                return story;
            })
            .filter(function (story) {
                return story.items.length > 0;
            });
        if (typeof initZuckStories === "function") {
            initZuckStories(filteredStories);
        }
    });

    // -------------------------
    // delete stories (expects window.deleteStoryRouteTemplate)
    // -------------------------
    window.deleteStory = function (storyId) {
        var tpl = window.deleteStoryRouteTemplate || "";
        var url = tpl
            ? tpl.replace("__ID__", storyId)
            : "/user/stories/" + storyId;
        fetch(url, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": getCsrfToken(),
                "Content-Type": "application/json",
            },
        })
            .then(function (res) {
                return res.json();
            })
            .then(function (data) {
                if (data.success) {
                    alert("Story deleted");
                    location.reload();
                } else {
                    alert("Failed to delete story");
                }
            })
            .catch(function (err) {
                console.error("Error deleting story:", err);
            });
    };

    // -------------------------
    // GLightbox init
    // -------------------------
    document.addEventListener("DOMContentLoaded", function () {
        if (typeof GLightbox === "function") {
            GLightbox({ selector: ".glightbox" });
        }
    });

    // -------------------------
    // Edit / Delete Post modals (generic /posts routes)
    // -------------------------
    $(document).ready(function () {
        $(".edit-post").on("click", function (e) {
            e.preventDefault();
            var postId = $(this).data("id");
            $.ajax({
                url: "/posts/" + postId + "/edit",
                type: "GET",
                success: function (response) {
                    $("#editPostModal #editPostContent").val(response.content);
                    $("#editPostModal #editPostId").val(postId);
                    $("#editPostModal").modal("show");
                },
                error: function () {
                    alert("Error fetching post details.");
                },
            });
        });

        $(".delete-post").on("click", function (e) {
            e.preventDefault();
            var postId = $(this).data("id");
            if (confirm("Are you sure you want to delete this post?")) {
                $.ajax({
                    url: "/posts/" + postId,
                    type: "DELETE",
                    data: { _token: getCsrfToken() },
                    success: function () {
                        alert("Post deleted successfully.");
                        location.reload();
                    },
                    error: function () {
                        alert("Failed to delete the post.");
                    },
                });
            }
        });
    });

    // -------------------------
    // Edit Post form submit
    // -------------------------
    $("#editPostForm").on("submit", function (e) {
        e.preventDefault();
        var postId = $("#editPostId").val();
        var content = $("#editPostContent").val();
        $.ajax({
            url: "/posts/" + postId,
            type: "PUT",
            data: {
                _token: getCsrfToken(),
                content: content,
            },
            success: function () {
                $("#editPostModal").modal("hide");
                alert("Post updated successfully.");
                location.reload();
            },
            error: function () {
                alert("Failed to update post.");
            },
        });
    });

    // -------------------------
    // Comment form submit (AJAX)
    // -------------------------
    $(document).on("submit", ".commentForm", function (e) {
        e.preventDefault();
        var form = $(this);
        var postId = form.data("post-id");
        var textarea = form.find(".commentInput");
        var errorDiv = form.find(".comment-error");
        var commentList = form.closest(".card-body").find(".comment-wrap");
        errorDiv.text("");
        if ($.trim(textarea.val()) === "") {
            errorDiv.text("Comment is required.");
            textarea.focus();
            return false;
        }
        var formData = form.serialize();
        $.ajax({
            url: form.attr("action"),
            method: "POST",
            data: formData,
            success: function (response) {
                if (response.status === "success") {
                    textarea.val("");
                    var newComment =
                        '\n<li class="comment-item mb-3" id="comment-' +
                        response.comment.id +
                        '">\n    <div class="d-flex position-relative">\n        <div class="avatar avatar-xs">\n            <a href="' +
                        response.comment.member_profile_url +
                        '">\n                <img class="avatar-img rounded-circle"\n                     src="' +
                        response.comment.member_avatar +
                        '"\n                     alt="" loading="lazy" decoding="async">\n            </a>\n        </div>\n        <div class="ms-2 w-100">\n            <div class="bg-light rounded-start-top-0 p-3 rounded">\n                <div class="d-flex justify-content-between">\n                    <h6 class="mb-1">\n                        <a href="' +
                        response.comment.member_profile_url +
                        '">' +
                        response.comment.member_name +
                        '</a>\n                    </h6>\n                    <small class="ms-2">Just now</small>\n                </div>\n                <p class="small mb-0" id="comment-text-' +
                        response.comment.id +
                        '">' +
                        response.comment.parsed_comment +
                        "</p>\n            </div>\n        </div>\n    </div>\n</li>\n";
                    commentList.prepend(newComment);
                    var countSpan = form
                        .closest(".card")
                        .find(".comment-count");
                    var count =
                        parseInt(countSpan.text().replace(/[()]/g, "")) || 0;
                    countSpan.text("(" + (count + 1) + ")");
                } else {
                    errorDiv.text(response.message || "Failed to add comment.");
                }
            },
            error: function (xhr) {
                if (
                    xhr.responseJSON &&
                    xhr.responseJSON.errors &&
                    xhr.responseJSON.errors.comment
                ) {
                    errorDiv.text(xhr.responseJSON.errors.comment[0]);
                } else {
                    errorDiv.text("An error occurred.");
                }
            },
        });
    });

    // -------------------------
    // Bootstrap tooltips init
    // -------------------------
    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    // -------------------------
    // Demo mention suggestions (unused helper)
    // -------------------------
    window.showMentionSuggestions = function (textarea, query) {
        var suggestionsBox = document.getElementById("mention-suggestions");
        var users = [
            {
                id: 1,
                name: "Sutanu Behria",
                service: "IAS",
                avatar: "/feed_assets/images/avatar/07.jpg",
                username: "sutanu",
            },
            {
                id: 2,
                name: "Virender Kumar",
                service: "IPS",
                avatar: "/feed_assets/images/avatar/06.jpg",
                username: "virender",
            },
        ];
        var filtered = users.filter(function (u) {
            return (
                u.name.toLowerCase().includes(query.toLowerCase()) ||
                u.username.toLowerCase().includes(query.toLowerCase())
            );
        });
        var html = filtered
            .map(function (u) {
                return (
                    '\n        <div class="mention-item" data-username="' +
                    u.username +
                    '">\n            <img src="' +
                    u.avatar +
                    '" class="mention-avatar">\n            <div class="mention-text">\n                <span class="mention-name">' +
                    u.name +
                    '</span>\n                <span class="mention-service">' +
                    u.service +
                    "</span>\n            </div>\n        </div>\n    "
                );
            })
            .join("");
        if (suggestionsBox) {
            suggestionsBox.innerHTML =
                html ||
                '<div class="px-3 py-2 text-muted small">No matches</div>';
            var rect = textarea.getBoundingClientRect();
            suggestionsBox.style.top = rect.bottom + window.scrollY + "px";
            suggestionsBox.style.left = rect.left + window.scrollX + "px";
            suggestionsBox.classList.remove("d-none");
            suggestionsBox
                .querySelectorAll(".mention-item")
                .forEach(function (item) {
                    item.addEventListener("click", function () {
                        insertMention(textarea, this.dataset.username);
                        hideMentionSuggestions();
                    });
                });
        }
    };
})();

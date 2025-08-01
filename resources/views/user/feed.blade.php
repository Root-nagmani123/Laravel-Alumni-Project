   @extends('layouts.app')

   @section('title', 'User Feed - Alumni | Lal Bahadur Shastri National Academy of Administration')

   @section('content')
   <div class="container-fluid">
       <div class="row g-4">
           <div class="col-4 left-sidebar">
            <div class="row">
                <div class="col-6"></div>
                <div class="col-6">
                    @include('partials.left-sidebar')
                </div>
            </div>
           </div>

           <div class="col-4 vstack gap-4 mx-auto" style="margin-top: 100px !important;">
               <div class="row">
                   @include('partials.user_feed')
               </div>
           </div>
           <div class="col-4 right-sidebar">
               <div class="row">
                   <div class="col-6">
                       @include('partials.right-sidebar')
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!-- Modal create Feed photo START -->
   <div class="modal fade" id="feedActionPhoto" tabindex="-1" aria-labelledby="feedActionPhotoLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
           <form class="modal-content" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
               @csrf

               <!-- Modal header -->
               <div class="modal-header">
                   <h5 class="modal-title" id="feedActionPhotoLabel">Add post photo</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>

               <!-- Modal body -->
               <div class="modal-body">
                   <div class="d-flex mb-3">
                       <!-- User avatar -->
                       <div class="avatar avatar-xs me-2">
                           @php
                           $profilePic = $user->profile_pic ?? null;
                           @endphp
                           <img class="avatar-img rounded-circle"
                               src="{{ $profilePic ? asset('storage/' . $profilePic) : asset('feed_assets/images/avatar/03.jpg') }}"
                               alt="User Avatar">
                       </div>
                       <!-- Post textarea -->
                       <textarea class="form-control pe-4 fs-3 lh-1 border-0" name="modalContent" rows="5"
                           placeholder="Share your thoughts..."></textarea>
                   </div>

                   <!-- File upload -->
                   <div class="mb-3">
                       <label class="form-label">Upload attachment</label>
                       <div id="drop-area" class="drop-area p-4 text-center border border-secondary rounded">
                           <i class="bi bi-images fs-1 mb-2 d-block"></i>
                           <span class="d-block">Drag & Drop image here or click to browse.</span>
                           <input type="file" id="media" name="media[]" multiple class="d-none" accept="image/*">
                           <div id="preview" class="mt-3 d-flex flex-wrap gap-3"></div>
                       </div>
                   </div>

                   <!-- Optional video link -->
                   <input class="form-control mt-2" type="text" name="video_link" placeholder="Video Link (optional)" />
               </div>

               <!-- Modal footer -->
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger-soft" data-bs-dismiss="modal">Cancel</button>
                   <button type="submit" class="btn btn-success-soft">Post</button>
               </div>
           </form>
       </div>
   </div>

   <div class="modal fade" id="groupActionpost" tabindex="-1" aria-labelledby="groupActionpostLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
           <form class="modal-content" action="{{ route('user.group.post')}}" method="POST"
               enctype="multipart/form-data">
               @csrf

               <!-- Modal header -->
               <div class="modal-header">
                   <h5 class="modal-title" id="groupActionpostLabel">Add Group post in <span class="group_name"></span>
                   </h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>

               <!-- Modal body -->
               <div class="modal-body">
                   <div class="d-flex mb-3">
                       <!-- User avatar -->
                       <div class="avatar avatar-xs me-2">
                           @php
                           $profilePic = $user->profile_pic ?? null;
                           @endphp
                           <img class="avatar-img rounded-circle"
                               src="{{ $profilePic ? asset('storage/' . $profilePic) : asset('feed_assets/images/avatar/03.jpg') }}"
                               alt="User Avatar">
                       </div>
                       <!-- Post textarea -->
                       <input type="hidden" name="group_id" class="group_id">
                       <textarea class="form-control pe-4 fs-3 lh-1 border-0" name="modalContent" rows="2"
                           placeholder="Share your thoughts..."></textarea>
                   </div>

                   <!-- File upload -->
                   <div class="mb-3">
                       <label class="form-label">Upload attachment</label>
                       <div id="drop-area" class="drop-area p-4 text-center border border-secondary rounded">

                           <i class="bi bi-images fs-1 mb-2 d-block"></i>
                           <span class="d-block">Drag & Drop image here or click to browse.</span>
                           <input type="file" id="media" name="media[]" multiple class="" accept="image/*">
                           <div id="preview" class="mt-3 d-flex flex-wrap gap-3"></div>
                       </div>
                   </div>
                   <!-- Optional video link -->
                   <input class="form-control mt-2" type="text" name="video_link" placeholder="Video Link (optional)" />
               </div>

               <!-- Modal footer -->
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger-soft" data-bs-dismiss="modal">Cancel</button>
                   <button type="submit" class="btn btn-success-soft">Post</button>
               </div>
           </form>
       </div>
   </div>
   <!-- Modal create Feed photo END -->







   <script>
/*  */

document.addEventListener("DOMContentLoaded", function() {
    const dropArea = document.getElementById("drop-area");
    const input = document.getElementById("media");
    const preview = document.getElementById("preview");

    // Show preview
    function showFiles(files) {
        preview.innerHTML = ''; // Clear old previews
        [...files].forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                let mediaElement;
                if (file.type.startsWith('image/')) {
                    mediaElement = document.createElement('img');
                    mediaElement.src = e.target.result;
                    mediaElement.style.width = "100px";
                    mediaElement.style.height = "100px";
                    mediaElement.style.objectFit = "cover";
                } else if (file.type.startsWith('video/')) {
                    mediaElement = document.createElement('video');
                    mediaElement.src = e.target.result;
                    mediaElement.controls = true;
                    mediaElement.style.width = "100px";
                    mediaElement.style.height = "100px";
                }
                preview.appendChild(mediaElement);
            };
            reader.readAsDataURL(file);
        });
    }

    // Open file dialog on drop area click
    dropArea.addEventListener("click", () => input.click());

    // Handle file selection from dialog
    input.addEventListener("change", () => showFiles(input.files));

    // Drag & drop support
    ['dragenter', 'dragover'].forEach(evt =>
        dropArea.addEventListener(evt, e => {
            e.preventDefault();
            dropArea.classList.add('border-primary');
        })
    );

    ['dragleave', 'drop'].forEach(evt =>
        dropArea.addEventListener(evt, e => {
            e.preventDefault();
            dropArea.classList.remove('border-primary');
        })
    );

    dropArea.addEventListener("drop", e => {
        const dt = e.dataTransfer;
        const files = dt.files;
        input.files = files;
        showFiles(files);
    });
});




// Like post
function bindLikeForms() {
    document.querySelectorAll('.like-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const postId = form.dataset.postId;
            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': formData.get('_token')
                    },
                    body: formData
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('like-section-' + postId).innerHTML = html;
                    // 👇 re-bind like button inside the new HTML
                    bindLikeForms();
                });
        });
    });
}

// Initial bind when DOM is ready
document.addEventListener('DOMContentLoaded', bindLikeForms);


function toggleComments(postId) {
    const box = document.getElementById('comments-' + postId);
    box.style.display = box.style.display === 'none' ? 'block' : 'none';
}


document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.copy-url-btn');

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const urlToCopy = this.getAttribute('data-url');

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(urlToCopy)
                    .then(() => {
                        alert('Profile link copied to clipboard!');
                    })
                    .catch(err => {
                        console.error('Clipboard API failed:', err);
                    });
            } else {
                // Fallback method
                const tempInput = document.createElement('input');
                document.body.appendChild(tempInput);
                tempInput.value = urlToCopy;
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
                alert('Profile link copied (fallback method).');
            }
        });
    });
});
   </script>



   @endsection
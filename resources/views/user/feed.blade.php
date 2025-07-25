   @extends('layouts.app')

   @section('title', 'User Feed - Alumni | Lal Bahadur Shastri National Academy of Administration')

   @section('content')
   <style>
    .loading-text {
        position: fixed;
        left: 0;
        top: 0;
        width: 100vw;
        height: 100vh;
        z-index: 9999;
        background-color: #af2910; /* LBSNAA maroon */
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .animate {
        font-size: 2.5rem;
        font-weight: bold;
        color: #fff;
        text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        animation: pulseText 1.2s ease-in-out infinite alternate;
    }

    @keyframes pulseText {
        from {
            transform: scale(1);
            opacity: 0.7;
        }
        to {
            transform: scale(1.1);
            opacity: 1;
        }
    }
</style>

<!-- Loader -->
<div class="loading-text" id="pageLoader">
    <h1 class="animate">LBSNAA Alumni</h1>
</div>

   <div class="container">
       <div class="row g-4">
           @include('partials.left-sidebar')
           @include('partials.user_feed')
           @include('partials.right-sidebar')
       </div>
   </div>

<style>

</style>



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


       <!-- accessibility panel -->
       <div class="uwaw uw-light-theme gradient-head uwaw-initial paid_widget" id="uw-main">
           <div class="relative second-panel" style="background-color: #792421;">
               <h3>Accessibility options by LBSNAA</h3>
               <div class="uwaw-close" onclick="closeMain()"></div>
           </div>
           <div class="uwaw-body">
               <div class="h-scroll" style="height: calc(100vh - 200px) !important;">
                   <div class="uwaw-features">
                       <div class="uwaw-features__item reset-feature" id="featureItem_sp"> <button id="speak"
                               class="uwaw-features__item__i" data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-speaker"> </span>
                               </span>
                               <span class="uwaw-features__item__name">Text To Speech</span> <span
                                   class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon_sp"
                                   style="display: none"> </span> </button> </div>
                       <div class="uwaw-features__item reset-feature" id="featureItem"> <button id="btn-s9"
                               class="uwaw-features__item__i" data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-bigger-text"> </span>
                               </span><span class="uwaw-features__item__name">Bigger Text</span>
                               <div class="uwaw-features__item__steps reset-steps" id="featureSteps">
                                   <!-- Steps span tags will be dynamically added here -->
                               </div> <span class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon"
                                   style="display: none"> </span>
                           </button> </div>
                       <div class="uwaw-features__item reset-feature" id="featureItem-st"> <button id="btn-small-text"
                               class="uwaw-features__item__i" data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-small-text"> </span>
                               </span><span class="uwaw-features__item__name">Small Text</span>
                               <div class="uwaw-features__item__steps reset-steps" id="featureSteps-st">
                                   <!-- Steps span tags will be dynamically added here -->
                               </div> <span class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-st"
                                   style="display: none"> </span>
                           </button> </div>
                       <div class="uwaw-features__item reset-feature" id="featureItem-lh"> <button id="btn-s12"
                               class="uwaw-features__item__i" data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-line-hight"> </span>
                               </span> <span class="uwaw-features__item__name">Line Height</span>
                               <div class="uwaw-features__item__steps reset-steps" id="featureSteps-lh">
                                   <!-- Steps span tags will be dynamically added here -->
                               </div> <span class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-lh"
                                   style="display: none"> </span>
                           </button> </div>
                       <div class="uwaw-features__item reset-feature" id="featureItem-ht"> <button id="btn-s10"
                               onclick="highlightLinks()" class="uwaw-features__item__i"
                               data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-highlight-links">
                                   </span>
                               </span> <span class="uwaw-features__item__name">Highlight Links</span> <span
                                   class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-ht"
                                   style="display: none"> </span> </button> </div>
                       <div class="uwaw-features__item reset-feature" id="featureItem-ts"> <button id="btn-s13"
                               onclick="increaseAndReset()" class="uwaw-features__item__i"
                               data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-text-spacing"> </span>
                               </span> <span class="uwaw-features__item__name">Text Spacing</span>
                               <div class="uwaw-features__item__steps reset-steps" id="featureSteps-ts">
                                   <!-- Steps span tags will be dynamically added here -->
                               </div> <span class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-ts"
                                   style="display: none"> </span>
                           </button> </div>
                       <div class="uwaw-features__item reset-feature" id="featureItem-df"> <button id="btn-df"
                               onclick="toggleFontFeature()" class="uwaw-features__item__i"
                               data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-dyslexia-font">
                                   </span>
                               </span> <span class="uwaw-features__item__name">Dyslexia Friendly</span> <span
                                   class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-df"
                                   style="display: none"> </span> </button> </div>
                       <div class="uwaw-features__item reset-feature" id="featureItem-hi"> <button id="btn-s11"
                               onclick="toggleImages()" class="uwaw-features__item__i"
                               data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-hide-images"> </span>
                               </span> <span class="uwaw-features__item__name">Hide Images</span> <span
                                   class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-hi"
                                   style="display: none"> </span> </button> </div>
                       <div class="uwaw-features__item reset-feature" id="featureItem-Cursor"> <button id="btn-cursor"
                               onclick="toggleCursorFeature()" class="uwaw-features__item__i"
                               data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-cursor"> </span>
                               </span>
                               <span class="uwaw-features__item__name">Cursor</span> <span
                                   class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-cursor"
                                   style="display: none"> </span> </button> </div>
                       <div class="uwaw-features__item reset-feature" id="featureItem-ht-dark"> <button id="dark-btn"
                               class="uwaw-features__item__i" data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__name"> <span class="light_dark_icon"> <input
                                           type="checkbox" class="light_mode uwaw-featugres__item__i" id="checkbox" />
                                       <label for="checkbox" class="checkbox-label">
                                           <!-- <i class="fas fa-moon-stars"></i> --> <i class="fas fa-moon-stars">
                                               <span class="ux4g-icon icon-moon"></span> </i> <i class="fas fa-sun">
                                               <span class="ux4g-icon icon-sun"></span> </i> <span class="ball"></span>
                                       </label> </span> <span class="uwaw-features__item__name">Light-Dark</span>
                               </span>
                               <span class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-ht-dark"
                                   style="display: none; pointer-events: none"> </span> </button> </div>
                       <!-- Invert Colors Widget -->
                       <div class="uwaw-features__item reset-feature" id="featureItem-ic"> <button id="btn-invert"
                               class="uwaw-features__item__i" data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-invert"> </span>
                               </span>
                               <span class="uwaw-features__item__name">Invert Colors</span> <span
                                   class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-ic"
                                   style="display: none"> </span> </button> </div>
                   </div>
               </div> <!-- Reset Button -->
           </div>
           <div class="reset-panel">
               <!-- copyright accessibility bar -->
               <div class="copyrights-accessibility"> <button class="btn-reset-all" id="reset-all" onclick="resetAll()">
                       <span class="reset-icon"> </span> <span class="reset-btn-text">Reset All Settings</span>
                   </button>
               </div>
           </div>
       </div>
       <button id="uw-widget-custom-trigger" class="uw-widget-custom-trigger" aria-label="Accessibility Widget"
           data-uw-trigger="true" aria-haspopup="dialog" style="background-color: #792421;"><img
               src="data:image/svg+xml,%0A%3Csvg width='32' height='32' viewBox='0 0 32 32' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cg clip-path='url(%23clip0_1_1506)'%3E%3Cpath d='M16 7C15.3078 7 14.6311 6.79473 14.0555 6.41015C13.4799 6.02556 13.0313 5.47894 12.7664 4.83939C12.5015 4.19985 12.4322 3.49612 12.5673 2.81719C12.7023 2.13825 13.0356 1.51461 13.5251 1.02513C14.0146 0.535644 14.6383 0.202301 15.3172 0.0672531C15.9961 -0.0677952 16.6999 0.00151652 17.3394 0.266423C17.9789 0.53133 18.5256 0.979934 18.9101 1.55551C19.2947 2.13108 19.5 2.80777 19.5 3.5C19.499 4.42796 19.1299 5.31762 18.4738 5.97378C17.8176 6.62994 16.928 6.99901 16 7Z' fill='white'/%3E%3Cpath d='M27 7.05L26.9719 7.0575L26.9456 7.06563C26.8831 7.08313 26.8206 7.10188 26.7581 7.12125C25.595 7.4625 19.95 9.05375 15.9731 9.05375C12.2775 9.05375 7.14313 7.67875 5.50063 7.21188C5.33716 7.14867 5.17022 7.09483 5.00063 7.05063C3.81313 6.73813 3.00063 7.94438 3.00063 9.04688C3.00063 10.1388 3.98188 10.6588 4.9725 11.0319V11.0494L10.9238 12.9081C11.5319 13.1413 11.6944 13.3794 11.7738 13.5856C12.0319 14.2475 11.8256 15.5581 11.7525 16.0156L11.39 18.8281L9.37813 29.84C9.37188 29.87 9.36625 29.9006 9.36125 29.9319L9.34688 30.0112C9.20188 31.0206 9.94313 32 11.3469 32C12.5719 32 13.1125 31.1544 13.3469 30.0037C13.5813 28.8531 15.0969 20.1556 15.9719 20.1556C16.8469 20.1556 18.6494 30.0037 18.6494 30.0037C18.8838 31.1544 19.4244 32 20.6494 32C22.0569 32 22.7981 31.0162 22.6494 30.0037C22.6363 29.9175 22.6206 29.8325 22.6019 29.75L20.5625 18.8294L20.2006 16.0169C19.9387 14.3788 20.1494 13.8375 20.2206 13.7106C20.2225 13.7076 20.2242 13.7045 20.2256 13.7013C20.2931 13.5763 20.6006 13.2963 21.3181 13.0269L26.8981 11.0763C26.9324 11.0671 26.9662 11.0563 26.9994 11.0438C27.9994 10.6688 28.9994 10.15 28.9994 9.04813C28.9994 7.94625 28.1875 6.73813 27 7.05Z' fill='white'/%3E%3C/g%3E%3Cdefs%3E%3CclipPath id='clip0_1_1506'%3E%3Crect width='32' height='32' fill='white'/%3E%3C/clipPath%3E%3C/defs%3E%3C/svg%3E%0A"><span
               class="text-white">Accessibility
               Options</span></button><!-- accessibility panel end-->




       <script>
       /*  */

        document.addEventListener("DOMContentLoaded", function () {
    const dropArea = document.getElementById("drop-area");
    const input = document.getElementById("media");
    const preview = document.getElementById("preview");

    // Show preview
    function showFiles(files) {
        preview.innerHTML = ''; // Clear old previews
        [...files].forEach(file => {
            const reader = new FileReader();
            reader.onload = function (e) {
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

<script>
    window.addEventListener('load', function () {
        const loader = document.getElementById('pageLoader');
        if (loader) {
            loader.style.transition = 'opacity 0.6s ease';
            loader.style.opacity = 0;
            setTimeout(() => loader.style.display = 'none', 600);
        }
    });
</script>


       @endsection

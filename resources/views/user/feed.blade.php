   @extends('layouts.app')

   @section('title', 'User Feed - Alumni | Lal Bahadur Shastri National Academy of Administration')

   @section('content')
<style>

   .avatar {
    display: inline-block;
    position: relative;
}

.status-dot {
    position: absolute;
    top: -4px;
    left: -4px;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    border: 2px solid white;
    z-index: 2;

.status-dot.green {
    background-color: #28a745; /* green */
}

.status-dot.orange {
    background-color: #fd7e14; /* orange */
}
.rounded-circle {
    border-radius: 50%;
    object-fit: cover;
}
</style>

   <!-- Main Content start -->
   <i class="fa-light fa-face-awesome"></i>
   <main class="main-content">
       <div class="container sidebar-toggler">
           <div class="row">
               @include('partials.left-sidebar')
               <div class="col-xxl-6 col-xl-5 col-lg-8 mt-0 mt-lg-10 mt-xl-0 d-flex flex-column gap-7 cus-z">
                   <div class="story-carousel">
                       <div class="single-item">
                           <div class="single-slide">
                               <a href="#" class="position-relative d-center">
                                   <img class="bg-img" src="{{asset('feed_assets/images/story-slider-owner.png')}}"
                                       alt="icon">
                                   <div class="abs-area d-grid p-3 position-absolute bottom-0">
                                       <div class="icon-box m-auto d-center mb-3">
                                           <i class="material-symbols-outlined text-center mat-icon"> add </i>
                                       </div>
                                       <span class="mdtxt">Add Story</span>
                                   </div>
                               </a>
                           </div>
                       </div>
                       <div class="single-item">
                           <div class="single-slide">
                               <div class="position-relative d-flex">
                                   <img class="bg-img" src="{{asset('feed_assets/images/story-slider-1.png')}}"
                                       alt="image">
                                   <a href="public-profile-post.html" class="abs-area p-3 position-absolute bottom-0">
                                       <img src="{{asset('feed_assets/images/avatar-1.png')}}" alt="image">
                                       <span class="mdtxt">Alen Lio</span>
                                   </a>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="share-post d-flex gap-3 gap-sm-5 p-3 p-sm-5">
                       <div class="profile-box">
                           <a href="#"><img src="{{asset('feed_assets/images/add-post-avatar.png')}}" class="max-un"
                                   alt="icon"></a>
                       </div>
                       <form id="create-post-form" enctype="multipart/form-data" class="w-100 position-relative">
                           <textarea name="content" cols="10" rows="2"
                               placeholder="Write something to Lerio.." ></textarea>
                           <input type="file" name="media[]" multiple class="d-none" id="mediaInput"> <!-- Required -->

                           <div class="abs-area position-absolute d-none d-sm-block">
                               <i class="material-symbols-outlined mat-icon xxltxt"> sentiment_satisfied </i>
                           </div>
                           <ul class="d-flex text-end mt-3 gap-3">
                               <li class="d-flex gap-2" data-bs-toggle="modal" data-bs-target="#goLiveMod">
                                   <img src="{{asset('feed_assets/images/icon/live-video.png')}}" class="max-un"
                                       alt="icon">
                                   <span>Live</span>
                               </li>
                               <li class="d-flex gap-2" data-bs-toggle="modal" data-bs-target="#photoVideoMod">
                                   <img src="{{asset('feed_assets/images/icon/vgallery.png')}}" class="max-un"
                                       alt="icon">
                                   <span>Photo/Video</span>


                               </li>

                           </ul>
                       </form>

                   </div>
                   <div class="post-item d-flex flex-column gap-5 gap-md-7" id="news-feed">
				   @foreach($posts as $post)
<div class="post-single-box p-3 p-sm-5">
    <div class="top-area pb-5">
        <div class="profile-area d-center justify-content-between">
            <div class="avatar-item d-flex gap-3 align-items-center">
                @php
                    $member = $post->member;
                    $profileImage = $member && $member->profile_image
                        ? asset('storage/' . $member->profile_image)
                        : asset('feed_assets/images/avatar-1.png');
                @endphp

                <div class="avatar position-relative">
                    <img class="avatar-img max-un" src="{{ $profileImage }}" alt="avatar">
                </div>
                <div class="info-area">
                    <h6 class="m-0"><a href="{{ url('/user/profile/' . $member->id) }}">{{ $member->name ?? 'Unknown' }}</a></h6>
                    <span class="mdtxt status">{{ $post->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>

                               <div class="py-4">
                                   <p class="description">{{ $post->content }}</p>
                               </div>

                               {{-- Media --}}
                               @php
                               $validMedia = $post->media->filter(function($media) {
                               return file_exists(storage_path('app/public/' . $media->file_path));
                               });

                               $imageMedia = $validMedia->where('file_type', 'image')->values();
                               $totalImages = $imageMedia->count();
                               @endphp

                               @if($totalImages === 1)
                               <div class="post-img mt-2">
                                   <a href="{{ asset('storage/' . $imageMedia[0]->file_path) }}" class="glightbox"
                                       data-gallery="post-gallery-{{ $post->id }}">
                                       <img src="{{ asset('storage/' . $imageMedia[0]->file_path) }}" loading="lazy"
                                           class="w-100" alt="Post Image">
                                   </a>
                               </div>
                               @elseif($totalImages > 1)
                               <div class="post-img d-flex justify-content-between flex-wrap gap-2 gap-lg-3 mt-2">
                                   @foreach($imageMedia->take(4) as $index => $media)
                                   <div class="position-relative" style="width: 48%;">
                                       <a href="{{ asset('storage/' . $media->file_path) }}" class="glightbox"
                                           data-gallery="post-gallery-{{ $post->id }}">
                                           <img src="{{ asset('storage/' . $media->file_path) }}" alt="Post Image"
                                               loading="lazy" class="w-100">
                                       </a>
                                       @if($index === 3 && $totalImages > 4)
                                       {{-- Hidden extra images --}}
                                       @foreach($imageMedia->slice(4) as $extra)
                                       <a href="{{ asset('storage/' . $extra->file_path) }}" class="glightbox d-none"
                                           data-gallery="post-gallery-{{ $post->id }}"></a>
                                       @endforeach

                                       {{-- Overlay link to trigger the rest of the images --}}
                                       <a href="{{ asset('storage/' . $imageMedia[4]->file_path) }}"
                                           class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white glightbox"
                                           style="background-color: rgba(0,0,0,0.6); font-size: 2rem; cursor: pointer;"
                                           data-gallery="post-gallery-{{ $post->id }}">
                                           +{{ $totalImages - 4 }}
                                       </a>
                                       @endif
                                   </div>
                                   @endforeach
                               </div>


    {{-- Modal for additional images --}}
    <div class="modal fade" id="moreImagesModal" tabindex="-1" aria-labelledby="moreImagesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">More Images</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-wrap gap-3">
                    @foreach($imageMedia->slice(4) as $media)
                        <a href="{{ asset('storage/' . $media->file_path) }}" class="glightbox" data-gallery="post-gallery">
                            <img src="{{ asset('storage/' . $media->file_path) }}" alt="Extra Image" class="img-fluid" style="width: 48%;">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif

    </div>
{{-- Display Videos --}}
@if ($post->media_type === 'video_link' && $post->video_link)
    <div class="post-video mt-2">
        <iframe class="w-100" height="315" src="{{ $post->video_link }}" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen loading="lazy"></iframe>
    </div>
@endif

    {{-- Reactions --}}
    <div class="total-react-share pb-4 d-center gap-2 flex-wrap justify-content-between">
        <div class="friends-list d-flex gap-3 align-items-center text-center">
            <ul class="d-flex align-items-center justify-content-center">
                @foreach($post->likes->take(3) as $like)
                    @php
                        $avatar = $like->member && $like->member->avatar
                            ? asset($like->member->avatar)
                            : asset('feed_assets/images/avatar-default.png');
                    @endphp
                    <li><img src="{{ $avatar }}" alt="image"></li>
                @endforeach
                @if($post->likes->count() > 3)
                    <li><span class="mdtxt d-center">{{ $post->likes->count() - 3 }}+</span></li>
                @endif
            </ul>
        </div>
        <div class="react-list d-flex flex-wrap gap-6 align-items-center text-center">

            <button class="mdtxt">
                {{ $post->comments?->count() ?? 0 }} Comments
            </button>
            <button class="mdtxt">{{ $post->shares ?? 0 }} Shares</button>
        </div>
    </div>

                           {{-- Action Buttons --}}
 <div
  class="like-comment-share py-5 d-center flex-wrap gap-3 gap-md-0 justify-content-between">

 @php
    $likeUsers = $post->likes->pluck('member.name')->filter()->join(', ');
@endphp


<div id="like-section-{{ $post->id }}">
    <form
        action="{{ route('user.post.like', $post->id) }}"
        method="POST"
        class="like-form d-inline"
        data-post-id="{{ $post->id }}"
    >
        @csrf
        <button type="submit"
            class="btn btn-sm {{ $post->likes->contains('member_id', auth('user')->id()) ? 'btn-primary' : 'btn-primary' }}"
            title="{{ $likeUsers ?: 'No likes yet' }}">
            {{ $post->likes->contains('member_id', auth('user')->id()) ? 'Unlike' : 'Like' }}
        </button>
        <span class="ms-2 text-muted">
            {{ $post->likes->count() }} {{ Str::plural('Like', $post->likes->count()) }}
        </span>
    </form>
</div>
	{{--@endif--}}
  <button class="d-center gap-1 gap-sm-2 mdtxt" onclick="toggleComments({{ $post->id }})">
            <i class="material-symbols-outlined mat-icon"> chat </i> Comment
        </button>
 <button
  class="copy-url-btn d-center gap-1 gap-sm-2 mdtxt"
  data-url="{{ url('/user/profile/' . $member->id) }}">
  <i class="material-symbols-outlined mat-icon">share</i> Share
</button>
    </div>
        <!-- Comments container -->
         <div id="comments-{{ $post->id }}" class="comments-box" style="display: none; margin-top: 10px;">
        @foreach ($post->comments as $comment)
<div class="comment-item mb-3 d-flex align-items-start" data-comment-id="{{ $comment->id }}">
    <img src="{{ $comment->member && $comment->member->profile_pic ? asset('storage/' . $comment->member->profile_pic) : asset('feed_assets/images/avatar-1.png') }}"
        alt="Profile Picture" class="rounded-circle me-2" width="40" height="40">
    <div class="comment-content">
        <strong>{{ $comment->member->name ?? 'Anonymous' }}</strong><br>
        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small><br>

        <div class="comment-text" id="comment-text-{{ $comment->id }}">
            {{ $comment->comment }}
        </div>

        @if(auth()->guard('user')->id() === $comment->member_id)
        <button class="btn btn-sm btn-link p-0 text-primary edit-comment-btn" data-comment-id="{{ $comment->id }}" data-comment="{{ $comment->comment }}">Edit</button>
        @endif
    </div>
</div>
@endforeach
</div>

                           {{-- Comment Form --}}
                           <!--<form action="{{-- route('user.comments.store') --}}" method="POST">
                               @csrf
                               <input type="hidden" name="post_id" value="{{ $post->id }}">
                               <div class="d-flex mt-5 gap-3">
                                   <div class="profile-box d-none d-xxl-block">
                                       <a href="#"><img src="{{ asset('feed_assets/images/add-post-avatar.png') }}"
                                               class="max-un" alt="icon"></a>
                                   </div>
                                   <div class="form-content input-area py-1 d-flex gap-2 align-items-center w-100">
                                       <input name="comment" placeholder="Write a comment.." required>
                                   </div>
                                   <div class="btn-area d-flex">
                                       <button class="cmn-btn px-2 px-sm-5 px-lg-6">
                                           <i class="material-symbols-outlined mat-icon m-0 fs-xxl"> near_me </i>
                                       </button>
                                   </div>
                               </div>
                           </form>-->

                           <form id="commentForm-{{ $post->id }}" action="{{ route('user.comments.store') }}" method="POST" class="comment-form" data-post-id="{{ $post->id }}">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <div class="d-flex mt-5 gap-3">
        <div class="profile-box d-none d-xxl-block">
            <a href="#"><img src="{{ asset('feed_assets/images/add-post-avatar.png') }}"
                    class="max-un" alt="icon"></a>
        </div>
        <div class="form-content input-area py-1 d-flex gap-2 align-items-center w-100">
            <input name="comment" id="commentInput-{{ $post->id }}" placeholder="Write a comment.." required>
        </div>
        <div class="btn-area d-flex">
            <button type="submit" class="cmn-btn px-2 px-sm-5 px-lg-6">
                <i class="material-symbols-outlined mat-icon m-0 fs-xxl"> near_me </i>
            </button>
        </div>
    </div>
</form>


                       </div>
                       @endforeach

                   </div>
               </div>
               @include('partials.right-sidebar')
           </div>
       </div>
   </main>
   <!-- Main Content end -->
   <!-- video popup start -->
   <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
       @csrf

       <div class="go-live-popup video-popup">
           <div class="container">
               <div class="row">
                   <div class="col-lg-8">
                       <div class="modal cmn-modal fade" id="photoVideoMod">
                           <div class="modal-dialog modal-dialog-centered">
                               <div class="modal-content p-5">
                                   <div class="modal-header justify-content-center">
                                       <button type="button" class="btn-close" data-bs-dismiss="modal"
                                           aria-label="Close">
                                           <i class="material-symbols-outlined mat-icon xxltxt"> close </i>
                                       </button>
                                   </div>
                                   <div class="top-content pb-5">
                                       <h5>Add post photo</h5>
                                   </div>
                                   <div class="mid-area">
                                       <div class="d-flex mb-5 gap-3">
                                           <div class="profile-box">

                                               @php
                                               $profilePic = $user->profile_pic ?? null;
                                               @endphp

                                               <img id="existingImage"
                                                   src="{{ $profilePic ? asset('storage/' . $profilePic) : asset('feed_assets/images/avatar-1.png') }}"
                                                   alt="avatar" alt="avatar" class="max-un" height="50" width="50">
                                           </div>
                                           <textarea name="modalContent" cols="10" rows="2"
                                               placeholder="Write something to Lerio.."></textarea>
                                       </div>
                                       <div class="file-upload">
                                           <label>Upload attachment</label>
                                           <div id="drop-area"
                                               class="drop-area mt-2 p-4 text-center border border-secondary rounded">
                                               <i class="material-symbols-outlined mat-icon mb-2 d-block"> perm_media
                                               </i>
                                               <span>Drag & Drop image here or click to browse.</span>
                                               <input type="file" id="media" name="media[]" multiple class="d-none"
                                                   accept="image/*">
                                               <div id="preview" class="mt-3 d-flex flex-wrap gap-3"></div>
                                           </div>

                                       </div>
                                   </div>
                                   <input class="form-control f-18 black mt-2" type="text" name="video_link"
                                       placeholder="Video Link .." />
                                   <div class="footer-area pt-5">
                                       <div class="btn-area d-flex justify-content-end gap-2">
                                           <button type="button" class="cmn-btn alt" data-bs-dismiss="modal"
                                               aria-label="Close">Cancel</button>
                                           <button type="submit" class="cmn-btn">Post</button>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </form>
   <!-- video popup end -->

   <!-- Modal (must be outside container) -->

   <!-- Go Live Popup end -->



   <!-- accessibility panel -->
   <div class="uwaw uw-light-theme gradient-head uwaw-initial paid_widget" id="uw-main">
       <div class="relative second-panel" style="background-color: #af2910;">
           <h3>Accessibility options by LBSNAA</h3>
           <div class="uwaw-close" onclick="closeMain()"></div>
       </div>
       <div class="uwaw-body">
           <div class="h-scroll" style="height: calc(100vh - 200px) !important;">
               <div class="uwaw-features">
                   <div class="uwaw-features__item reset-feature" id="featureItem_sp"> <button id="speak"
                           class="uwaw-features__item__i" data-uw-reader-content="Enable the UserWay screen reader"
                           aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                               class="uwaw-features__item__icon"> <span class="ux4g-icon icon-speaker"> </span> </span>
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
                               class="uwaw-features__item__icon"> <span class="ux4g-icon icon-highlight-links"> </span>
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
                               class="uwaw-features__item__icon"> <span class="ux4g-icon icon-dyslexia-font"> </span>
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
                               class="uwaw-features__item__icon"> <span class="ux4g-icon icon-cursor"> </span> </span>
                           <span class="uwaw-features__item__name">Cursor</span> <span
                               class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-cursor"
                               style="display: none"> </span> </button> </div>
                   <div class="uwaw-features__item reset-feature" id="featureItem-ht-dark"> <button id="dark-btn"
                           class="uwaw-features__item__i" data-uw-reader-content="Enable the UserWay screen reader"
                           aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                               class="uwaw-features__item__name"> <span class="light_dark_icon"> <input type="checkbox"
                                       class="light_mode uwaw-featugres__item__i" id="checkbox" /> <label for="checkbox"
                                       class="checkbox-label">
                                       <!-- <i class="fas fa-moon-stars"></i> --> <i class="fas fa-moon-stars"> <span
                                               class="ux4g-icon icon-moon"></span> </i> <i class="fas fa-sun"> <span
                                               class="ux4g-icon icon-sun"></span> </i> <span class="ball"></span>
                                   </label> </span> <span class="uwaw-features__item__name">Light-Dark</span> </span>
                           <span class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-ht-dark"
                               style="display: none; pointer-events: none"> </span> </button> </div>
                   <!-- Invert Colors Widget -->
                   <div class="uwaw-features__item reset-feature" id="featureItem-ic"> <button id="btn-invert"
                           class="uwaw-features__item__i" data-uw-reader-content="Enable the UserWay screen reader"
                           aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                               class="uwaw-features__item__icon"> <span class="ux4g-icon icon-invert"> </span> </span>
                           <span class="uwaw-features__item__name">Invert Colors</span> <span
                               class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-ic"
                               style="display: none"> </span> </button> </div>
               </div>
           </div> <!-- Reset Button -->
       </div>
       <div class="reset-panel">
           <!-- copyright accessibility bar -->
           <div class="copyrights-accessibility"> <button class="btn-reset-all" id="reset-all" onclick="resetAll()">
                   <span class="reset-icon"> </span> <span class="reset-btn-text">Reset All Settings</span> </button>
           </div>
       </div>
   </div>
   <button id="uw-widget-custom-trigger" class="uw-widget-custom-trigger" aria-label="Accessibility Widget"
       data-uw-trigger="true" aria-haspopup="dialog" style="background-color: #af2910;"><img
           src="data:image/svg+xml,%0A%3Csvg width='32' height='32' viewBox='0 0 32 32' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cg clip-path='url(%23clip0_1_1506)'%3E%3Cpath d='M16 7C15.3078 7 14.6311 6.79473 14.0555 6.41015C13.4799 6.02556 13.0313 5.47894 12.7664 4.83939C12.5015 4.19985 12.4322 3.49612 12.5673 2.81719C12.7023 2.13825 13.0356 1.51461 13.5251 1.02513C14.0146 0.535644 14.6383 0.202301 15.3172 0.0672531C15.9961 -0.0677952 16.6999 0.00151652 17.3394 0.266423C17.9789 0.53133 18.5256 0.979934 18.9101 1.55551C19.2947 2.13108 19.5 2.80777 19.5 3.5C19.499 4.42796 19.1299 5.31762 18.4738 5.97378C17.8176 6.62994 16.928 6.99901 16 7Z' fill='white'/%3E%3Cpath d='M27 7.05L26.9719 7.0575L26.9456 7.06563C26.8831 7.08313 26.8206 7.10188 26.7581 7.12125C25.595 7.4625 19.95 9.05375 15.9731 9.05375C12.2775 9.05375 7.14313 7.67875 5.50063 7.21188C5.33716 7.14867 5.17022 7.09483 5.00063 7.05063C3.81313 6.73813 3.00063 7.94438 3.00063 9.04688C3.00063 10.1388 3.98188 10.6588 4.9725 11.0319V11.0494L10.9238 12.9081C11.5319 13.1413 11.6944 13.3794 11.7738 13.5856C12.0319 14.2475 11.8256 15.5581 11.7525 16.0156L11.39 18.8281L9.37813 29.84C9.37188 29.87 9.36625 29.9006 9.36125 29.9319L9.34688 30.0112C9.20188 31.0206 9.94313 32 11.3469 32C12.5719 32 13.1125 31.1544 13.3469 30.0037C13.5813 28.8531 15.0969 20.1556 15.9719 20.1556C16.8469 20.1556 18.6494 30.0037 18.6494 30.0037C18.8838 31.1544 19.4244 32 20.6494 32C22.0569 32 22.7981 31.0162 22.6494 30.0037C22.6363 29.9175 22.6206 29.8325 22.6019 29.75L20.5625 18.8294L20.2006 16.0169C19.9387 14.3788 20.1494 13.8375 20.2206 13.7106C20.2225 13.7076 20.2242 13.7045 20.2256 13.7013C20.2931 13.5763 20.6006 13.2963 21.3181 13.0269L26.8981 11.0763C26.9324 11.0671 26.9662 11.0563 26.9994 11.0438C27.9994 10.6688 28.9994 10.15 28.9994 9.04813C28.9994 7.94625 28.1875 6.73813 27 7.05Z' fill='white'/%3E%3C/g%3E%3Cdefs%3E%3CclipPath id='clip0_1_1506'%3E%3Crect width='32' height='32' fill='white'/%3E%3C/clipPath%3E%3C/defs%3E%3C/svg%3E%0A"><span
           class="text-white">Accessibility
           Options</span></button><!-- accessibility panel end-->
   <!-- video popup start -->



           @section('scripts')
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
        form.addEventListener('submit', function (e) {
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


/*document.querySelectorAll('.comment-form').forEach(form => {
        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const postId = form.dataset.postId;
            const formData = new FormData(form);

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    alert(errorData.message || 'Validation failed');
                    return;
                }

                const data = await response.json();

                // Clear input
                document.getElementById('commentInput-' + postId).value = '';

                // Build comment HTML
                const newComment = document.createElement('div');
                newComment.classList.add('comment-item', 'mb-3', 'd-flex', 'align-items-start');
                newComment.innerHTML = `
                    <img src="${data.profile_pic}" alt="Profile Picture" class="rounded-circle me-2" width="40" height="40">
                    <div>
                        <strong>${data.member_name}</strong><br>
                        <small class="text-muted">${data.created_at}</small><br>
                        ${data.comment}
                    </div>
                `;

                // Prepend to comment list
                const commentList = document.getElementById('comments-' + postId);
                commentList.prepend(newComment);

                // Show the comments section if hidden
                commentList.style.display = 'block';

            } catch (err) {
                console.error('Error posting comment:', err);
                alert('An error occurred while posting your comment.');
            }
        });
    });
*/


document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.edit-comment-btn').forEach(button => {
        button.addEventListener('click', function () {
            const commentId = this.dataset.commentId;
            const commentText = this.dataset.comment;
            const commentDiv = document.getElementById(`comment-text-${commentId}`);

            // Replace text with input
            commentDiv.innerHTML = `
                <input type="text" id="edit-input-${commentId}" class="form-control form-control-sm mb-1" value="${commentText}">
                <button class="btn btn-sm btn-success" onclick="saveEditedComment(${commentId})">Save</button>
                <button class="btn btn-sm btn-secondary" onclick="cancelEdit(${commentId}, '${commentText.replace(/'/g, "\\'")}')">Cancel</button>
                 <button class="btn btn-sm btn-danger" onclick="deleteComment(${commentId})">Delete</button>
            `;
        });
    });
});

function cancelEdit(id, originalText) {
    document.getElementById(`comment-text-${id}`).innerHTML = originalText;
}

function saveEditedComment(id) {
    const newComment = document.getElementById(`edit-input-${id}`).value;

    fetch(`comments/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ comment: newComment })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`comment-text-${id}`).innerHTML = newComment;
        } else {
            alert(data.message || 'Failed to update comment');
        }
    })
    .catch(err => {
        console.error('Edit failed', err);
        alert('An error occurred while editing the comment.');
    });
}

function deleteComment(commentId) {
    if (!confirm('Are you sure you want to delete this comment?')) return;

    fetch(`{{ url('user/comments') }}/${commentId}`, {
        method: 'DELETE',
       /* headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }*/
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
    })
    .then(response => {
        if (!response.ok) throw new Error('Network response was not OK');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const commentElement = document.querySelector(`[data-comment-id="${commentId}"]`);
            if (commentElement) commentElement.remove();
        } else {
            alert(data.error || 'Failed to delete comment.');
        }
    })
    .catch(error => {
        console.error('Error deleting comment:', error);
        alert('An error occurred while deleting the comment.');
    });
}

    document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.copy-url-btn');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
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

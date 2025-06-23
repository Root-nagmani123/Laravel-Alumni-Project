   @extends('layouts.app')

   @section('title', 'User Feed - Alumni | Lal Bahadur Shastri National Academy of Administration')

   @section('content')
   <style>
        .file-preview-thumbnails {
            display: grid !important;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 12px;
            padding-top: 1rem;
        }

        .file-preview-frame {
            position: relative;
            height: 120px !important;
            border: 1px solid #ccc;
            border-radius: 6px;
            overflow: hidden;
            margin: 0 !important;
        }

        .file-preview-image {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover;
            cursor: pointer;
        }

        .file-footer-caption {
            display: none !important;
        }

        .file-thumbnail-footer {
            position: absolute;
            bottom: 4px;
            right: 4px;
            padding: 0;
            margin: 0;
            opacity: 0;
            background: transparent;
            transition: opacity 0.2s ease;
        }

        .file-preview-frame:hover .file-thumbnail-footer {
            opacity: 1;
        }

        .file-actions .kv-file-zoom,
        .file-actions .kv-file-remove {
            background: rgba(0, 0, 0, 0.65);
            color: #fff !important;
            border: none;
            border-radius: 50%;
            padding: 5px 7px;
            font-size: 14px;
            margin-left: 4px;
            cursor: pointer;
        }

		<!-- zoom effect -->


    .file-preview-frame:hover .edit-btn {
        opacity: 1;
        transition: opacity 0.3s;
    }

    .edit-btn {
        opacity: 0;
        position: absolute;
        top: 5px;
        right: 40px;
        z-index: 10;
    }

    .file-preview-image {
        cursor: zoom-in;
        transition: transform 0.3s ease;
    }

    .file-preview-image.zoomed {
        transform: scale(2.5);
        z-index: 999;
        position: relative;
    }


<!-- drop zone -->
   .drop-area {
        background-color: #f9f9f9;
        cursor: pointer;
        position: relative;
        transition: background-color 0.3s;
    }
    .drop-area.dragover {
        background-color: #e9ecef;
        border-color: #007bff;
    }
    .drop-area img,
    .drop-area video {
        max-width: 100px;
        max-height: 100px;
        object-fit: cover;
        border-radius: 6px;
    }
	  #preview img,
    #preview video {
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }


    .post-img img {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 8px;
}

.single.d-grid img {
    height: 150px;
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
                                   <img class="bg-img" src="{{asset('feed_assets/images/story-slider-owner.png')}}" alt="icon">
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
                                   <img class="bg-img" src="{{asset('feed_assets/images/story-slider-1.png')}}" alt="image">
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
                           <a href="#"><img src="{{asset('feed_assets/images/add-post-avatar.png')}}" class="max-un" alt="icon"></a>
                       </div>
                       <form id="create-post-form" enctype="multipart/form-data" class="w-100 position-relative">
    <textarea name="content" cols="10" rows="2" placeholder="Write something to Lerio.."></textarea>
    <input type="file" name="media[]" multiple class="d-none" id="mediaInput"> <!-- Required -->

    <div class="abs-area position-absolute d-none d-sm-block">
        <i class="material-symbols-outlined mat-icon xxltxt"> sentiment_satisfied </i>
    </div>
    <ul class="d-flex text-end mt-3 gap-3">
        <li class="d-flex gap-2" data-bs-toggle="modal" data-bs-target="#goLiveMod">
            <img src="{{asset('feed_assets/images/icon/live-video.png')}}" class="max-un" alt="icon">
            <span>Live</span>
        </li>
        <li class="d-flex gap-2" data-bs-toggle="modal" data-bs-target="#photoVideoMod">
           <img src="{{asset('feed_assets/images/icon/vgallery.png')}}" class="max-un" alt="icon">
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
                    <h6 class="m-0"><a href="#">{{ $member->name ?? 'Unknown' }}</a></h6>
                    <span class="mdtxt status">Active</span>
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

    $imageMedia = $validMedia->where('file_type', 'image');
    $videoMedia = $validMedia->where('file_type', 'video');
@endphp

{{-- Display Images --}}
@if($imageMedia->count() === 1)
    {{-- Single Image Full Width --}}
    <div class="post-img mt-2">
        <img src="{{ asset('storage/' . $imageMedia->first()->file_path) }}" loading="lazy" class="w-100" alt="Post Image">
    </div>
@elseif($imageMedia->count() > 1)
    {{-- Multiple Images: Facebook-style Layout --}}
    <div class="post-img d-flex justify-content-between flex-wrap gap-2 gap-lg-3 mt-2">
        @foreach($imageMedia->chunk(2) as $chunk)
            <div class="single {{ $chunk->count() > 1 ? 'd-grid gap-3' : '' }}">
                @foreach($chunk as $media)
                    <img src="{{ asset('storage/' . $media->file_path) }}" alt="Post Image" loading="lazy">
                @endforeach
            </div>
        @endforeach
    </div>
@endif

{{-- Display Videos --}}
@foreach($videoMedia as $media)
    <div class="post-img mt-2">
        <video class="w-100" controls loading="lazy">
            <source src="{{ asset('storage/' . $media->file_path) }}" type="video/mp4">
        </video>
    </div>
@endforeach
    </div>

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
            <!--<button class="mdtxt">{{ $post->comments?->count() ?? 0 }} Comments</button>-->
           <!-- Button -->
            <button class="mdtxt">
                {{ $post->comments?->count() ?? 0 }} Comments
            </button>
            <button class="mdtxt">{{ $post->shares ?? 0 }} Shares</button>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="like-comment-share py-5 d-center flex-wrap gap-3 gap-md-0 justify-content-between">
        <!--<button onclick="likePost({{ $post->id }})" class="d-center gap-1 gap-sm-2 mdtxt">
            <i class="material-symbols-outlined mat-icon"> favorite </i> Like
        </button>-->
  {{--@if(Auth::guard('user')->check())--}}
   <button
    onclick="likePost({{ $post->id }})"
    id="like-btn-{{ $post->id }}"
    class="d-center gap-1 gap-sm-2 mdtxt">
    {{ auth('member')->check() && $post->likes->contains('member_id', auth('member')->id()) ? 'Unlike' : 'Like' }}
</button>
	{{--@endif--}}



        <button class="d-center gap-1 gap-sm-2 mdtxt" onclick="toggleComments({{ $post->id }})">
            <i class="material-symbols-outlined mat-icon"> chat </i> Comment
        </button>
        <button class="d-center gap-1 gap-sm-2 mdtxt" >
            <i class="material-symbols-outlined mat-icon"> share </i> Share
        </button>
    </div>

<!-- Comments container -->
<div id="comments-{{ $post->id }}" class="comments-box" style="display: none; margin-top: 10px;">
    @forelse ($post->comments as $comment)
        <div class="comment-item mb-2">
            <strong>{{ $comment->member->name ?? '' }}</strong> {{ $comment->comment }}
        </div>
    @empty
        <p>No comments yet.</p>
    @endforelse
</div>

    {{-- Comment Form --}}
    <form action="{{ route('user.comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div class="d-flex mt-5 gap-3">
            <div class="profile-box d-none d-xxl-block">
                <a href="#"><img src="{{ asset('feed_assets/images/add-post-avatar.png') }}" class="max-un" alt="icon"></a>
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
    </form>
</div>
@endforeach

                 <!-- multiple images section -->



                       <!-- multiple images section -->

                   </div>
               </div>
  @include('partials.right-sidebar')
           </div>
       </div>
   </main>
   <!-- Main Content end -->
  <!-- video popup start -->
   <!--<form action="{{-- route('user.post.store') --}}" method="POST" enctype="multipart/form-data">-->
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
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="material-symbols-outlined mat-icon xxltxt"> close </i>
                                    </button>
                                </div>
                                <div class="top-content pb-5">
                                    <h5>Add post photo</h5>
                                </div>
                                <div class="mid-area">
                                    <div class="d-flex mb-5 gap-3">
                                        <div class="profile-box">
                                            <!--<a href="#"><img src="{{ asset('feed_assets/images/add-post-avatar.png') }}" class="max-un" alt="avatar"></a>-->
                                          {{-- @foreach($posts as $post)
    <img src="{{ $posts->profile_pic ? asset('assets/uploads/profile_pic/' . $post->profile_pic) : asset('feed_assets/images/avatar-1.png') }}" alt="avatar" class="max-un">
@endforeach--}}
 @php
    $profilePic = $user->profile_pic ?? null;
@endphp

<img id="existingImage"
    src="{{ $profilePic ? asset('storage/' . $profilePic) : asset('feed_assets/images/avatar-1.png') }}"
    alt="avatar"
    alt="avatar" class="max-un" height="50" width="50">


                                        </div>
                                        <textarea name="modalContent" cols="10" rows="2" placeholder="Write something to Lerio.."></textarea>
                                    </div>

									<div class="file-upload">
									<label>Upload attachment</label>
									<div id="drop-area" class="drop-area mt-2 p-4 text-center border border-secondary rounded">
										<i class="material-symbols-outlined mat-icon mb-2 d-block"> perm_media </i>
										<span>Drag & Drop image/video here or click to browse.</span>
										<!--<input type="file" id="media" name="media[]" multiple class="d-none" accept="image/*,video/*">-->
                                        <input type="file" id="media" name="media[]" multiple class="d-none" accept="image/*">
                                        <input class="form-control f-18 black mt-2" type="text" name="video_link"
                                placeholder="Video Link .." />

										<div id="preview" class="mt-3 d-flex flex-wrap gap-3"></div>
									</div>
								</div>
                                </div>
                                <div class="footer-area pt-5">
                                    <div class="btn-area d-flex justify-content-end gap-2">
                                        <button type="button" class="cmn-btn alt" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
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
   </div><button id="uw-widget-custom-trigger" class="uw-widget-custom-trigger" aria-label="Accessibility Widget"
       data-uw-trigger="true" aria-haspopup="dialog" style="background-color: #af2910;"><img
           src="data:image/svg+xml,%0A%3Csvg width='32' height='32' viewBox='0 0 32 32' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cg clip-path='url(%23clip0_1_1506)'%3E%3Cpath d='M16 7C15.3078 7 14.6311 6.79473 14.0555 6.41015C13.4799 6.02556 13.0313 5.47894 12.7664 4.83939C12.5015 4.19985 12.4322 3.49612 12.5673 2.81719C12.7023 2.13825 13.0356 1.51461 13.5251 1.02513C14.0146 0.535644 14.6383 0.202301 15.3172 0.0672531C15.9961 -0.0677952 16.6999 0.00151652 17.3394 0.266423C17.9789 0.53133 18.5256 0.979934 18.9101 1.55551C19.2947 2.13108 19.5 2.80777 19.5 3.5C19.499 4.42796 19.1299 5.31762 18.4738 5.97378C17.8176 6.62994 16.928 6.99901 16 7Z' fill='white'/%3E%3Cpath d='M27 7.05L26.9719 7.0575L26.9456 7.06563C26.8831 7.08313 26.8206 7.10188 26.7581 7.12125C25.595 7.4625 19.95 9.05375 15.9731 9.05375C12.2775 9.05375 7.14313 7.67875 5.50063 7.21188C5.33716 7.14867 5.17022 7.09483 5.00063 7.05063C3.81313 6.73813 3.00063 7.94438 3.00063 9.04688C3.00063 10.1388 3.98188 10.6588 4.9725 11.0319V11.0494L10.9238 12.9081C11.5319 13.1413 11.6944 13.3794 11.7738 13.5856C12.0319 14.2475 11.8256 15.5581 11.7525 16.0156L11.39 18.8281L9.37813 29.84C9.37188 29.87 9.36625 29.9006 9.36125 29.9319L9.34688 30.0112C9.20188 31.0206 9.94313 32 11.3469 32C12.5719 32 13.1125 31.1544 13.3469 30.0037C13.5813 28.8531 15.0969 20.1556 15.9719 20.1556C16.8469 20.1556 18.6494 30.0037 18.6494 30.0037C18.8838 31.1544 19.4244 32 20.6494 32C22.0569 32 22.7981 31.0162 22.6494 30.0037C22.6363 29.9175 22.6206 29.8325 22.6019 29.75L20.5625 18.8294L20.2006 16.0169C19.9387 14.3788 20.1494 13.8375 20.2206 13.7106C20.2225 13.7076 20.2242 13.7045 20.2256 13.7013C20.2931 13.5763 20.6006 13.2963 21.3181 13.0269L26.8981 11.0763C26.9324 11.0671 26.9662 11.0563 26.9994 11.0438C27.9994 10.6688 28.9994 10.15 28.9994 9.04813C28.9994 7.94625 28.1875 6.73813 27 7.05Z' fill='white'/%3E%3C/g%3E%3Cdefs%3E%3CclipPath id='clip0_1_1506'%3E%3Crect width='32' height='32' fill='white'/%3E%3C/clipPath%3E%3C/defs%3E%3C/svg%3E%0A"><span class="text-white">Accessibility
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
 function likePost(postId) {
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfMeta) {
        alert("CSRF token not found");
        return;
    }

    const csrfToken = csrfMeta.getAttribute('content');

    fetch(`${location.origin}/like/${postId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
    })
    .then(response => {
        if (!response.ok) throw new Error('Network response was not OK');
        return response.json();
    })
    .then(data => {
        const btn = document.getElementById(`like-btn-${postId}`);
        if (btn) {
            btn.innerText = data.status === 'liked' ? 'Unlike' : 'Like';
        }
    })
    .catch(error => {
        console.error('Error liking/unliking post:', error);
        alert("Failed to process like/unlike. Please try again.");
    });
}

function toggleComments(postId) {
        const box = document.getElementById('comments-' + postId);
        box.style.display = box.style.display === 'none' ? 'block' : 'none';
    }

</script>
@endsection

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
    </style>




   <!-- Main Content start -->
   <i class="fa-light fa-face-awesome"></i>
   <main class="main-content">
       <div class="container sidebar-toggler">
           <div class="row">
               <div class="col-xxl-3 col-xl-3 col-lg-4 col-6 cus-z2">
                   <div class="d-inline-block d-lg-none">
                       <button class="button profile-active mb-4 mb-lg-0 d-flex align-items-center gap-2">
                           <i class="material-symbols-outlined mat-icon"> tune </i>
                           <span>My profile</span>
                       </button>
                   </div>
                   <div class="profile-sidebar cus-scrollbar p-5">
                       <div class="d-block d-lg-none position-absolute end-0 top-0">
                           <button class="button profile-close">
                               <i class="material-symbols-outlined mat-icon fs-xl"> close </i>
                           </button>
                       </div>
                       <div class="profile-pic d-flex gap-2 align-items-center">
                           <div class="avatar position-relative">
                               <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-1.png')}}"
                                   alt="avatar">
                           </div>
                           <div class="text-area">
                                	@if(Auth::guard('user')->check())
								 <h6 class="m-0 mb-1"><a href="profile-post.html">{{ Auth::guard('user')->user()->name }}!</a></h6>
								@endif


						<p class="mdtxt">@ {{ trim(Auth::guard('user')->user()->name) }}</p>  {{-- @ is escaped --}}

                           </div>
                       </div>
                       <ul class="profile-link mt-7 mb-7 pb-7">
                           <li>
                               <a href="#" class="d-flex gap-4 active">
                                   <i class="material-symbols-outlined mat-icon"> home </i>
                                   <span>Home</span>
                               </a>
                           </li>
                           <li>
                               <a href="#" class="d-flex gap-4">
                                   <i class="material-symbols-outlined mat-icon"> person </i>
                                   <span>Profile</span>
                               </a>
                           </li>
                           <li>
                               <a href="#" class="d-flex gap-4">
                                   <i class="material-symbols-outlined mat-icon"> workspace_premium </i>
                                   <span>Event</span>
                               </a>
                           </li>
                           <li>
                               <a href="#" class="d-flex gap-4">
                                   <i class="material-symbols-outlined mat-icon"> workspaces </i>
                                   <span>Group</span>
                               </a>
                           </li>
                           <li>
                               <a href="#" class="d-flex gap-4">
                                   <i class="material-symbols-outlined mat-icon"> store </i>
                                   <span>Broadcasts</span>
                               </a>
                           </li>
                           <li>
                               <a href="saved-post.html" class="d-flex gap-4">
                                   <i class="material-symbols-outlined mat-icon"> sync_saved_locally </i>
                                   <span>Resources Library</span>
                               </a>
                           </li>
                       </ul>
                       <div class="your-shortcuts">
                           <h6>Broadcasts</h6>
                           <ul>
                               <li class="d-flex align-items-center gap-3">
                                   <a href="public-profile-post.html">
                                       <img src="{{asset('feed_assets/images/shortcuts-1.png')}}" alt="icon">

                                   </a>
                                   <div>
                                       <span>Circlehub (Admin)</span><br>
                                       <small>Game Community</small>
                                   </div>
                               </li>
                           </ul>
                       </div>
                   </div>
               </div>
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
        @foreach($post->media as $media)
            @if(file_exists(storage_path('app/public/' . $media->file_path)))
                <div class="post-img mt-2">
                    @if($media->file_type === 'image')
                        <img src="{{ asset('storage/' . $media->file_path) }}" loading="lazy" class="w-100" alt="Post Media">
                    @elseif($media->file_type === 'video')
                        <video class="w-100" controls loading="lazy">
                            <source src="{{ asset('storage/' . $media->file_path) }}" type="video/mp4">
                        </video>
                    @endif
                </div>
            @endif
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
            <button class="mdtxt">{{ $post->comments?->count() ?? 0 }} Comments</button>
            <button class="mdtxt">{{ $post->shares ?? 0 }} Shares</button>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="like-comment-share py-5 d-center flex-wrap gap-3 gap-md-0 justify-content-between">
        <button onclick="likePost({{ $post->id }})" class="d-center gap-1 gap-sm-2 mdtxt">
            <i class="material-symbols-outlined mat-icon"> favorite </i> Like
        </button>
        <button class="d-center gap-1 gap-sm-2 mdtxt">
            <i class="material-symbols-outlined mat-icon"> chat </i> Comment
        </button>
        <button class="d-center gap-1 gap-sm-2 mdtxt">
            <i class="material-symbols-outlined mat-icon"> share </i> Share
        </button>
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


<div class="post-single-box p-3 p-sm-5">
                           <div class="top-area pb-5">
                               <div class="profile-area d-center justify-content-between">
                                   <div class="avatar-item d-flex gap-3 align-items-center">
                                       <div class="avatar position-relative">
                                           <img class="avatar-img max-un" src="{{ asset('feed_assets/images/avatar-1.png') }}" alt="avatar">
                                       </div>
                                       <div class="info-area">
                                           <h6 class="m-0"><a href="public-profile-post.html">Lori Cortez</a></h6>
                                           <span class="mdtxt status">Active</span>
                                       </div>
                                   </div>
                                   <div class="btn-group cus-dropdown">
                                       <button type="button" class="dropdown-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                           <i class="material-symbols-outlined fs-xxl m-0"> more_horiz </i>
                                       </button>
                                       <ul class="dropdown-menu p-4 pt-2">
                                           <li>
                                               <a class="droplist d-flex align-items-center gap-2" href="#">
                                                   <i class="material-symbols-outlined mat-icon"> bookmark_add </i>
                                                   <span>Saved Post</span>
                                               </a>
                                           </li>
                                           <li>
                                               <a class="droplist d-flex align-items-center gap-2" href="#">
                                                   <i class="material-symbols-outlined mat-icon"> person_remove </i>
                                                   <span>Unfollow</span>
                                               </a>
                                           </li>
                                           <li>
                                               <a class="droplist d-flex align-items-center gap-2" href="#">
                                                   <i class="material-symbols-outlined mat-icon"> hide_source </i>
                                                   <span>Hide Post</span>
                                               </a>
                                           </li>
                                           <li>
                                               <a class="droplist d-flex align-items-center gap-2" href="#">
                                                   <i class="material-symbols-outlined mat-icon"> lock </i>
                                                   <span>Block</span>
                                               </a>
                                           </li>
                                           <li>
                                               <a class="droplist d-flex align-items-center gap-2" href="#">
                                                   <i class="material-symbols-outlined mat-icon"> flag </i>
                                                   <span>Report Post</span>
                                               </a>
                                           </li>
                                       </ul>
                                   </div>
                               </div>
                               <div class="py-4">
                                   <p class="description">I created Roughly plugin to sketch crafted hand-drawn elements
                                       which can be used to any usage (diagrams/flows/decoration/etc)</p>
                               </div>
                               <div class="post-img  d-flex justify-content-between flex-wrap gap-2 gap-lg-3">
                                   <div class="single">
                                       <img src="{{ asset('feed_assets/images/post-img-2.png') }}" alt="image">
                                   </div>
                                   <div class="single d-grid gap-3">
                                       <img src="{{ asset('feed_assets/images/post-img-3.png') }}" alt="image">
                                       <img src="{{ asset('feed_assets/images/post-img-4.png') }}" alt="image">
                                   </div>
                               </div>
                           </div>
                           <div class="total-react-share pb-4 d-center gap-2 flex-wrap justify-content-between">
                               <div class="friends-list d-flex gap-3 align-items-center text-center">
                                   <ul class="d-flex align-items-center justify-content-center">
                                       <li><img src="{{ asset('feed_assets/images/avatar-2.png') }}" alt="image"></li>
                                       <li><img src="{{ asset('feed_assets/images/avatar-3.png') }}" alt="image"></li>
                                       <li><img src="{{ asset('feed_assets/images/avatar-4.png') }}" alt="image"></li>
                                       <li><span class="mdtxt d-center">8+</span></li>
                                   </ul>
                               </div>
                               <div class="react-list d-flex flex-wrap gap-6 align-items-center text-center">
                                   <button class="mdtxt">4 Comments</button>
                                   <button class="mdtxt">1 Shares</button>
                               </div>
                           </div>
                           <div class="like-comment-share py-5 d-center flex-wrap gap-3 gap-md-0 justify-content-between">
                               <button class="d-center gap-1 gap-sm-2 mdtxt">
                                   <i class="material-symbols-outlined mat-icon"> favorite </i>
                                   Like
                               </button>
                               <button class="d-center gap-1 gap-sm-2 mdtxt">
                                   <i class="material-symbols-outlined mat-icon"> chat </i>
                                   Comment
                               </button>
                               <button class="d-center gap-1 gap-sm-2 mdtxt">
                                   <i class="material-symbols-outlined mat-icon"> share </i>
                                   Share
                               </button>
                           </div>
                           <form action="#">
                               <div class="d-flex mt-5 gap-3">
                                   <div class="profile-box d-none d-xxl-block">
                                       <a href="#"><img src="{{ asset('feed_assets/images/add-post-avatar.png') }}" class="max-un" alt="icon"></a>
                                   </div>
                                   <div class="form-content input-area py-1 d-flex gap-2 align-items-center w-100">
                                       <input placeholder="Write a comment..">
                                       <div class="file-input d-flex gap-1 gap-md-2">
                                           <div class="file-upload">
                                               <label class="file">
                                                   <input type="file">
                                                   <span class="file-custom border-0 d-grid text-center">
                                                       <span class="material-symbols-outlined mat-icon m-0 xxltxt">
                                                           gif_box </span>
                                                   </span>
                                               </label>
                                           </div>
                                           <div class="file-upload">
                                               <label class="file">
                                                   <input type="file">
                                                   <span class="file-custom border-0 d-grid text-center">
                                                       <span class="material-symbols-outlined mat-icon m-0 xxltxt">
                                                           perm_media </span>
                                                   </span>
                                               </label>
                                           </div>
                                           <span class="mood-area">
                                               <span class="material-symbols-outlined mat-icon m-0 xxltxt"> mood </span>
                                           </span>
                                       </div>
                                   </div>
                                   <div class="btn-area d-flex">
                                       <button class="cmn-btn px-2 px-sm-5 px-lg-6">
                                           <i class="material-symbols-outlined mat-icon m-0 fs-xxl"> near_me </i>
                                       </button>
                                   </div>
                               </div>
                           </form>
                           <div class="comments-area mt-5">
                               <div class="single-comment-area ms-1 ms-xxl-15">
                                   <div class="parent-comment d-flex gap-2 gap-sm-4">
                                       <div class="avatar-item d-center align-items-baseline">
                                           <img class="avatar-img max-un" src="{{ asset('feed_assets/images/avatar-3.png') }}" alt="avatar">
                                       </div>
                                       <div class="info-item">
                                           <div class="top-area px-4 py-3 d-flex gap-3 align-items-start justify-content-between">
                                               <div class="title-area">
                                                   <h6 class="m-0 mb-3"><a href="public-profile-post.html">Lori
                                                           Cortez</a></h6>
                                                   <p class="mdtxt">The only way to solve the problem is to code for the
                                                       hardware directly</p>
                                               </div>
                                               <div class="btn-group dropend cus-dropdown">
                                                   <button type="button" class="dropdown-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                       <i class="material-symbols-outlined fs-xxl m-0"> more_horiz </i>
                                                   </button>
                                                   <ul class="dropdown-menu p-4 pt-2">
                                                       <li>
                                                           <a class="droplist d-flex align-items-center gap-2" href="#">
                                                               <i class="material-symbols-outlined mat-icon">
                                                                   hide_source </i>
                                                               <span>Hide Comments</span>
                                                           </a>
                                                       </li>
                                                       <li>
                                                           <a class="droplist d-flex align-items-center gap-2" href="#">
                                                               <i class="material-symbols-outlined mat-icon"> flag </i>
                                                               <span>Report Comments</span>
                                                           </a>
                                                       </li>
                                                   </ul>
                                               </div>
                                           </div>
                                           <ul class="like-share d-flex gap-6 mt-2">
                                               <li class="d-center">
                                                   <button class="mdtxt">Like</button>
                                               </li>
                                               <li class="d-center flex-column">
                                                   <button class="mdtxt reply-btn">Reply</button>
                                               </li>
                                               <li class="d-center">
                                                   <button class="mdtxt">Share</button>
                                               </li>
                                           </ul>
                                           <form action="#" class="comment-form">
                                               <div class="d-flex gap-3">
                                                   <input placeholder="Write a comment.." class="py-3">
                                                   <button class="cmn-btn px-2 px-sm-5 px-lg-6">
                                                       <i class="material-symbols-outlined mat-icon m-0 fs-xxl"> near_me
                                                       </i>
                                                   </button>
                                               </div>
                                           </form>
                                       </div>
                                   </div>
                                   <div class="single-comment-area comment-item-nested mt-4 mt-sm-7 ms-13 ms-sm-15">
                                       <div class="d-flex gap-2 gap-sm-4 align-items-baseline">
                                           <div class="avatar-item">
                                               <img class="avatar-img max-un" src="{{ asset('feed_assets/images/avatar-4.png') }}" alt="avatar">
                                           </div>
                                           <div class="info-item">
                                               <div class="top-area px-4 py-3 d-flex gap-3 align-items-start justify-content-between">
                                                   <div class="title-area">
                                                       <h6 class="m-0 mb-3"><a href="public-profile-post.html">Alex</a>
                                                       </h6>
                                                       <p class="mdtxt">The only way to solve the</p>
                                                   </div>
                                                   <div class="btn-group dropend cus-dropdown">
                                                       <button type="button" class="dropdown-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                           <i class="material-symbols-outlined fs-xxl m-0"> more_horiz
                                                           </i>
                                                       </button>
                                                       <ul class="dropdown-menu p-4 pt-2">
                                                           <li>
                                                               <a class="droplist d-flex align-items-center gap-2" href="#">
                                                                   <i class="material-symbols-outlined mat-icon">
                                                                       hide_source </i>
                                                                   <span>Hide Comments</span>
                                                               </a>
                                                           </li>
                                                           <li>
                                                               <a class="droplist d-flex align-items-center gap-2" href="#">
                                                                   <i class="material-symbols-outlined mat-icon"> flag
                                                                   </i>
                                                                   <span>Report Comments</span>
                                                               </a>
                                                           </li>
                                                       </ul>
                                                   </div>
                                               </div>
                                               <ul class="like-share d-flex gap-6 mt-2">
                                                   <li class="d-center">
                                                       <button class="mdtxt">Like</button>
                                                   </li>
                                                   <li class="d-center flex-column">
                                                       <button class="mdtxt reply-btn">Reply</button>
                                                   </li>
                                                   <li class="d-center">
                                                       <button class="mdtxt">Share</button>
                                                   </li>
                                               </ul>
                                               <form action="#" class="comment-form">
                                                   <div class="d-flex gap-3">
                                                       <input placeholder="Write a comment.." class="py-3">
                                                       <button class="cmn-btn px-2 px-sm-5 px-lg-6">
                                                           <i class="material-symbols-outlined mat-icon m-0 fs-xxl">
                                                               near_me </i>
                                                       </button>
                                                   </div>
                                               </form>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>

                       <!-- multiple images section -->

                   </div>
               </div>
               <div class="col-xxl-3 col-xl-4 col-lg-4 col-6 mt-5 mt-xl-0">
                   <div class="cus-overflow cus-scrollbar sidebar-head">
                       <div class="d-flex justify-content-end">
                           <div class="d-block d-xl-none me-4">
                               <button class="button toggler-btn mb-4 mb-lg-0 d-flex align-items-center gap-2">
                                   <span>My List</span>
                                   <i class="material-symbols-outlined mat-icon"> tune </i>
                               </button>
                           </div>
                       </div>
                       <div class="cus-scrollbar side-wrapper">
                           <div class="sidebar-wrapper d-flex flex-column gap-6">
                               <div class="sidebar-area p-5">
                                   <div class=" mb-4">
                                       <h6 class="d-inline-flex position-relative">
                                           Our Member
                                       </h6>
                                   </div>
                                   <div class="d-grid gap-6">
                                       <div class="single-single">
                                           <div class="profile-pic d-flex gap-3 align-items-center">
                                               <div class="avatar">
                                                   <img class="avatar-img max-un" src="{{ asset('feed_assets/images/avatar-4.png') }}"
                                                       alt="avatar">
                                               </div>
                                               <div class="text-area">
                                                   <a href="public-profile-post.html">
                                                       <h6 class="m-0">Lerio Mao</h6>
                                                   </a>
                                                   <div class="friends-list">
                                                       <p class="mdtxt d-center">10 mutual friends</p>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <hr>
                                   </div>
                               </div>
                               <div class="sidebar-area p-5">
                                   <div class="mb-4">
                                       <h6 class="d-inline-flex">
                                           Forums
                                       </h6>
                                   </div>
                                   <div class="d-flex flex-column gap-6">
                                       <div
                                           class="profile-area d-center position-relative align-items-center justify-content-between">
                                           <div class="avatar-item d-flex gap-3 align-items-center">
                                               <div class="avatar-item">
                                                   <img class="avatar-img max-un" src="{{ asset('feed_assets/images/avatar-6.png') }}"
                                                       alt="avatar">
                                               </div>
                                               <div class="info-area">
                                                   <h6 class="m-0"><a href="public-profile-post.html"
                                                           class="mdtxt">Piter Maio</a></h6>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="sidebar-area p-5">
                                   <div class="mb-4">
                                       <h6 class="d-inline-flex">
                                           Latest Events
                                       </h6>
                                   </div>
                                   <div class="d-flex flex-column gap-6">
                                       <div
                                           class="profile-area d-center position-relative align-items-center justify-content-between">
                                           <div class="avatar-item d-flex gap-3 align-items-center">
                                               <div class="avatar-item">
                                                   <img class="avatar-img max-un" src="{{ asset('feed_assets/images/avatar-7.png') }}"
                                                       alt="avatar">
                                               </div>
                                               <div class="info-area">
                                                   <h6 class="m-0"><a href="public-profile-post.html"
                                                           class="mdtxt">Piter Maio</a></h6>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </main>
   <!-- Main Content end -->
 <!-- Modal for Adding Photo/Video Post -->
 <!--<div class="modal cmn-modal fade" id="photoVideoMod" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-5">
                <div class="modal-header justify-content-center">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="material-symbols-outlined mat-icon xxltxt">close</i>
                    </button>
                </div>

                <div class="top-content pb-3">
                    <h5>Add Post Photo/Video</h5>
                </div>

                <form id="mediaPostForm" enctype="multipart/form-data">
                    <input type="hidden" name="post_id" id="post_id" value="">

                    <div class="mid-area">
                        <div class="d-flex mb-4 gap-3 align-items-start">
                            <div class="profile-box">
                                <a href="#"><img src="{{asset('feed_assets/images/add-post-avatar.png')}}" class="max-un" alt="avatar"></a>
                            </div>
                            <textarea name="modalContent" id="modalContent" class="form-control" rows="2" placeholder="Write something.."></textarea>
                        </div>

                        <input id="media" name="media[]" type="file" class="file" multiple accept="image/*,video/*">
                    </div>

                    <div class="footer-area pt-4">
                        <div class="btn-area d-flex justify-content-end gap-2">
                            <button type="button" class="cmn-btn alt" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="cmn-btn">Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>-->


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
                                            <a href="#"><img src="{{ asset('feed_assets/images/add-post-avatar.png') }}" class="max-un" alt="avatar"></a>
                                        </div>
                                        <textarea name="modalContent" cols="10" rows="2" placeholder="Write something to Lerio.."></textarea>
                                    </div>
                                    <!--<div class="file-upload">
                                        <label>Upload attachment</label>
                                        <label class="file mt-1">
											<input type="file" id="media" name="media[]" multiple>
											<input type="hidden" id="post_id" name="post_id" value="">
                                            <span class="file-custom pt-8 pb-8 d-grid text-center">
                                                <i class="material-symbols-outlined mat-icon"> perm_media </i>
                                                <span>Drag here or click to upload photo.</span>
                                            </span>
                                        </label>
                                    </div>-->
									<div class="file-upload">
									<label>Upload attachment</label>
									<div id="drop-area" class="drop-area mt-2 p-4 text-center border border-secondary rounded">
										<i class="material-symbols-outlined mat-icon mb-2 d-block"> perm_media </i>
										<span>Drag & Drop image/video here or click to browse.</span>
										<input type="file" id="media" name="media[]" multiple class="d-none" accept="image/*,video/*">

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
    fetch(`/like/${postId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        // Optionally update like count, change button style, etc.
        alert(data.message || 'Liked successfully!');
    })
    .catch(error => console.error('Error liking post:', error));
}



</script>
@endsection

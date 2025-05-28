   @extends('user.layouts.master')

@section('title', 'User Feed - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
   <!-- Main Content start -->
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
                                <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-1.png')}}" alt="avatar">
                            </div>
                            <div class="text-area">
                                <h6 class="m-0 mb-1"><a href="profile-post.html">Lerio Mao</a></h6>
                                <p class="mdtxt">@maolio</p>
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
                                    <img class="bg-img" src="feed_assets/images/story-slider-owner.png" alt="icon">
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
                                    <img class="bg-img" src="feed_assets/images/story-slider-1.png" alt="image">
                                    <a href="public-profile-post.html" class="abs-area p-3 position-absolute bottom-0">
                                        <img src="feed_assets/images/avatar-1.png" alt="image">
                                        <span class="mdtxt">Alen Lio</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="share-post d-flex gap-3 gap-sm-5 p-3 p-sm-5">
                        <div class="profile-box">
                            <a href="#"><img src="feed_assets/images/add-post-avatar.png" class="max-un" alt="icon"></a>
                        </div>
                        <form action="#" class="w-100 position-relative">
                            <textarea cols="10" rows="2" placeholder="Write something to Lerio.."></textarea>
                            <div class="abs-area position-absolute d-none d-sm-block">
                                <i class="material-symbols-outlined mat-icon xxltxt"> sentiment_satisfied </i>
                            </div>
                            <ul class="d-flex text-end mt-3 gap-3">
                                <li class="d-flex gap-2" data-bs-toggle="modal" data-bs-target="#goLiveMod">
                                    <img src="feed_assets/images/icon/live-video.png" class="max-un" alt="icon">
                                    <span>Live</span>
                                </li>
                                <li class="d-flex gap-2" data-bs-toggle="modal" data-bs-target="#photoVideoMod">
                                    <img src="feed_assets/images/icon/vgallery.png" class="max-un" alt="icon">
                                    <span>Photo/Video</span>
                                </li>
                            </ul>
                        </form>
                    </div>
                    <div class="post-item d-flex flex-column gap-5 gap-md-7" id="news-feed">
                        <div class="post-single-box p-3 p-sm-5">
                            <div class="top-area pb-5">
                                <div class="profile-area d-center justify-content-between">
                                    <div class="avatar-item d-flex gap-3 align-items-center">
                                        <div class="avatar position-relative">
                                            <img class="avatar-img max-un" src="feed_assets/images/avatar-1.png" alt="avatar">
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
                                    <p class="description">I created Roughly plugin to sketch crafted hand-drawn elements which can be used to any usage (diagrams/flows/decoration/etc)</p>
                                </div>
                                <div class="post-img">
                                    <img src="{{asset('feed_assets/images/post-img-1.png')}}" class="w-100" alt="image">
                                </div>
                            </div>
                            <div class="total-react-share pb-4 d-center gap-2 flex-wrap justify-content-between">
                                <div class="friends-list d-flex gap-3 align-items-center text-center">
                                    <ul class="d-flex align-items-center justify-content-center">
                                        <li><img src="feed_assets/images/avatar-2.png" alt="image"></li>
                                        <li><img src="feed_assets/images/avatar-3.png" alt="image"></li>
                                        <li><img src="feed_assets/images/avatar-4.png" alt="image"></li>
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
                                        <a href="#"><img src="feed_assets/images/add-post-avatar.png" class="max-un" alt="icon"></a>
                                    </div>
                                    <div class="form-content input-area py-1 d-flex gap-2 align-items-center w-100">
                                        <input placeholder="Write a comment..">
                                        <div class="file-input d-flex gap-1 gap-md-2">
                                            <div class="file-upload">
                                                <label class="file">
                                                    <input type="file">
                                                    <span class="file-custom border-0 d-grid text-center">
                                                        <span class="material-symbols-outlined mat-icon m-0 xxltxt"> gif_box </span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="file-upload">
                                                <label class="file">
                                                    <input type="file">
                                                    <span class="file-custom border-0 d-grid text-center">
                                                        <span class="material-symbols-outlined mat-icon m-0 xxltxt"> perm_media </span>
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
                        </div>
                        <div class="post-single-box p-3 p-sm-5">
                            <div class="top-area pb-5">
                                <div class="profile-area d-center justify-content-between">
                                    <div class="avatar-item d-flex gap-3 align-items-center">
                                        <div class="avatar position-relative">
                                            <img class="avatar-img max-un" src="feed_assets/images/avatar-1.png" alt="avatar">
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
                                    <p class="description">I created Roughly plugin to sketch crafted hand-drawn elements which can be used to any usage (diagrams/flows/decoration/etc)</p>
                                </div>
                                <div class="post-img  d-flex justify-content-between flex-wrap gap-2 gap-lg-3">
                                    <div class="single">
                                        <img src="feed_assets/images/post-img-2.png" alt="image">
                                    </div>
                                    <div class="single d-grid gap-3">
                                        <img src="feed_assets/images/post-img-3.png" alt="image">
                                        <img src="feed_assets/images/post-img-4.png" alt="image">
                                    </div>
                                </div>
                            </div>
                            <div class="total-react-share pb-4 d-center gap-2 flex-wrap justify-content-between">
                                <div class="friends-list d-flex gap-3 align-items-center text-center">
                                    <ul class="d-flex align-items-center justify-content-center">
                                        <li><img src="feed_assets/images/avatar-2.png" alt="image"></li>
                                        <li><img src="feed_assets/images/avatar-3.png" alt="image"></li>
                                        <li><img src="feed_assets/images/avatar-4.png" alt="image"></li>
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
                                        <a href="#"><img src="feed_assets/images/add-post-avatar.png" class="max-un" alt="icon"></a>
                                    </div>
                                    <div class="form-content input-area py-1 d-flex gap-2 align-items-center w-100">
                                        <input placeholder="Write a comment..">
                                        <div class="file-input d-flex gap-1 gap-md-2">
                                            <div class="file-upload">
                                                <label class="file">
                                                    <input type="file">
                                                    <span class="file-custom border-0 d-grid text-center">
                                                        <span class="material-symbols-outlined mat-icon m-0 xxltxt"> gif_box </span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="file-upload">
                                                <label class="file">
                                                    <input type="file">
                                                    <span class="file-custom border-0 d-grid text-center">
                                                        <span class="material-symbols-outlined mat-icon m-0 xxltxt"> perm_media </span>
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
                                            <img class="avatar-img max-un" src="feed_assets/images/avatar-3.png" alt="avatar">
                                        </div>
                                        <div class="info-item">
                                            <div class="top-area px-4 py-3 d-flex gap-3 align-items-start justify-content-between">
                                                <div class="title-area">
                                                    <h6 class="m-0 mb-3"><a href="public-profile-post.html">Lori Cortez</a></h6>
                                                    <p class="mdtxt">The only way to solve the problem is to code for the hardware directly</p>
                                                </div>
                                                <div class="btn-group dropend cus-dropdown">
                                                    <button type="button" class="dropdown-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="material-symbols-outlined fs-xxl m-0"> more_horiz </i>
                                                    </button>
                                                    <ul class="dropdown-menu p-4 pt-2">
                                                        <li>
                                                            <a class="droplist d-flex align-items-center gap-2" href="#">
                                                                <i class="material-symbols-outlined mat-icon"> hide_source </i>
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
                                                        <i class="material-symbols-outlined mat-icon m-0 fs-xxl"> near_me </i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="single-comment-area comment-item-nested mt-4 mt-sm-7 ms-13 ms-sm-15">
                                        <div class="d-flex gap-2 gap-sm-4 align-items-baseline">
                                            <div class="avatar-item">
                                                <img class="avatar-img max-un" src="feed_assets/images/avatar-4.png" alt="avatar">
                                            </div>
                                            <div class="info-item">
                                                <div class="top-area px-4 py-3 d-flex gap-3 align-items-start justify-content-between">
                                                    <div class="title-area">
                                                        <h6 class="m-0 mb-3"><a href="public-profile-post.html">Alex</a></h6>
                                                        <p class="mdtxt">The only way to solve the</p>
                                                    </div>
                                                    <div class="btn-group dropend cus-dropdown">
                                                        <button type="button" class="dropdown-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="material-symbols-outlined fs-xxl m-0"> more_horiz </i>
                                                        </button>
                                                        <ul class="dropdown-menu p-4 pt-2">
                                                            <li>
                                                                <a class="droplist d-flex align-items-center gap-2" href="#">
                                                                    <i class="material-symbols-outlined mat-icon"> hide_source </i>
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
                                                            <i class="material-symbols-outlined mat-icon m-0 fs-xxl"> near_me </i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-single-box p-3 p-sm-5">
                            <div class="top-area pb-5">
                                <div class="profile-area d-center justify-content-between">
                                    <div class="avatar-item d-flex gap-3 align-items-center">
                                        <div class="avatar-item">
                                            <img class="avatar-img max-un" src="feed_assets/images/avatar-5.png" alt="avatar">
                                        </div>
                                        <div class="info-area">
                                            <h6 class="m-0"><a href="public-profile-post.html">Loprayos</a></h6>
                                            <span class="mdtxt status">20m Ago</span>
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
                                    <p class="description">Nam ornare a nibh id sagittis. Vestibulum nec molestie urna, eget convallis mi. Vestibulum rhoncus ligula eget sem sollicitudin interdum. Aliquam massa lectus, fringilla non diam ut, laoreet convallis risus. Curabitur at metus imperdiet, pellentesque ligula vel,</p>
                                </div>
                            </div>
                            <div class="total-react-share pb-4 d-center gap-2 flex-wrap justify-content-between">
                                <div class="friends-list d-flex gap-3 align-items-center text-center">
                                    <ul class="d-flex align-items-center justify-content-center">
                                        <li><img src="feed_assets/images/avatar-2.png" alt="image"></li>
                                        <li><img src="feed_assets/images/avatar-3.png" alt="image"></li>
                                        <li><img src="feed_assets/images/avatar-4.png" alt="image"></li>
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
                                        <a href="#"><img src="feed_assets/images/add-post-avatar.png" class="max-un" alt="icon"></a>
                                    </div>
                                    <div class="form-content input-area py-1 d-flex gap-2 align-items-center w-100">
                                        <input placeholder="Write a comment..">
                                        <div class="file-input d-flex gap-1 gap-md-2">
                                            <div class="file-upload">
                                                <label class="file">
                                                    <input type="file">
                                                    <span class="file-custom border-0 d-grid text-center">
                                                        <span class="material-symbols-outlined mat-icon m-0 xxltxt"> gif_box </span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="file-upload">
                                                <label class="file">
                                                    <input type="file">
                                                    <span class="file-custom border-0 d-grid text-center">
                                                        <span class="material-symbols-outlined mat-icon m-0 xxltxt"> perm_media </span>
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
                                            <img class="avatar-img max-un" src="feed_assets/images/avatar-3.png" alt="avatar">
                                        </div>
                                        <div class="info-item active">
                                            <div class="top-area px-4 py-3 d-flex gap-3 align-items-start justify-content-between">
                                                <div class="title-area">
                                                    <h6 class="m-0 mb-3"><a href="public-profile-post.html">Lori Cortez</a></h6>
                                                    <p class="mdtxt">The only way to solve the problem is to code for the hardware directly</p>
                                                </div>
                                                <div class="btn-group dropend cus-dropdown">
                                                    <button type="button" class="dropdown-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="material-symbols-outlined fs-xxl m-0"> more_horiz </i>
                                                    </button>
                                                    <ul class="dropdown-menu p-4 pt-2">
                                                        <li>
                                                            <a class="droplist d-flex align-items-center gap-2" href="#">
                                                                <i class="material-symbols-outlined mat-icon"> hide_source </i>
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
                                                        <i class="material-symbols-outlined mat-icon m-0 fs-xxl"> near_me </i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="sibling-comment comment-item-nested single-comment-area mt-7 ms-13 ms-sm-15">
                                        <div class="d-flex gap-2 gap-sm-4 align-items-baseline">
                                            <div class="avatar-item">
                                                <img class="avatar-img max-un" src="feed_assets/images/avatar-4.png" alt="avatar">
                                            </div>
                                            <div class="info-item">
                                                <div class="top-area px-4 py-3 d-flex gap-3 align-items-start justify-content-between">
                                                    <div class="title-area">
                                                        <h6 class="m-0 mb-3"><a href="public-profile-post.html">Alexa</a></h6>
                                                        <p class="mdtxt">The only way to solve the</p>
                                                    </div>
                                                    <div class="btn-group dropend cus-dropdown">
                                                        <button type="button" class="dropdown-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="material-symbols-outlined fs-xxl m-0"> more_horiz </i>
                                                        </button>
                                                        <ul class="dropdown-menu p-4 pt-2">
                                                            <li>
                                                                <a class="droplist d-flex align-items-center gap-2" href="#">
                                                                    <i class="material-symbols-outlined mat-icon"> hide_source </i>
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
                                                            <i class="material-symbols-outlined mat-icon m-0 fs-xxl"> near_me </i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-comment-area comment-item-nested mt-7 ms-13 ms-sm-15">
                                        <div class="d-flex gap-2 gap-sm-4 align-items-baseline">
                                            <div class="avatar-item">
                                                <img class="avatar-img max-un" src="feed_assets/images/avatar-7.png" alt="avatar">
                                            </div>
                                            <div class="info-item">
                                                <div class="top-area px-4 py-3 d-flex gap-3 align-items-start justify-content-between">
                                                    <div class="title-area">
                                                        <h6 class="m-0 mb-3"><a href="public-profile-post.html">Haplika</a></h6>
                                                        <p class="mdtxt">The only way to solve the</p>
                                                    </div>
                                                    <div class="btn-group dropend cus-dropdown">
                                                        <button type="button" class="dropdown-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="material-symbols-outlined fs-xxl m-0"> more_horiz </i>
                                                        </button>
                                                        <ul class="dropdown-menu p-4 pt-2">
                                                            <li>
                                                                <a class="droplist d-flex align-items-center gap-2" href="#">
                                                                    <i class="material-symbols-outlined mat-icon"> hide_source </i>
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
                                                            <i class="material-symbols-outlined mat-icon m-0 fs-xxl"> near_me </i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="comments-area mt-5">
                                <div class="single-comment-area ms-1 ms-xxl-15">
                                    <div class="d-flex gap-4">
                                        <div class="avatar-item d-center align-items-baseline">
                                            <img class="avatar-img max-un" src="feed_assets/images/avatar-3.png" alt="avatar">
                                        </div>
                                        <div class="info-item w-100">
                                            <div class="top-area px-4 py-3 d-flex gap-3 align-items-start justify-content-between">
                                                <div class="title-area">
                                                    <h6 class="m-0 mb-3"><a href="public-profile-post.html">Marlio</a></h6>
                                                    <div class="post-img">
                                                        <img src="feed_assets/images/icon/emoji-love-2.png" alt="icon">
                                                    </div>
                                                </div>
                                                <div class="btn-group dropend cus-dropdown">
                                                    <button type="button" class="dropdown-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="material-symbols-outlined fs-xxl m-0"> more_horiz </i>
                                                    </button>
                                                    <ul class="dropdown-menu p-4 pt-2">
                                                        <li>
                                                            <a class="droplist d-flex align-items-center gap-2" href="#">
                                                                <i class="material-symbols-outlined mat-icon"> hide_source </i>
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
                                                        <i class="material-symbols-outlined mat-icon m-0 fs-xxl"> near_me </i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-single-box p-3 p-sm-5">
                            <div class="top-area pb-5">
                                <div class="profile-area d-center justify-content-between">
                                    <div class="avatar-item d-flex gap-3 align-items-center">
                                        <div class="avatar position-relative">
                                            <img class="avatar-img max-un" src="feed_assets/images/avatar-1.png" alt="avatar">
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
                                    <p class="description">My Travel Video</p>
                                    <p class="hastag d-flex gap-2">
                                        <a href="#">#Viral</a>
                                        <a href="#">#travel</a>
                                    </p>
                                </div>
                                <div class="post-img video-item">
                                    <div class="plyr__video-embed player">
                                        <iframe src="https://www.youtube.com/embed/LXb3EKWsInQ"></iframe>
                                    </div>
                                </div>
                            </div>
                            <div class="total-react-share pb-4 d-center gap-2 flex-wrap justify-content-between">
                                <div class="friends-list d-flex gap-3 align-items-center text-center">
                                    <ul class="d-flex align-items-center justify-content-center">
                                        <li><img src="feed_assets/images/avatar-2.png" alt="image"></li>
                                        <li><img src="feed_assets/images/avatar-3.png" alt="image"></li>
                                        <li><img src="feed_assets/images/avatar-4.png" alt="image"></li>
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
                                        <a href="#"><img src="feed_assets/images/add-post-avatar.png" class="max-un" alt="icon"></a>
                                    </div>
                                    <div class="form-content input-area py-1 d-flex gap-2 align-items-center w-100">
                                        <input placeholder="Write a comment..">
                                        <div class="file-input d-flex gap-1 gap-md-2">
                                            <div class="file-upload">
                                                <label class="file">
                                                    <input type="file">
                                                    <span class="file-custom border-0 d-grid text-center">
                                                        <span class="material-symbols-outlined mat-icon m-0 xxltxt"> gif_box </span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="file-upload">
                                                <label class="file">
                                                    <input type="file">
                                                    <span class="file-custom border-0 d-grid text-center">
                                                        <span class="material-symbols-outlined mat-icon m-0 xxltxt"> perm_media </span>
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
                        </div>
                        <div class="post-single-box p-3 p-sm-5">
                            <div class="top-area pb-5">
                                <div class="profile-area d-center justify-content-between">
                                    <div class="avatar-item d-flex gap-3 align-items-center">
                                        <div class="avatar position-relative">
                                            <img class="avatar-img max-un" src="feed_assets/images/avatar-1.png" alt="avatar">
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
                                    <p class="description">I created Roughly plugin to sketch crafted hand-drawn elements which can be used to any usage (diagrams/flows/decoration/etc)</p>
                                </div>
                                <div class="post-img">
                                    <img src="feed_assets/images/post-img-1.png" class="w-100" alt="image">
                                </div>
                            </div>
                            <div class="total-react-share pb-4 d-center gap-2 flex-wrap justify-content-between">
                                <div class="friends-list d-flex gap-3 align-items-center text-center">
                                    <ul class="d-flex align-items-center justify-content-center">
                                        <li><img src="feed_assets/images/avatar-2.png" alt="image"></li>
                                        <li><img src="feed_assets/images/avatar-3.png" alt="image"></li>
                                        <li><img src="feed_assets/images/avatar-4.png" alt="image"></li>
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
                                        <a href="#"><img src="feed_assets/images/add-post-avatar.png" class="max-un" alt="icon"></a>
                                    </div>
                                    <div class="form-content input-area py-1 d-flex gap-2 align-items-center w-100">
                                        <input placeholder="Write a comment..">
                                        <div class="file-input d-flex gap-1 gap-md-2">
                                            <div class="file-upload">
                                                <label class="file">
                                                    <input type="file">
                                                    <span class="file-custom border-0 d-grid text-center">
                                                        <span class="material-symbols-outlined mat-icon m-0 xxltxt"> gif_box </span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="file-upload">
                                                <label class="file">
                                                    <input type="file">
                                                    <span class="file-custom border-0 d-grid text-center">
                                                        <span class="material-symbols-outlined mat-icon m-0 xxltxt"> perm_media </span>
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
                        </div>
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
                                                    <img class="avatar-img max-un" src="feed_assets/images/avatar-4.png" alt="avatar">
                                                </div>
                                                <div class="text-area">
                                                    <a href="public-profile-post.html"><h6 class="m-0">Lerio Mao</h6></a>
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
                                        <div class="profile-area d-center position-relative align-items-center justify-content-between">
                                            <div class="avatar-item d-flex gap-3 align-items-center">
                                                <div class="avatar-item">
                                                    <img class="avatar-img max-un" src="feed_assets/images/avatar-6.png" alt="avatar">
                                                </div>
                                                <div class="info-area">
                                                    <h6 class="m-0"><a href="public-profile-post.html" class="mdtxt">Piter Maio</a></h6>
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
                                        <div class="profile-area d-center position-relative align-items-center justify-content-between">
                                            <div class="avatar-item d-flex gap-3 align-items-center">
                                                <div class="avatar-item">
                                                    <img class="avatar-img max-un" src="feed_assets/images/avatar-7.png" alt="avatar">
                                                </div>
                                                <div class="info-area">
                                                    <h6 class="m-0"><a href="public-profile-post.html" class="mdtxt">Piter Maio</a></h6>
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

    <!-- Go Live Popup start -->
    <div class="go-live-popup">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="modal cmn-modal fade" id="goLiveMod">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content p-5">
                                <div class="modal-header justify-content-center">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="material-symbols-outlined mat-icon xxltxt"> close </i>
                                    </button>
                                </div>
                                <div class="top-content pb-5">
                                    <h5>Upload Video Link</h5>
                                </div>
                                <div class="mid-area">
                                    <div class="d-flex mb-5 gap-3">
                                        <div class="profile-box">
                                            <a href="#"><img src="feed_assets/images/add-post-avatar.png" class="max-un" alt="icon"></a>
                                        </div>
                                        <textarea cols="10" rows="2" placeholder="Write something to Lerio.."></textarea>
                                    </div>
                                    <div class="file-upload">
                                        <label>Upload attachment</label>
                                        <input type="text" name="file_upload" id="file_upload">
                                    </div>
                                </div>
                                <div class="footer-area pt-5">
                                    <div class="btn-area d-flex justify-content-end gap-2">
                                        <button type="button" class="cmn-btn alt" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                        <button class="cmn-btn">Upload</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Go Live Popup end -->

    <!-- video popup start -->
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
                                            <a href="#"><img src="feed_assets/images/add-post-avatar.png" class="max-un" alt="icon"></a>
                                        </div>
                                        <textarea cols="10" rows="2" placeholder="Write something to Lerio.."></textarea>
                                    </div>
                                    <div class="file-upload">
                                        <label>Upload attachment</label>
                                        <label class="file mt-1">
                                            <input type="file">
                                            <span class="file-custom pt-8 pb-8 d-grid text-center">
                                                <i class="material-symbols-outlined mat-icon"> perm_media </i>
                                                <span>Drag here or click to upload photo.</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="footer-area pt-5">
                                    <div class="btn-area d-flex justify-content-end gap-2">
                                        <button type="button" class="cmn-btn alt" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                        <button class="cmn-btn">Post</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- video popup end -->
     @endsection
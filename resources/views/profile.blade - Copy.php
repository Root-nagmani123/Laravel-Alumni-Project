   @extends('layouts.app')

   @section('title', 'User Feed - Alumni | Lal Bahadur Shastri National Academy of Administration')

   @section('content')
  
   <!-- Main Content start -->
   <i class="fa-light fa-face-awesome"></i>
   <main class="main-content">
       <div class="container sidebar-toggler">
           <div class="row">
<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4 cus-z2">
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
                               <img class="avatar-img max-un" src="http://4.247.151.249/feed_assets/images/avatar-1.png"
                                   alt="avatar">
                           </div>
                           <div class="text-area">
                                									 <h6 class="m-0 mb-1"><a href="profile-post.html">dk!</a></h6>
								

						<p class="mdtxt">@ dk</p>  

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
                                       <img src="http://4.247.151.249/feed_assets/images/shortcuts-1.png" alt="icon">

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
              <div class="col-12 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-0 mt-lg-10 mt-xl-0 d-flex flex-column gap-7 cus-z">
                   <div class="story-carousel">
                       <div class="single-item">
                           <div class="single-slide">
                               <a href="#" class="position-relative d-center">
                                   <img class="bg-img" src="http://4.247.151.249/feed_assets/images/story-slider-owner.png" alt="icon">
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
                                   <img class="bg-img" src="http://4.247.151.249/feed_assets/images/story-slider-1.png" alt="image">
                                   <a href="public-profile-post.html" class="abs-area p-3 position-absolute bottom-0">
                                       <img src="http://4.247.151.249/feed_assets/images/avatar-1.png" alt="image">
                                       <span class="mdtxt">Alen Lio</span>
                                   </a>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="share-post d-flex gap-3 gap-sm-5 p-3 p-sm-5">
                       <div class="profile-box">
                           <a href="#"><img src="http://4.247.151.249/feed_assets/images/add-post-avatar.png" class="max-un" alt="icon"></a>
                       </div>
                       <form id="create-post-form" enctype="multipart/form-data" class="w-100 position-relative">
    <textarea name="content" cols="10" rows="2" placeholder="Write something to Lerio.."></textarea>
    <input type="file" name="media[]" multiple class="d-none" id="mediaInput"> <!-- Required -->

    <div class="abs-area position-absolute d-none d-sm-block">
        <i class="material-symbols-outlined mat-icon xxltxt"> sentiment_satisfied </i>
    </div>
    <ul class="d-flex text-end mt-3 gap-3">
        <li class="d-flex gap-2" data-bs-toggle="modal" data-bs-target="#goLiveMod">
            <img src="http://4.247.151.249/feed_assets/images/icon/live-video.png" class="max-un" alt="icon">
            <span>Live</span>
        </li>
        <li class="d-flex gap-2" data-bs-toggle="modal" data-bs-target="#photoVideoMod">
           <img src="http://4.247.151.249/feed_assets/images/icon/vgallery.png" class="max-un" alt="icon">
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
                    <img class="avatar-img max-un" src="http://4.247.151.249/feed_assets/images/avatar-1.png" alt="avatar">
                </div>
                <div class="info-area">
                    <h6 class="m-0"><a href="#">dk</a></h6>
                    <span class="mdtxt status">Active</span>
                </div>
            </div>
        </div>

        <div class="py-4">
            <p class="description"></p>
        </div>

        
        

    
    <div class="post-img d-flex justify-content-between flex-wrap gap-2 gap-lg-3 mt-2">
                    <div class="single d-grid gap-3">
                                    <img src="http://4.247.151.249/storage/posts/media/6852888ebce9f_09_03_25.jpg" alt="Post Image" loading="lazy">
                                    <img src="http://4.247.151.249/storage/posts/media/6852888ebf2c6_15_02_25.jpg" alt="Post Image" loading="lazy">
                            </div>
                    <div class="single d-grid gap-3">
                                    <img src="http://4.247.151.249/storage/posts/media/6852888ec1b48_30_04_25.jpg" alt="Post Image" loading="lazy">
                                    <img src="http://4.247.151.249/storage/posts/media/6852888ec3f70_13_01_25.jpg" alt="Post Image" loading="lazy">
                            </div>
                    <div class="single ">
                                    <img src="http://4.247.151.249/storage/posts/media/6852888ec649b_10_03_23.jpg" alt="Post Image" loading="lazy">
                            </div>
            </div>


    </div>

    
    <div class="total-react-share pb-4 d-center gap-2 flex-wrap justify-content-between">
        <div class="friends-list d-flex gap-3 align-items-center text-center">
            <ul class="d-flex align-items-center justify-content-center">
                                            </ul>
        </div>
        <div class="react-list d-flex flex-wrap gap-6 align-items-center text-center">
            <!--<button class="mdtxt">0 Comments</button>-->
           <!-- Button -->
            <button class="mdtxt">
                0 Comments
            </button>
            <button class="mdtxt">0 Shares</button>
        </div>
    </div>

    
    <div class="like-comment-share py-5 d-center flex-wrap gap-3 gap-md-0 justify-content-between">
        <!--<button onclick="likePost(5)" class="d-center gap-1 gap-sm-2 mdtxt">
            <i class="material-symbols-outlined mat-icon"> favorite </i> Like
        </button>-->
  
   <button
    onclick="likePost(5)"
    id="like-btn-5"
    class="d-center gap-1 gap-sm-2 mdtxt">
    Like
</button>
	



        <button class="d-center gap-1 gap-sm-2 mdtxt" onclick="toggleComments(5)">
            <i class="material-symbols-outlined mat-icon"> chat </i> Comment
        </button>
        <button class="d-center gap-1 gap-sm-2 mdtxt" >
            <i class="material-symbols-outlined mat-icon"> share </i> Share
        </button>
    </div>

<!-- Comments container -->
<div id="comments-5" class="comments-box" style="display: none; margin-top: 10px;">
            <p>No comments yet.</p>
    </div>

    
    <form action="http://4.247.151.249/user/comments" method="POST">
        <input type="hidden" name="_token" value="Oj3M34IUHKjZjtcG3tb6zjDn9tzOzmj8WknCIXTr" autocomplete="off">        <input type="hidden" name="post_id" value="5">
        <div class="d-flex mt-5 gap-3">
            <div class="profile-box d-none d-xxl-block">
                <a href="#"><img src="http://4.247.151.249/feed_assets/images/add-post-avatar.png" class="max-un" alt="icon"></a>
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
<div class="post-single-box p-3 p-sm-5">
    <div class="top-area pb-5">
        <div class="profile-area d-center justify-content-between">
            <div class="avatar-item d-flex gap-3 align-items-center">
                
                <div class="avatar position-relative">
                    <img class="avatar-img max-un" src="http://4.247.151.249/feed_assets/images/avatar-1.png" alt="avatar">
                </div>
                <div class="info-area">
                    <h6 class="m-0"><a href="#">dk</a></h6>
                    <span class="mdtxt status">Active</span>
                </div>
            </div>
        </div>

        <div class="py-4">
            <p class="description">sadsdasdasd</p>
        </div>

        
        

    
    <div class="post-img mt-2">
        <img src="http://4.247.151.249/storage/posts/media/6852487d4f73a_beautiful_scenery_digital_art-wallpaper-1920x1200.jpg" loading="lazy" class="w-100" alt="Post Image">
    </div>


    </div>

    
    <div class="total-react-share pb-4 d-center gap-2 flex-wrap justify-content-between">
        <div class="friends-list d-flex gap-3 align-items-center text-center">
            <ul class="d-flex align-items-center justify-content-center">
                                            </ul>
        </div>
        <div class="react-list d-flex flex-wrap gap-6 align-items-center text-center">
            <!--<button class="mdtxt">1 Comments</button>-->
           <!-- Button -->
            <button class="mdtxt">
                1 Comments
            </button>
            <button class="mdtxt">0 Shares</button>
        </div>
    </div>

    
    <div class="like-comment-share py-5 d-center flex-wrap gap-3 gap-md-0 justify-content-between">
        <!--<button onclick="likePost(4)" class="d-center gap-1 gap-sm-2 mdtxt">
            <i class="material-symbols-outlined mat-icon"> favorite </i> Like
        </button>-->
  
   <button
    onclick="likePost(4)"
    id="like-btn-4"
    class="d-center gap-1 gap-sm-2 mdtxt">
    Like
</button>
	



        <button class="d-center gap-1 gap-sm-2 mdtxt" onclick="toggleComments(4)">
            <i class="material-symbols-outlined mat-icon"> chat </i> Comment
        </button>
        <button class="d-center gap-1 gap-sm-2 mdtxt" >
            <i class="material-symbols-outlined mat-icon"> share </i> Share
        </button>
    </div>

<!-- Comments container -->
<div id="comments-4" class="comments-box" style="display: none; margin-top: 10px;">
            <div class="comment-item mb-2">
            <strong></strong> sdasdasd
        </div>
    </div>

    
    <form action="http://4.247.151.249/user/comments" method="POST">
        <input type="hidden" name="_token" value="Oj3M34IUHKjZjtcG3tb6zjDn9tzOzmj8WknCIXTr" autocomplete="off">        <input type="hidden" name="post_id" value="4">
        <div class="d-flex mt-5 gap-3">
            <div class="profile-box d-none d-xxl-block">
                <a href="#"><img src="http://4.247.151.249/feed_assets/images/add-post-avatar.png" class="max-un" alt="icon"></a>
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
<div class="post-single-box p-3 p-sm-5">
    <div class="top-area pb-5">
        <div class="profile-area d-center justify-content-between">
            <div class="avatar-item d-flex gap-3 align-items-center">
                
                <div class="avatar position-relative">
                    <img class="avatar-img max-un" src="http://4.247.151.249/feed_assets/images/avatar-1.png" alt="avatar">
                </div>
                <div class="info-area">
                    <h6 class="m-0"><a href="#">dk</a></h6>
                    <span class="mdtxt status">Active</span>
                </div>
            </div>
        </div>

        <div class="py-4">
            <p class="description"></p>
        </div>

        
        

    
    <div class="post-img d-flex justify-content-between flex-wrap gap-2 gap-lg-3 mt-2">
                    <div class="single d-grid gap-3">
                                    <img src="http://4.247.151.249/storage/posts/media/6850ffe3277ca_img1.PNG" alt="Post Image" loading="lazy">
                                    <img src="http://4.247.151.249/storage/posts/media/6850ffe329c59_img2.PNG" alt="Post Image" loading="lazy">
                            </div>
                    <div class="single ">
                                    <img src="http://4.247.151.249/storage/posts/media/6850ffe32c122_img3.PNG" alt="Post Image" loading="lazy">
                            </div>
            </div>


    </div>

    
    <div class="total-react-share pb-4 d-center gap-2 flex-wrap justify-content-between">
        <div class="friends-list d-flex gap-3 align-items-center text-center">
            <ul class="d-flex align-items-center justify-content-center">
                                            </ul>
        </div>
        <div class="react-list d-flex flex-wrap gap-6 align-items-center text-center">
            <!--<button class="mdtxt">3 Comments</button>-->
           <!-- Button -->
            <button class="mdtxt">
                3 Comments
            </button>
            <button class="mdtxt">0 Shares</button>
        </div>
    </div>

    
    <div class="like-comment-share py-5 d-center flex-wrap gap-3 gap-md-0 justify-content-between">
        <!--<button onclick="likePost(3)" class="d-center gap-1 gap-sm-2 mdtxt">
            <i class="material-symbols-outlined mat-icon"> favorite </i> Like
        </button>-->
  
   <button
    onclick="likePost(3)"
    id="like-btn-3"
    class="d-center gap-1 gap-sm-2 mdtxt">
    Like
</button>
	



        <button class="d-center gap-1 gap-sm-2 mdtxt" onclick="toggleComments(3)">
            <i class="material-symbols-outlined mat-icon"> chat </i> Comment
        </button>
        <button class="d-center gap-1 gap-sm-2 mdtxt" >
            <i class="material-symbols-outlined mat-icon"> share </i> Share
        </button>
    </div>

<!-- Comments container -->
<div id="comments-3" class="comments-box" style="display: none; margin-top: 10px;">
            <div class="comment-item mb-2">
            <strong></strong> hello
        </div>
            <div class="comment-item mb-2">
            <strong></strong> hello
        </div>
            <div class="comment-item mb-2">
            <strong></strong> sdasdasd
        </div>
    </div>

    
    <form action="http://4.247.151.249/user/comments" method="POST">
        <input type="hidden" name="_token" value="Oj3M34IUHKjZjtcG3tb6zjDn9tzOzmj8WknCIXTr" autocomplete="off">        <input type="hidden" name="post_id" value="3">
        <div class="d-flex mt-5 gap-3">
            <div class="profile-box d-none d-xxl-block">
                <a href="#"><img src="http://4.247.151.249/feed_assets/images/add-post-avatar.png" class="max-un" alt="icon"></a>
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
<div class="post-single-box p-3 p-sm-5">
    <div class="top-area pb-5">
        <div class="profile-area d-center justify-content-between">
            <div class="avatar-item d-flex gap-3 align-items-center">
                
                <div class="avatar position-relative">
                    <img class="avatar-img max-un" src="http://4.247.151.249/feed_assets/images/avatar-1.png" alt="avatar">
                </div>
                <div class="info-area">
                    <h6 class="m-0"><a href="#">dk</a></h6>
                    <span class="mdtxt status">Active</span>
                </div>
            </div>
        </div>

        <div class="py-4">
            <p class="description">test</p>
        </div>

        
        

    
    <div class="post-img mt-2">
        <img src="http://4.247.151.249/storage/posts/media/6850ffc02e9fe_img2.PNG" loading="lazy" class="w-100" alt="Post Image">
    </div>


    </div>

    
    <div class="total-react-share pb-4 d-center gap-2 flex-wrap justify-content-between">
        <div class="friends-list d-flex gap-3 align-items-center text-center">
            <ul class="d-flex align-items-center justify-content-center">
                                            </ul>
        </div>
        <div class="react-list d-flex flex-wrap gap-6 align-items-center text-center">
            <!--<button class="mdtxt">0 Comments</button>-->
           <!-- Button -->
            <button class="mdtxt">
                0 Comments
            </button>
            <button class="mdtxt">0 Shares</button>
        </div>
    </div>

    
    <div class="like-comment-share py-5 d-center flex-wrap gap-3 gap-md-0 justify-content-between">
        <!--<button onclick="likePost(2)" class="d-center gap-1 gap-sm-2 mdtxt">
            <i class="material-symbols-outlined mat-icon"> favorite </i> Like
        </button>-->
  
   <button
    onclick="likePost(2)"
    id="like-btn-2"
    class="d-center gap-1 gap-sm-2 mdtxt">
    Like
</button>
	



        <button class="d-center gap-1 gap-sm-2 mdtxt" onclick="toggleComments(2)">
            <i class="material-symbols-outlined mat-icon"> chat </i> Comment
        </button>
        <button class="d-center gap-1 gap-sm-2 mdtxt" >
            <i class="material-symbols-outlined mat-icon"> share </i> Share
        </button>
    </div>

<!-- Comments container -->
<div id="comments-2" class="comments-box" style="display: none; margin-top: 10px;">
            <p>No comments yet.</p>
    </div>

    
    <form action="http://4.247.151.249/user/comments" method="POST">
        <input type="hidden" name="_token" value="Oj3M34IUHKjZjtcG3tb6zjDn9tzOzmj8WknCIXTr" autocomplete="off">        <input type="hidden" name="post_id" value="2">
        <div class="d-flex mt-5 gap-3">
            <div class="profile-box d-none d-xxl-block">
                <a href="#"><img src="http://4.247.151.249/feed_assets/images/add-post-avatar.png" class="max-un" alt="icon"></a>
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
<div class="post-single-box p-3 p-sm-5">
    <div class="top-area pb-5">
        <div class="profile-area d-center justify-content-between">
            <div class="avatar-item d-flex gap-3 align-items-center">
                
                <div class="avatar position-relative">
                    <img class="avatar-img max-un" src="http://4.247.151.249/feed_assets/images/avatar-1.png" alt="avatar">
                </div>
                <div class="info-area">
                    <h6 class="m-0"><a href="#">dk</a></h6>
                    <span class="mdtxt status">Active</span>
                </div>
            </div>
        </div>

        <div class="py-4">
            <p class="description">test</p>
        </div>

        
        

    
    <div class="post-img mt-2">
        <img src="http://4.247.151.249/storage/posts/media/684ff2cee81e3_img1.PNG" loading="lazy" class="w-100" alt="Post Image">
    </div>


    </div>

    
    <div class="total-react-share pb-4 d-center gap-2 flex-wrap justify-content-between">
        <div class="friends-list d-flex gap-3 align-items-center text-center">
            <ul class="d-flex align-items-center justify-content-center">
                                            </ul>
        </div>
        <div class="react-list d-flex flex-wrap gap-6 align-items-center text-center">
            <!--<button class="mdtxt">0 Comments</button>-->
           <!-- Button -->
            <button class="mdtxt">
                0 Comments
            </button>
            <button class="mdtxt">0 Shares</button>
        </div>
    </div>

    
    <div class="like-comment-share py-5 d-center flex-wrap gap-3 gap-md-0 justify-content-between">
        <!--<button onclick="likePost(1)" class="d-center gap-1 gap-sm-2 mdtxt">
            <i class="material-symbols-outlined mat-icon"> favorite </i> Like
        </button>-->
  
   <button
    onclick="likePost(1)"
    id="like-btn-1"
    class="d-center gap-1 gap-sm-2 mdtxt">
    Like
</button>
	



        <button class="d-center gap-1 gap-sm-2 mdtxt" onclick="toggleComments(1)">
            <i class="material-symbols-outlined mat-icon"> chat </i> Comment
        </button>
        <button class="d-center gap-1 gap-sm-2 mdtxt" >
            <i class="material-symbols-outlined mat-icon"> share </i> Share
        </button>
    </div>

<!-- Comments container -->
<div id="comments-1" class="comments-box" style="display: none; margin-top: 10px;">
            <p>No comments yet.</p>
    </div>

    
    <form action="http://4.247.151.249/user/comments" method="POST">
        <input type="hidden" name="_token" value="Oj3M34IUHKjZjtcG3tb6zjDn9tzOzmj8WknCIXTr" autocomplete="off">        <input type="hidden" name="post_id" value="1">
        <div class="d-flex mt-5 gap-3">
            <div class="profile-box d-none d-xxl-block">
                <a href="#"><img src="http://4.247.151.249/feed_assets/images/add-post-avatar.png" class="max-un" alt="icon"></a>
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

                 <!-- multiple images section -->



                       <!-- multiple images section -->

                   </div>
               </div>
 
       </div>
   </main>
 
		   
@endsection

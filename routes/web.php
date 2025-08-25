<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\MapController;

use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\ForumController;
use App\Http\Controllers\Admin\BroadcastController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\SocialWallController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\OtpLoginController;

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\FeedController;
use App\Http\Controllers\User\PostController;
use App\Http\Middleware\UserAuthMiddleware;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\MentorMenteeController;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

use App\Http\Controllers\Member\ChangePasswordController;
use App\Http\Controllers\Member\GroupController as MemberGroupController;
use App\Http\Controllers\Member\ForumController as MemberForumController;

Route::resource('post', PostController::class);

use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\StoryController;
use Carbon\Carbon;



Route::get('/clear/1', function () {
    Artisan::call('cache:clear');
     Artisan::call('config:cache');
    Artisan::call('optimize:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return redirect()->back()->with('success', 'Cache cleared successfully');
});

Route::get('/check-time', function () {
    // Set timezone to Asia/Kolkata for this request
    date_default_timezone_set('Asia/Kolkata');

    // Return current date & time and timezone
    return [
        'server_time'     => now()->toDateTimeString(),
        'carbon_time'     => Carbon::now()->toDateTimeString(),
        'php_time'        => date('Y-m-d H:i:s'),
        'timezone_config' => config('app.timezone'),
        'php_timezone'    => date_default_timezone_get(),
    ];
});


Route::get('/db-check', function () {
    $dbName = DB::select("SELECT DATABASE() AS db");
    $user = DB::select("SELECT USER() AS user");
    $host = DB::select("SELECT @@hostname AS host");

    return [
        'connected_database' => $dbName[0]->db,
        'database_user' => $user[0]->user,
        'db_host' => $host[0]->host,

    ];
});


Route::redirect('/login', '/user/login');
Route::get('/', function () {
    return redirect('/user/login');
});

Route::prefix('user')->name('user.')->group(function () {

    Route::middleware('guest:user')->group(function () {
        // print_r(Auth::guard('user')->check());die;
        if (Auth::guard('user')->check()) {
            return redirect()->route('user.feed');
        }
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::get('/loginldap', [AuthController::class, 'showLoginForm_ldap'])->name('loginldap');
        Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
        Route::post('/login_ldap', [AuthController::class, 'login_ldap'])->name('login.submit_ldap');
    });
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

      Route::middleware(UserAuthMiddleware::class)->group(function () {
        Route::get('/feed', [FeedController::class, 'index'])->name('feed');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
		Route::put('/post/update/{id}', [PostController::class, 'update'])->name('post.update');
		Route::post('/post', [PostController::class, 'store'])->name('post.store');
        Route::get('/posts/{id}/edit', [PostController::class, 'edit']);
  Route::put('/posts/{id}', [PostController::class, 'update']);
  Route::delete('/posts/{id}', [PostController::class, 'destroy']);


		Route::post('/group-post', [PostController::class, 'group_post_store'])->name('group.post');

		Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

        Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
        Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
        Route::get('/load-comments/{post}', [CommentController::class, 'loadComments'])->name('load.comments');

         Route::post('/stories', [StoryController::class, 'store'])->name('stories.store');
         Route::delete('/delete-story/{id}', [StoryController::class, 'destroy'])->name('stories.destroy');


        Route::post('/forum-store', [PostController::class, 'forum_store'])->name('forum.store');

		Route::post('/post/{post}/like', [PostController::class, 'toggleLike'])->name('post.like');
		//Route::post('/user/comments', [CommentController::class, 'store'])->name('user.comments.store');
		//Route::put('/user/comments/{id}', [CommentController::class, 'update'])->name('user.comments.update');
		//Route::delete('/user/comments/{id}', [CommentController::class, 'destroy'])->name('user.comments.destroy');
		Route::middleware('auth')->group(function () {
    //Route::put('/user/profile/update', [UserController::class, 'update'])->name('user.profile.update');
    // other protected routes
  });




































  
         Route::get('/profile/{id}', [ProfileController::class, 'showById'])->where('id', '[0-9]+')->name('profile');
         Route::get('/profile/{name}', [ProfileController::class, 'showByName'])->where('name', '[a-zA-Z\s]+')->name('profile.name');

         Route::get('/profile/data/{id}', [ProfileController::class, 'showById_data'])->where('id', '[0-9]+')->name('profile.data');
         Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

        Route::put('/eduinfo/update/{id}', [ProfileController::class, 'updateEduinfo'])->name('profile.eduinfo');
        Route::put('/proinfo/update/{id}', [ProfileController::class, 'updateProinfo'])->name('profile.proinfo');
        Route::put('/social/update/{id}', [ProfileController::class, 'updateSocial'])->name('profile.social.update');
  		Route::post('favorite-user/toggle', [ProfileController::class, 'toggleFavorite'])->name('favorite.user.toggle');
        Route::get('directory', [DashboardController::class, 'directory'])->name('directory');
       //Route::post('/feed/search', [FeedController::class, 'search'])->name('feed.search');
       Route::get('/search-fav-members', [ProfileController::class, 'searchFavMembers'])->name('search.fav.members');
       Route::get('/profile/id/{id}', [ProfileController::class, 'showById'])->name('profile.id');

	   Route::post('/event-rsvp', [DashboardController::class, 'submitRsvp'])->name('event.rsvp');
	   Route::get('/all-events', [DashboardController::class, 'allevents'])->name('allevents');
      Route::get('/broadcast/{id}', [FeedController::class, 'broadcastDetails'])->name('broadcastDetails');
      Route::get('/group-post/{id}', [FeedController::class, 'getPostByGroup'])->name('group-post');
      Route::get('/library', [LibraryController::class, 'index'])->name('library');
  	Route::post('/groups-leave', [FeedController::class, 'leaveGroup'])->name('groups.leave');
	Route::post('/grievance.submit', [FeedController::class, 'submitGrievance'])->name('grievance.submit');

    });

    Route::middleware('auth:user')->group(function () {
		Route::get('/mentor-mentee', [MentorMenteeController::class, 'index'])->name('mentor_mentee');
		Route::post('/get-years', [MentorMenteeController::class, 'getYears'])->name('get.years');
		Route::post('/get-cadres', [MentorMenteeController::class, 'getCadres'])->name('get.cadres');
		Route::post('/get-sectors', [MentorMenteeController::class, 'getSectors'])->name('get.sectors');
		Route::post('/get-mentees', [MentorMenteeController::class, 'getMentees'])->name('get.mentees');
        Route::post('/filter/mentors_mentee_data', [MentorMenteeController::class, 'filterMentorsData'])->name('filter.mentors_mentee_data');
        Route::post('/mentor/want_become_mentor', [MentorMenteeController::class, 'want_become_mentor'])->name('mentor.want_become_mentor');
		Route::post('/mentor/want_become_mentee', [MentorMenteeController::class, 'want_become_mentee'])->name('mentor.want_become_mentee');
		Route::post('/request/update', [MentorMenteeController::class, 'updateRequest'])->name('request.update');
        Route::get('user/forum', [MemberForumController::class, 'index'])->name('forum');
        Route::post('user/forum/activate', [MemberForumController::class, 'activateForum'])->name('forum.activate');
        Route::get('user/forum/{id}', [MemberForumController::class, 'show'])->name('forum.show');
        Route::put('user/forum/{id}', [MemberForumController::class, 'updateForum'])->name('forum.update');
        // Forum-level like/unlike/comment
        Route::post('user/forum/{id}/like', [MemberForumController::class, 'likeForum'])->name('forum.like');
        Route::post('user/forum/{id}/unlike', [MemberForumController::class, 'unlikeForum'])->name('forum.unlike');
        Route::post('user/forum/{id}/comment', [MemberForumController::class, 'commentForum'])->name('forum.comment');
        Route::put('user/forum/comment/{commentId}', [MemberForumController::class, 'updateForumComment'])->name('forum.comment.update');
        Route::delete('user/forum/comment/{commentId}', [MemberForumController::class, 'deleteForumComment'])->name('forum.comment.delete');
        Route::post('user/forum/topic/{id}/like', [MemberForumController::class, 'like'])->name('forum.topic.like');
        Route::post('user/forum/topic/{id}/unlike', [MemberForumController::class, 'unlike'])->name('forum.topic.unlike');
        Route::post('user/forum/topic/{id}/comment', [MemberForumController::class, 'comment'])->name('forum.topic.comment');
      
        Route::post('user/forum/topic/{id}/store', [MemberForumController::class, 'member_store_topic'])->name('forum.topic.store');
       Route::post('user/forum/delete', [MemberForumController::class, 'deleteforum'])->name('forum.delete');
        Route::get('/notifications', [App\Http\Controllers\Member\NotificationController::class, 'getNotifications'])->name('notifications.get');
        // Route::get('/notifications/{id}', [App\Http\Controllers\Member\NotificationController::class, 'notificationstatus'])->name('notifications.status');
       Route::post('/notifications/{id}/clear', [App\Http\Controllers\Member\NotificationController::class, 'clearNotifications'])
     ->name('notifications.clear');
       
        Route::put('/notifications/{id}/read', [App\Http\Controllers\Member\NotificationController::class, 'markAsRead'])->name('notifications.read');
        Route::get('/get-members', [MemberController::class, 'getMembers'])->name('members.list');

        
    });



	Route::get('/member/search', [MemberForumController::class, 'member_search'])->name('member.search');


});

Route::get('/admin', function () {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('admin.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::redirect('/member','member/login');
Route::prefix('member')->name('member.')->group(function () {
		Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // <- Add this
		Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
		Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


		Route::middleware('auth:member')->group(function () {
		Route::get('/dashboard', function () {
			return view('member.dashboard');
		})->name('dashboard');

		});
});
Route::prefix('member')->middleware('auth:member')->group(function () {
		Route::get('dashboard', [DashboardController::class, 'index'])->name('member.dashboard');
		Route::post('post/comment', [DashboardController::class, 'comment'])->name('member.post.comment');
    });

// Routes accessible *without* login (public)
Route::prefix('admin')->controller(AdminController::class)->group(function () {
    Route::get('/', 'index')->name('auth.admin'); // login form
    Route::get('/login', 'index')->name('auth.admin'); // alias for login
    Route::post('/authlogin', 'loginAuth')->name('admin.authlogin'); // login post

});

// Routes accessible *only after login* using admin guard
Route::prefix('admin')->middleware('auth:admin')->controller(AdminController::class)->group(function () {
		Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/admin/logout', 'logout')->name('admin.logout'); // logout
		// Route::prefix('socialwall')->name('socialwall.')->group(function () {
		// Route::get('/', function () {
		// 	return view('admin.socialwall.index');
		// })->name('index');


	// });


    Route::prefix('topic')->name('recent.topics.')->group(function(){
        Route::get('/', [DashboardController::class, 'recentTopics'])->name('index');
});
		Route::get('socialwall', [AdminController::class, 'socialwall'])->name('socialwall.index');
	Route::get('grievance/list', [AdminController::class, 'grievanceList'])->name('grievance.list');

		Route::delete('delete-socialwall/{id}', [AdminController::class, 'socialwall_delete'])->name('socialwall.delete');

	Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');

	Route::get('mentorship', [AdminController::class, 'mentorship'])->name('admin.mentorship.index');

    Route::post('mentorship/search', [AdminController::class, 'mentorshipSearch'])->name('admin.mentorship.search');
    Route::post('members/search', [AdminController::class, 'membersSearch'])->name('admin.members.search');

   // Location Routes
    Route::prefix('location')->name('admin.location.')->group(function () {
       

        // Country Routes
        Route::get('/country', [App\Http\Controllers\Admin\Location\CountryController::class, 'index'])->name('country');
        Route::get('/country/create', [App\Http\Controllers\Admin\Location\CountryController::class, 'create'])->name('country.create');
        Route::post('/country/store', [App\Http\Controllers\Admin\Location\CountryController::class, 'store'])->name('country.store');
        Route::get('/country/edit/{country}', [App\Http\Controllers\Admin\Location\CountryController::class, 'edit'])->name('country.edit');
        Route::put('/country/update/{country}', [App\Http\Controllers\Admin\Location\CountryController::class, 'update'])->name('country.update');
        Route::delete('/country/destroy/{country}', [App\Http\Controllers\Admin\Location\CountryController::class, 'destroy'])->name('country.destroy');
        Route::post('/country/toggle-status/{country}', [App\Http\Controllers\Admin\Location\CountryController::class, 'toggleStatus'])->name('country.toggle-status');


        // State Routes
        Route::get('/state', [App\Http\Controllers\Admin\Location\StateController::class, 'index'])->name('state');
        Route::get('/state/create', [App\Http\Controllers\Admin\Location\StateController::class, 'create'])->name('state.create');
        Route::post('/state/store', [App\Http\Controllers\Admin\Location\StateController::class, 'store'])->name('state.store');
        Route::get('/state/edit/{state}', [App\Http\Controllers\Admin\Location\StateController::class, 'edit'])->name('state.edit');
        Route::put('/state/update/{state}', [App\Http\Controllers\Admin\Location\StateController::class, 'update'])->name('state.update');
        Route::delete('/state/destroy/{state}', [App\Http\Controllers\Admin\Location\StateController::class, 'destroy'])->name('state.destroy');
        Route::post('/state/toggle-status/{state}', [App\Http\Controllers\Admin\Location\StateController::class, 'toggleStatus'])->name('state.toggle-status');
        Route::post('/get-states', [App\Http\Controllers\Admin\Location\StateController::class, 'getStatesByCountry'])->name('get-states');

        // City Routes
        Route::get('/city', [App\Http\Controllers\Admin\Location\CityController::class, 'index'])->name('city');
        Route::get('/city/create', [App\Http\Controllers\Admin\Location\CityController::class, 'create'])->name('city.create');
        Route::post('/city/store', [App\Http\Controllers\Admin\Location\CityController::class, 'store'])->name('city.store');
        Route::get('/city/edit/{city}', [App\Http\Controllers\Admin\Location\CityController::class, 'edit'])->name('city.edit');
        Route::put('/city/update/{city}', [App\Http\Controllers\Admin\Location\CityController::class, 'update'])->name('city.update');
        Route::delete('/city/destroy/{city}', [App\Http\Controllers\Admin\Location\CityController::class, 'destroy'])->name('city.destroy');
        Route::post('/city/toggle-status/{city}', [App\Http\Controllers\Admin\Location\CityController::class, 'toggleStatus'])->name('city.toggle-status');
        Route::post('city/get-states', [App\Http\Controllers\Admin\Location\CityController::class, 'getStatesByCountry'])->name('city.get-states');

    });

Route::prefix('forums')->name('forums.')->group(function () {
		Route::get('/', [ForumController::class, 'index'])->name('index'); // List all forums
		Route::get('/create', [ForumController::class, 'create'])->name('create'); // Show create form
		Route::post('/', [ForumController::class, 'store'])->name('store'); // Store new memforumsber
		Route::put('/{member}', [ForumController::class, 'update'])->name('update'); // Update forums
		Route::delete('/{member}', [ForumController::class, 'destroy'])->name('destroy'); // Delete forums
		Route::get('add_member/{id}', [ForumController::class, 'add_member'])->name('add_member');
		Route::post('/save_members', [ForumController::class, 'storeMembers'])->name('save_members');
		Route::get('view_member/{id}', [ForumController::class, 'view_member'])->name('view_member');
		Route::get('add_topic/{id}', [ForumController::class, 'add_topic'])->name('add_topic');
		Route::post('/save_topic', [ForumController::class, 'save_topic'])->name('save_topic');
		Route::get('/forums/{id}/topics', [ForumController::class, 'view_forum_topics'])->name('view_topic');
		Route::get('/topics/{id}', [ForumController::class, 'show'])->name('topics.view');
		Route::get('/topics/{id}/edit', [ForumController::class, 'edit'])->name('topics.edit');
		//Route::put('/topics/{id}', [ForumController::class, 'update_topic'])->name('topics.update');
        Route::put('/topics/{id}', [ForumController::class, 'update_topic'])->name('topics.update');
		Route::delete('/topics/{id}', [ForumController::class, 'deleteTopic'])->name('topics.delete');
		Route::get('/{forum}/edit', [ForumController::class, 'forumedit'])->name('forum.edit'); // Show edit form
		Route::put('/update-forum/{forum}', [ForumController::class, 'update_forum'])->name('forum.update');
		Route::delete('/forums/{forum}', [ForumController::class, 'destroyforum'])->name('forum.destroy');
		Route::post('/forums/toggle-status', [ForumController::class, 'toggleStatus'])->name('toggleStatus');
		Route::post('/forums/member-toggle-status', [ForumController::class, 'membertoggleStatus'])->name('membertoggleStatus');
		Route::post('/forums/topic/toggle-status', [ForumController::class, 'TopictoggleStatus'])->name('TopictoggleStatus');
		Route::post('/member/delete', [ForumController::class, 'member_delete_forum'])->name('member.delete');
});



Route::prefix('members')->name('members.')->group(function () {
		Route::get('/', [MemberController::class, 'index'])->name('index'); // List all members
		Route::get('/create', [MemberController::class, 'create'])->name('create'); // Show create form
		Route::post('/', [MemberController::class, 'store'])->name('store'); // Store new member
		Route::get('/{member}/edit', [MemberController::class, 'edit'])->name('edit'); // Show edit form
		Route::put('/{member}', [MemberController::class, 'update'])->name('update'); // Update member
		Route::delete('/{member}', [MemberController::class, 'destroy'])->name('destroy'); // Delete member
		Route::get('/bulk-upload', [MemberController::class, 'bulk_upload_form'])->name('bulk_upload_form'); // Show upload form
		Route::post('/bulk-upload', [MemberController::class, 'bulk_upload_members'])->name('bulk_upload'); // Handle upload
		Route::post('toggle-status', [MemberController::class, 'toggleStatus'])->name('toggleStatus');
});


Route::prefix('group')->name('group.')->group(function () {
		Route::get('/', [GroupController::class, 'index'])->name('index');
		Route::get('/create', [GroupController::class, 'create'])->name('create');
		Route::post('/', [GroupController::class, 'store'])->name('store');
		Route::post('/store_ajax', [GroupController::class, 'store_ajax'])->name('store_ajax');
		Route::get('/{group}/edit', [GroupController::class, 'edit'])->name('edit');
		Route::put('/{group}', [GroupController::class, 'update'])->name('update');
		Route::delete('/{group}', [GroupController::class, 'destroy'])->name('destroy');
		Route::post('toggle-status', [GroupController::class, 'toggleStatus'])->name('toggleStatus');
		Route::get('view_topic/{id}', [GroupController::class, 'view_topic'])->name('topic.view');
		Route::get('add_topic/{id}', [GroupController::class, 'add_topic'])->name('add_topic');
		Route::post('save_topic/{id}', [GroupController::class, 'save_topic'])->name('save_topic');
        Route::put('topics/{id}/update', [GroupController::class, 'updateTopic'])->name('topics_update');
        Route::delete('topics/{id}', [GroupController::class, 'deleteTopic'])->name('topics.delete');
        Route::post('topicToggleStatus', [GroupController::class, 'topicToggleStatus'])->name('topicToggleStatus');
    });



Route::prefix('broadcasts')->name('broadcasts.')->group(function () {

		Route::get('/', [BroadcastController::class, 'index'])->name('index');

		Route::get('/create', function () {return view('admin.broadcasts.create');})->name('create');

		Route::get('/edit', function () {return view('admin.broadcasts.edit');})->name('edit');

		Route::post('/', [BroadcastController::class, 'store'])->name('broadcast.store');

		Route::post('/broadcasts/toggle-status', [BroadcastController::class, 'toggleStatus'])->name('toggleStatus');

		Route::delete('/broadcasts/{broadcast}', [BroadcastController::class, 'destroybroadcast'])->name('broadcast.destroy');

		Route::put('/broadcast/{id}', [BroadcastController::class, 'update'])->name('broadcast.update');

});

Route::prefix('events')->name('events.')->group(function () {
		Route::get('/', [EventsController::class, 'index'])->name('index');
		Route::get('/create', [EventsController::class, 'create'])->name('create');
		Route::post('/', [EventsController::class, 'store'])->name('store');
		//Route::get('/{event}/edit/', [EventsController::class, 'edit'])->name('edit');
		//Route::put('/{event}', [EventsController::class, 'update'])->name('update');
        Route::get('/event/edit/{id}', [EventsController::class, 'edit'])->name('edit');
        Route::put('/event/update/{id}', [EventsController::class, 'update'])->name('update');
		Route::delete('/{event}', [EventsController::class, 'destroy'])->name('destroy');
		Route::post('/toggle-status', [EventsController::class, 'toggleStatus'])->name('toggleStatus');

		Route::get('/events/rsvp/{id?}', [EventsController::class, 'rsvp'])->name('rsvp');
		Route::post('rsvp/toggle-status', [EventsController::class, 'rsvptoggleStatus'])->name('rsvptoggleStatus');
    });




});


Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
		Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
		Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/user_login', function () {
            return view('user.auth.login');
        })->name('user_login');

        Route::get('/user_feed', function () {
            return view('user.feed');
        })->name('user_feed');

        Route::get('/user_feed1', function () {
            return view('user.feed1');
        })->name('user_feed1');
			 Route::get('/user/broadcast', function () {
            return view('user.broadcast');
        })->name('user.broadcast');
         Route::get('/user/library', function () {
            return view('user.library');
        })->name('user.library');
        // Route::get('/user/forum', function () {
        //     return view('user.forum');
        // })->name('user.forum');
        // Route::get('/user/group', function () {
        //     return view('user.groups');
        // })->name('user.groups');
        
         
        Route::get('/admin/mentorship/create', function () {
            return view('admin.mentorship.create');
        })->name('admin.mentorship.create');
         Route::get('/admin/mentorship/edit', function () {
            return view('admin.mentorship.edit');
        })->name('admin.mentorship.edit');
        Route::get('/user/home', function () {
            return view('user.home');
        })->name('user.home');
        Route::get('/admin/topics', function () {
            return view('admin.topics.index');
        })->name('admin.topics.index');
        Route::get('/admin/registration', function () {
            return view('admin.registration.index');
        })->name('admin.registration.index');


require __DIR__.'/auth.php';



Route::get('/maps', [MapController::class, 'showMap'])->name('maps.index');
Route::get('/mapshow', [MapController::class, 'Map'])->name('maps.show');

// User Change Password
Route::middleware(['auth:user'])->group(function () {
    Route::get('/user/change-password', [ChangePasswordController::class, 'showForm'])->name('user.change-password.form');
    Route::post('/user/change-password', [ChangePasswordController::class, 'changePassword'])->name('user.change-password');

    Route::prefix('group')->name('user.group.')->group(function () {
         
        Route::post('/activate-group', [MemberGroupController::class, 'activateGroup'])->name('activate-group');
        Route::get('/', [MemberGroupController::class, 'index'])->name('index');
        Route::get('/create', [MemberGroupController::class, 'create'])->name('create');
        Route::post('/store', [MemberGroupController::class, 'store'])->name('store');
        Route::get('/{group}/edit', [MemberGroupController::class, 'edit'])->name('edit');
        Route::put('/{group}', [MemberGroupController::class, 'update'])->name('update');
        Route::delete('/{group}', [MemberGroupController::class, 'destroy'])->name('destroy');

   
        Route::delete('group_post_data/{post}', [MemberGroupController::class, 'post_destroy'])->name('post.destroy');


    });

    
});

Route::get('/user-search', [MemberController::class, 'user_search'])->name('user.search');

Route::post('/otp/send', [OtpLoginController::class, 'sendOtp'])->name('otp.send');
Route::post('/otp/verify', [OtpLoginController::class, 'verifyOtp'])->name('otp.verify');
Route::get('/admin/members/list', [App\Http\Controllers\Admin\GroupController::class, 'getMembers'])
    ->name('admin.members.list');

Route::post('/custom-broadcasting-auth', function(\Illuminate\Http\Request $request) {
    return response()->json([
        'auth' => hash('sha256', $request->socket_id . ':' . $request->channel_name . ':bypass')
    ]);
})->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class); 
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\ForumController;
use App\Http\Controllers\Admin\BroadcastController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\DashboardController;


use App\Http\Controllers\Member\AuthController;


Route::get('/clear/1', function () {
	Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('optimize:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
   // Artisan::call('storage:link');
    return redirect()->back()->with('success', 'Cache cleared successfully');
});



Route::get('/test-member', function () {
    return 'Member Route Working';
});
Route::get('/', function () {
    return view('welcome');
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
    Route::post('post/like', [DashboardController::class, 'like'])->name('member.post.like');
    Route::post('post/comment', [DashboardController::class, 'comment'])->name('member.post.comment');
    Route::post('rsvp/update', [DashboardController::class, 'updateRSVP'])->name('member.rsvp.update');
});

// Routes accessible *without* login (public)
Route::prefix('admin')->controller(AdminController::class)->group(function () {
    Route::get('/', 'index')->name('auth.admin'); // login form
    Route::get('/login', 'index')->name('auth.admin'); // alias for login
    Route::post('/authlogin', 'loginAuth')->name('admin.authlogin'); // login post

});

// Routes accessible *only after login* using admin guard
Route::prefix('admin')->middleware('auth:admin')->controller(AdminController::class)->group(function () {
	//Route::get('dashboard', 'dashboard')->name('dashboard');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/admin/logout', 'logout')->name('admin.logout'); // logout



	Route::prefix('socialwall')->name('socialwall.')->group(function () {
    Route::get('/', function () {
        return view('admin.socialwall.index');
    })->name('index');


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
   // Route::put('/topics/{id}', [ForumController::class, 'update_topic'])->name('topics.update');
   Route::put('/topics/{id}', [ForumController::class, 'update_topic'])->name('topics.update');
//Route::delete('topics/{id}', [ForumController::class, 'deleteTopic'])->name('forums.topics.delete');

   Route::delete('/topics/{id}', [ForumController::class, 'deleteTopic'])->name('topics.delete');
    Route::get('/{forum}/edit', [ForumController::class, 'forumedit'])->name('forum.edit'); // Show edit form
    Route::put('/update-forum/{forum}', [ForumController::class, 'update_forum'])->name('forum.update');
    Route::delete('/forums/{forum}', [ForumController::class, 'destroyforum'])->name('forum.destroy');
    Route::post('/forums/toggle-status', [ForumController::class, 'toggleStatus'])->name('toggleStatus');
    Route::post('/forums/topic/toggle-status', [ForumController::class, 'TopictoggleStatus'])->name('TopictoggleStatus');


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
    Route::get('/{group}/edit', [GroupController::class, 'edit'])->name('edit');
    Route::put('/{group}', [GroupController::class, 'update'])->name('update');
    Route::delete('/{group}', [GroupController::class, 'destroy'])->name('destroy');
    Route::post('toggle-status', [GroupController::class, 'toggleStatus'])->name('toggleStatus');
    Route::get('view_topic/{id}', [GroupController::class, 'view_topic'])->name('topic.view');


   /* Route::get('add_topic/{id}', [GroupController::class, 'add_topic'])->name('add_topic');
    Route::get('save_topic', [GroupController::class, 'save_topic'])->name('save_topic');*/

Route::get('add_topic/{id}', [GroupController::class, 'add_topic'])->name('add_topic');

Route::post('save_topic/{id}', [GroupController::class, 'save_topic'])->name('save_topic');

Route::put('topics/{id}/update', [ForumController::class, 'updateTopic'])->name('topics.update');
Route::delete('topics/{id}', [ForumController::class, 'deleteTopic'])->name('topics.delete');


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


/* Route::prefix('events')->name('events.')->group(function () {

    Route::get('/', [EventsController::class, 'index'])->name('index');

	Route::get('/create', function () {return view('admin.events.create');})->name('create');

    Route::get('/edit', function () {return view('admin.events.edit');})->name('edit');

    Route::post('/', [EventsController::class, 'store'])->name('events.store');

    Route::post('/events/toggle-status', [EventsController::class, 'toggleStatus'])->name('toggleStatus');

});
 */


/* Route::prefix('events')->name('events.')->group(function () {
    Route::get('/', [EventsController::class, 'index'])->name('index');
    Route::get('/create', [EventsController::class, 'create'])->name('create');
    Route::post('/', [EventsController::class, 'store'])->name('store'); // ✅ This is the missing route
    Route::get('/{event}/edit', [EventsController::class, 'edit'])->name('edit');
    Route::put('/{event}', [EventsController::class, 'update'])->name('update');
    Route::delete('/{event}', [EventsController::class, 'destroy'])->name('destroy');
	Route::post('toggle-status', [EventsController::class, 'toggleStatus'])->name('toggleStatus');
});

  */

  Route::prefix('events')->name('events.')->group(function () {
    Route::get('/', [EventsController::class, 'index'])->name('index');
    Route::get('/create', [EventsController::class, 'create'])->name('create');
    Route::post('/', [EventsController::class, 'store'])->name('store');
    Route::get('/{event}/edit', [EventsController::class, 'edit'])->name('edit');
    Route::put('/{event}', [EventsController::class, 'update'])->name('update');
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

require __DIR__.'/auth.php';

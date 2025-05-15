<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
//App\Http\Controllers\Admin\Controller
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

/* Route::get('/', function () {
    return view('welcome');
});
 */
  


//use App\Http\Controllers\Auth\LoginController;
/* use App\Http\Controllers\Admin\{
    RoleController,
    PermissionController,
    UserController,
    MemberController
};
 */
Route::get('/clear/1', function () {
	Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('optimize:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
   // Artisan::call('storage:link');
    return redirect()->back()->with('success', 'Cache cleared successfully');
});


/* Route::group(['prefix' => 'admin'], function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name('auth.admin');
        Route::get('/login', 'index')->name('auth.admin');
        Route::post('/authlogin', 'loginAuth');
        //Route::post('/logout', 'logout')->name('logout');
		Route::post('/admin/logout', [AdminController::class, 'logout'])->name('logout');
        Route::get('/dashboard', 'dashboard')->name('dashboard');
       
    });  
});  

 */
 


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Routes accessible *without* login (public)
Route::prefix('admin')->controller(AdminController::class)->group(function () {
    Route::get('/', 'index')->name('auth.admin'); // login form
    Route::get('/login', 'index')->name('auth.admin'); // alias for login
    Route::post('/authlogin', 'loginAuth')->name('admin.authlogin'); // login post
});

// Routes accessible *only after login* using admin guard
Route::prefix('admin')->middleware('auth:admin')->controller(AdminController::class)->group(function () {
    //Route::get('/dashboard', 'dashboard')->name('dashboard'); // protected
	Route::get('dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout'); // logout
});


 // social_wall route
    Route::prefix('socialwall')->name('admin.socialwall.')->group(function () {
    Route::get('/', function () {
        return view('admin.socialwall.index');
    })->name('index');
});


    // broadcasts route
    Route::prefix('broadcasts')->name('broadcasts')->group(function () {
        Route::get('/', function () {
            return view('admin.broadcasts.index');
        })->name('index');

        Route::get('/create', function () {
            return view('admin.broadcasts.create');
        })->name('create');

        Route::get('/edit', function () {
            return view('admin.broadcasts.edit');
        })->name('edit');
    });


   

    // events route
    Route::prefix('events')->name('events')->group(function () {
        Route::get('/', function () {
            return view('admin.events.index');
        })->name('index');

        Route::get('/create', function () {
            return view('admin.events.create');
        })->name('create');

        Route::get('/edit', function () {
            return view('admin.events.edit');
        })->name('edit');
    });


  // forums route
    Route::prefix('forums')->name('forums')->group(function () {
        Route::get('/', function () {
            return view('admin.forums.index');
        })->name('index');

        Route::get('/create', function () {
            return view('admin.forums.create');
        })->name('create');

        Route::get('/edit', function () {
            return view('admin.forums.edit');
        })->name('edit');
    });

  // members route
    Route::prefix('members')->name('members')->group(function () {
        Route::get('/', function () {
            return view('admin.members.index');
        })->name('index');

        Route::get('/create', function () {
            return view('admin.members.create');
        })->name('create');

        Route::get('/edit', function () {
            return view('admin.members.edit');
        })->name('edit');
    });
	
	// groups route
    Route::prefix('groups')->name('groups')->group(function () {
        Route::get('/', function () {
            return view('admin.groups.index');
        })->name('index');

        Route::get('/create', function () {
            return view('admin.groups.create');
        })->name('create');

        Route::get('/edit', function () {
            return view('admin.groups.edit');
        })->name('edit');
    });




 



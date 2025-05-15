
<?php
use Illuminate\Support\Facades\Route;


//Route::get('admin/login', [LoginController::class,'showLoginPage']);
Route::middleware(['admin_guest'])->group(function(){

Route::get('/admin/login', [App\Http\Controllers\Admin\AdminController::class, 'loginAuth'])
                            ->name('admin.login.page');

Route::post('/admin/login', [App\Http\Controllers\Admin\AdminController::class, 'loginAuth'])
                            ->name('admin.login');

Route::get('user/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('user.dashboard');


});


Route::middleware(['admin_auth'])->group(function(){

    Route::get('admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/logout', [App\Http\Controllers\Admin\AdminController::class, 'logout'])->name('admin.logout');

   // Route::get('admin/data', [App\Http\Controllers\Admin\PagesController::class, 'index'])->name('admin.data');

});





 // social_wall route
    Route::prefix('socialwall')->name('admin.socialwall.')->group(function () {
    Route::get('/', function () {
        return view('admin.socialwall.index');
    })->name('index');
});


    // broadcasts route
    Route::prefix('broadcasts')->name('admin.broadcasts.')->group(function () {
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
    Route::prefix('events')->name('admin.events.')->group(function () {
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
    Route::prefix('forums')->name('admin.forums.')->group(function () {
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
    Route::prefix('members')->name('admin.members.')->group(function () {
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
    Route::prefix('groups')->name('admin.groups.')->group(function () {
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




 






?>

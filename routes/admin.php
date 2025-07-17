
<?php
use Illuminate\Support\Facades\Route;


//Route::get('admin/login', [LoginController::class,'showLoginPage']);
Route::middleware(['admin_guest'])->group(function(){

// Route::get('/admin/login', [App\Http\Controllers\Admin\AdminController::class, 'loginAuth'])
//                             ->name('admin.login.page');

Route::post('/admin/login', [App\Http\Controllers\Admin\AdminController::class, 'loginAuth'])
                            ->name('admin.login');

Route::get('user/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('user.dashboard');


});


Route::middleware(['admin_auth'])->group(function(){

    Route::get('admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/logout', [App\Http\Controllers\Admin\AdminController::class, 'logout'])->name('admin.logout');

   // Route::get('admin/data', [App\Http\Controllers\Admin\PagesController::class, 'index'])->name('admin.data');

    
//Location route group
Route::prefix('admin/location')->name('admin.location.')->group(function () {                 
    // Country Routes
    Route::get('/country', [App\Http\Controllers\Admin\Location\CountryController::class, 'index'])->name('country');
    Route::get('/country/create', [App\Http\Controllers\Admin\Location\CountryController::class, 'create'])->name('country.create');
    Route::post('/country/store', [App\Http\Controllers\Admin\Location\CountryController::class, 'store'])->name('country.store');
    Route::get('/country/edit/{country}', [App\Http\Controllers\Admin\Location\CountryController::class, 'edit'])->name('country.edit');
    Route::put('/country/update/{country}', [App\Http\Controllers\Admin\Location\CountryController::class, 'update'])->name('country.update');
    Route::delete('/country/destroy/{country}', [App\Http\Controllers\Admin\Location\CountryController::class, 'destroy'])->name('country.destroy');
    Route::post('/country/toggle-status/{country}', [App\Http\Controllers\Admin\Location\CountryController::class, 'toggleStatus'])->name('country.toggle-status');

    // State Routes
    Route::get('/state', [App\Http\Controllers\Admin\Location\StateController::class, 'index'])->name('state.index');
    Route::get('/state/create', [App\Http\Controllers\Admin\Location\StateController::class, 'create'])->name('state.create');
    Route::post('/state/store', [App\Http\Controllers\Admin\Location\StateController::class, 'store'])->name('state.store');
    Route::get('/state/edit/{state}', [App\Http\Controllers\Admin\Location\StateController::class, 'edit'])->name('state.edit');
    Route::put('/state/update/{state}', [App\Http\Controllers\Admin\Location\StateController::class, 'update'])->name('state.update');
    Route::delete('/state/destroy/{state}', [App\Http\Controllers\Admin\Location\StateController::class, 'destroy'])->name('state.destroy');
    Route::post('/state/toggle-status/{state}', [App\Http\Controllers\Admin\Location\StateController::class, 'toggleStatus'])->name('state.toggle-status');


    // City Routes
    Route::get('/city', [App\Http\Controllers\Admin\Location\CityController::class, 'index'])->name('city.index');
    Route::get('/city/create', [App\Http\Controllers\Admin\Location\CityController::class, 'create'])->name('city.create');
    Route::post('/city/store', [App\Http\Controllers\Admin\Location\CityController::class, 'store'])->name('city.store');
    Route::get('/city/edit/{city}', [App\Http\Controllers\Admin\Location\CityController::class, 'edit'])->name('city.edit');
    Route::put('/city/update/{city}', [App\Http\Controllers\Admin\Location\CityController::class, 'update'])->name('city.update');
    Route::delete('/city/destroy/{city}', [App\Http\Controllers\Admin\Location\CityController::class, 'destroy'])->name('city.destroy');
    Route::post('/city/toggle-status', [App\Http\Controllers\Admin\Location\CityController::class, 'toggleStatus'])->name('city.toggleStatus');

    // AJAX Routes
    Route::post('/get-states', [App\Http\Controllers\Admin\Location\StateController::class, 'getStatesByCountry'])->name('get-states');
});

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


<?php
use Illuminate\Support\Facades\Route;


//Route::get('admin/login', [LoginController::class,'showLoginPage']);
Route::middleware(['admin_guest'])->group(function(){

Route::get('/admin/login', [App\Http\Controllers\Admin\LoginController::class, 'showLoginPage'])
                            ->name('admin.login.page');

Route::post('/admin/login', [App\Http\Controllers\Admin\LoginController::class, 'login'])
                            ->name('admin.login');

Route::get('user/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('user.dashboard');


});


Route::middleware(['admin_auth'])->group(function(){

    Route::get('admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/logout', [App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin.logout');

    Route::get('admin/data', [App\Http\Controllers\Admin\PagesController::class, 'index'])->name('admin.data');

});



?>

<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\TopupController as AdminTopupController;
use App\Http\Controllers\Admin\LandingPageController;
use App\Http\Controllers\Admin\ProfitDistributionController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Vendor\ProjectController as VendorProjectController;
use App\Http\Controllers\Lender\LenderController;
use App\Http\Controllers\Lender\WalletController;
use App\Http\Controllers\Lender\InvestmentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/projects', [PublicController::class, 'projects'])->name('projects.index');
Route::get('/projects/{project:slug}', [PublicController::class, 'projectDetail'])->name('projects.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        return redirect()->route(auth()->user()->role . '.dashboard');
    })->name('dashboard');

    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('projects', AdminProjectController::class);
        Route::resource('users', AdminUserController::class);
        Route::get('topups', [AdminTopupController::class, 'index'])->name('topups.index');
        Route::post('topups/{topup}/approve', [AdminTopupController::class, 'approve'])->name('topups.approve');
        Route::post('topups/{topup}/reject', [AdminTopupController::class, 'reject'])->name('topups.reject');
        Route::get('landing-page', [LandingPageController::class, 'index'])->name('landing-page.index');
        Route::put('landing-page/{landingPageContent}', [LandingPageController::class, 'update'])->name('landing-page.update');
        Route::get('projects/{project}/investors', [AdminProjectController::class, 'investors'])->name('projects.investors');
        Route::get('profit-distributions', [ProfitDistributionController::class, 'index'])->name('profit-distributions.index');
        Route::post('profit-distributions', [ProfitDistributionController::class, 'store'])->name('profit-distributions.store');
    });

    Route::prefix('vendor')->name('vendor.')->middleware('role:vendor')->group(function () {
        Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
        Route::resource('projects', VendorProjectController::class);
        Route::post('projects/{project}/submit', [VendorProjectController::class, 'submit'])->name('projects.submit');
    });

    Route::prefix('lender')->name('lender.')->middleware('role:lender')->group(function () {
        Route::get('/dashboard', [LenderController::class, 'dashboard'])->name('dashboard');
        Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
        Route::post('/wallet/topup', [WalletController::class, 'requestTopup'])->name('wallet.topup');
        Route::get('/investments', [InvestmentController::class, 'index'])->name('investments.index');
        Route::get('/investments/{investment}', [InvestmentController::class, 'show'])->name('investments.show');
        Route::post('/projects/{project}/invest', [InvestmentController::class, 'invest'])->name('investments.create');
    });
});

require __DIR__.'/auth.php';

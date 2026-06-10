<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/packages', function (\App\Repositories\Interfaces\PackageRepositoryInterface $packageRepository) {
    return view('packages', ['packages' => $packageRepository->getAllPackages(true)]);
})->name('packages');

Route::get('/business-plan', function () {
    $settings = \App\Models\Setting::whereIn('key', [
        'direct_commission_percent',
        'daily_investment_percent',
        'level_1_percent',
        'level_2_percent',
        'level_3_percent',
        'level_4_percent',
        'level_5_percent'
    ])->pluck('value', 'key')->toArray();

    return view('business-plan', compact('settings'));
})->name('business-plan');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// API Endpoints that require session state (for frontend JS fetch calls)
Route::prefix('api')->group(function () {
    Route::post('/users', [\App\Http\Controllers\Api\UserController::class, 'store']);
    Route::post('/verify-otp', [\App\Http\Controllers\Api\UserController::class, 'verifyOtp']);
    Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->name('logout');
    Route::post('/forgot-password', [\App\Http\Controllers\Api\AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [\App\Http\Controllers\Api\AuthController::class, 'resetPassword']);
});

// Authentication Routes (Frontend Only)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');

Route::get('/verify-email', function () {
    return view('auth.verify-email');
})->name('verification.notice');

// User Profile Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        $user = \Illuminate\Support\Facades\Auth::user();
        $user->load([
            'kyc', 
            'wallet', 
            'purchases.package',
            'walletTransactions' => function($query) { $query->latest()->limit(10); },
            'nestedChildren'
        ]);
        return view('user.profile', ['user' => $user]);
    })->name('profile');

    Route::get('/change-password', function () {
        return view('user.change-password');
    })->name('password.change');

    // Stripe return URLs
    Route::get('/payment/success', [\App\Http\Controllers\StripeController::class, 'success'])->name('stripe.success');
    Route::get('/payment/cancel', [\App\Http\Controllers\StripeController::class, 'cancel'])->name('stripe.cancel');

    // User API endpoints
    Route::prefix('api')->group(function () {
        Route::post('/profile/update', [\App\Http\Controllers\Api\ProfileController::class, 'update']);
        Route::post('/packages/checkout', [\App\Http\Controllers\Api\PurchaseController::class, 'checkout']);
        
        Route::prefix('wallet')->group(function () {
            Route::get('/balance', [\App\Http\Controllers\Api\WalletController::class, 'balance']);
            Route::get('/transactions', [\App\Http\Controllers\Api\WalletController::class, 'transactions']);
            Route::post('/withdraw', [\App\Http\Controllers\Api\WalletController::class, 'withdraw']);
        });
    });
});

// Admin Routes
Route::prefix('admin')->group(function () {
    // Admin API endpoints requiring session
    Route::prefix('api')->group(function () {
        Route::post('/login', [\App\Http\Controllers\Api\AdminAuthController::class, 'login']);
        Route::apiResource('packages', \App\Http\Controllers\Admin\Api\PackageController::class);
    });

    // Admin Guest Routes
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', function () {
            return view('admin.auth.login');
        })->name('admin.login');
    });

    // Admin Protected Routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

        // User Management
        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.users.show');
        Route::post('/users/{user}/status', [\App\Http\Controllers\Admin\UserController::class, 'updateStatus'])->name('admin.users.status');
        Route::post('/users/{user}/kyc-status', [\App\Http\Controllers\Admin\UserController::class, 'updateKycStatus'])->name('admin.users.kyc.status');

        // Inquiry Management
        Route::get('/inquiries', [\App\Http\Controllers\Admin\InquiryController::class, 'index'])->name('admin.inquiries.index');
        Route::get('/inquiries/{inquiry}', [\App\Http\Controllers\Admin\InquiryController::class, 'show'])->name('admin.inquiries.show');

        // Packages Management
        Route::resource('packages', \App\Http\Controllers\Admin\PackageController::class)->names('admin.packages');

        // Settings Management
        Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.settings.index');
        Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.settings.update');

        // Income Plan Management
        Route::get('/income-plan', [\App\Http\Controllers\Admin\IncomePlanController::class, 'index'])->name('admin.income-plan.index');
        Route::post('/income-plan', [\App\Http\Controllers\Admin\IncomePlanController::class, 'update'])->name('admin.income-plan.update');

        // Wallet Management
        Route::get('/wallets/system', [\App\Http\Controllers\Admin\WalletController::class, 'systemWallet'])->name('admin.wallets.system');
        Route::get('/wallets/users', [\App\Http\Controllers\Admin\WalletController::class, 'userWallets'])->name('admin.wallets.users');
        Route::get('/wallets/users/{user}', [\App\Http\Controllers\Admin\WalletController::class, 'userWalletDetail'])->name('admin.wallets.user-detail');
        Route::get('/wallets/withdrawals', [\App\Http\Controllers\Admin\WalletController::class, 'withdrawals'])->name('admin.wallets.withdrawals');
        Route::post('/wallets/withdrawals/{transaction}/approve', [\App\Http\Controllers\Admin\WalletController::class, 'approveWithdrawal'])->name('admin.wallets.withdrawals.approve');
        Route::post('/wallets/withdrawals/{transaction}/reject', [\App\Http\Controllers\Admin\WalletController::class, 'rejectWithdrawal'])->name('admin.wallets.withdrawals.reject');

        Route::post('/logout', [\App\Http\Controllers\Api\AdminAuthController::class, 'logout'])->name('admin.logout');
    });
});

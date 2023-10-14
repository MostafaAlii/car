<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{Company,Employee,Agent,Admin};
// Admins ::
Route::middleware('guest:admin')->prefix('admin')->group(function () {
    Route::get('login', [Admin\AdminAuthenticatedSessionController::class, 'create'])->name('admin.login');
    Route::post('login', [Admin\AdminAuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::post('logout', [Admin\AdminAuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
});

// Employee ::
Route::middleware('guest:employee')->prefix('employee')->group(function () {
    Route::get('login', [Employee\EmployeeAuthenticatedSessionController::class, 'create'])->name('employee.login');
    Route::post('login', [Employee\EmployeeAuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:employee')->prefix('employee')->group(function () {
    Route::post('logout', [Employee\EmployeeAuthenticatedSessionController::class, 'destroy'])->name('employee.logout');
});

// Company ::
Route::middleware('guest:company')->prefix('company')->group(function () {
    Route::get('login', [Company\CompanyAuthenticatedSessionController::class, 'create'])->name('company.login');
    Route::post('login', [Company\CompanyAuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:company')->prefix('company')->group(function () {
    Route::post('logout', [Company\CompanyAuthenticatedSessionController::class, 'destroy'])->name('company.logout');
});

// Agents ::
Route::middleware('guest:agent')->prefix('agent')->group(function () {
    Route::get('login', [Agent\AgentAuthenticatedSessionController::class, 'create'])->name('agent.login');
    Route::post('login', [Agent\AgentAuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:agent')->prefix('agent')->group(function () {
    Route::post('logout', [Agent\AgentAuthenticatedSessionController::class, 'destroy'])->name('agent.logout');
});

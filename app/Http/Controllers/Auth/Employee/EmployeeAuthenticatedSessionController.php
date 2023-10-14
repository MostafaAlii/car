<?php

namespace App\Http\Controllers\Auth\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Employee\EmployeeLoginRequest;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
class EmployeeAuthenticatedSessionController extends Controller {
    public function create(): View {
        return view('auth.employee.login');
    }

    public function store(EmployeeLoginRequest $request): RedirectResponse {
        $request->authenticate($request);
        $request->session()->regenerate();
        return redirect()->route('employee.dashboard');
    }

    public function destroy(Request $request): RedirectResponse {
        Auth::guard('employee')->logout();
        $request->session()->forget('guard.employee');
        $request->session()->regenerateToken();
        return redirect()->route('employee.login');
    }
}
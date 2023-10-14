<?php

namespace App\Http\Controllers\Auth\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Company\CompanyLoginRequest;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
class CompanyAuthenticatedSessionController  extends Controller{
    public function create(): View {
        return view('auth.company.login');
    }

    public function store(CompanyLoginRequest $request): RedirectResponse {
        $request->authenticate($request);
        $request->session()->regenerate();
        return redirect()->route('company.dashboard');
    }

    public function destroy(Request $request): RedirectResponse {
        Auth::guard('company')->logout();
        $request->session()->forget('guard.company');
        $request->session()->regenerateToken();
        return redirect()->route('company.login');
    }
}
<?php
namespace App\Http\Controllers\Auth\Agent;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\{RedirectResponse, Request};
use App\Http\Requests\Auth\Agent\AgentLoginRequest;
class AgentAuthenticatedSessionController extends Controller {
    public function create(): View {
        return view('auth.agent.login');
    }

    public function store(AgentLoginRequest $request): RedirectResponse {
        $request->authenticate($request);
        $request->session()->regenerate();
        return redirect()->route('agent.dashboard');
    }

    public function destroy(Request $request): RedirectResponse {
        Auth::guard('agent')->logout();
        $request->session()->forget('guard.agent');
        $request->session()->regenerateToken();
        return redirect()->route('agent.login');
    }
}

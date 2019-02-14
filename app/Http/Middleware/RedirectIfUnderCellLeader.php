<?php

namespace App\Http\Middleware;

use App\Enums\AdministrativeStatus;
use App\Enums\SpiritualStatus;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfUnderCellLeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // We don't allow member who has the spiritual status under SpiritualStatusEnum::CELL_LEADER access the system.
        if (in_array(Auth::user()->spiritual_status, [
            SpiritualStatus::NEW_COMER,
            SpiritualStatus::NEW_BELIEVER,
            SpiritualStatus::REGULAR_BELIEVER,
            SpiritualStatus::CHURCH_MEMBER,
            SpiritualStatus::SHEPHERD
        ])) {
            Auth::logout();

            return redirect('/login')->with('error', "You're not allowed to access the system.");
        }

        return $next($request);
    }
}

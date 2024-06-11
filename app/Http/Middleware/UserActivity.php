<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            $expiresAt = Carbon::now()->addMinutes(10); // 10분 동안 접속 중으로 표시

            // 캐시에 접속 상태 설정
            Cache::put('user-is-online-' . $user->id, true, $expiresAt);

            // DB 업데이트
            DB::table('users')->where('id', $user->id)->update([
                'last_activity_date' => Carbon::now(),
            ]);
        }

        return $next($request);
    }
}

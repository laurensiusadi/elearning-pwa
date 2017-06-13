<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Enrollment;

class EnrollmentCheck
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
        $enrollmentId = $request->route('id');
        $enrollment = Enrollment::find($enrollmentId);
        if($enrollment->user_id !== Auth::id()) {
            return redirect('home')->with('error', 'User not enrolled on classroom');
        }
        else {
            return $next($request);
        }
    }
}

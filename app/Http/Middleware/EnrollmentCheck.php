<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Classroom;

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
        $classroomId = $request->route('id');
        $classroom = Classroom::with('users')->where('id', $classroomId)->first();
        if(!$classroom->users()->wherePivot('user_id', Auth::user()->id)->exists()) {
            return redirect('home')->with('error', 'User not enrolled on classroom');
        }
        else {
            return $next($request);
        }
    }
}

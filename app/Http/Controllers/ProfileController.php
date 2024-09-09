<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index()
    {
        // if (! Auth::check()) {
        //     return Redirect::route('login')->with('fail', 'Please, login first.');
        // }

        $profile   = User::findOrFail(session('loginId'));
        
        return view('profile.index', compact('profile'));
    }


    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {  
        User::findOrFail(session('loginId'))->update([
            'password' => bcrypt($request->newPassword),
        ]);
        
        $profile   = User::findOrFail(session('loginId'));

        return redirect()->back()->with('success', 'Password has been updated successfully.');
    }

    
}

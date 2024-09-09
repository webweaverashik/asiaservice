<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthenticateController extends Controller
{
    ////Login
    public function login()
    {
        return view('auth.login');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email:users',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        // return $user;

        
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                // storing logged in user data into session variables
                $request->session()->put('loginId', $user->id);
                $request->session()->put('name', $user->name);
                
                // Activity Log recording
                ActivityLog::create([
                    'user_name' =>  $request->email,
                    'status'    =>  'Success',
                    'login_IP'  =>  request()->ip(),
                ]);
                
                return redirect('dashboard')->with('success', 'Logged in Successfully');
            } else {
                
                // Activity Log recording
                ActivityLog::create([
                    'user_name' =>  $request->email,
                    'status'    =>  'Failed',
                    'login_IP'  =>  request()->ip(),
                ]);

                return back()->with('fail', 'Invalid password');
            }
        } else {
            // Activity Log recording
            ActivityLog::create([
                'user_name' =>  $request->email,
                'status'    =>  'Failed',
                'login_IP'  =>  request()->ip(),
            ]);
            
            return back()->with('fail', 'Email Not Registered');
        }
    }

    // Dashboard
    public function dashboard()
    {
        return view('index');
    }

    ///Logout
    public function logout()
    {
        $data = [];
        if (Session::has('loginId')) {
            Session::pull('loginId');

            return redirect('login')->with('success', 'Logged out successfully');
        } else {
            return redirect('login');
        }
    }
}

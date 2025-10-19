<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Session;

class AdminController extends Controller
{
    protected $guarded = [];
    public function view()
    {
        return view('admin.pages.index');
    }

    public function signup()
    {
        return view('admin.pages.signup');
    }

    public function signin()
    {
        return view('admin.pages.login');
    }

    public function store()
    {
        $data = request()->validate([
            'name'=>'required',
            'email'=>'required|unique:admin',
            'password'=>['required']
        ]);
        $hashedPassword = Hash::make(request()->password);
        $data = array_merge(
            $data,
            ['password'=>$hashedPassword]
        );
        Admin::create($data);
        $admin = Admin::where('email','=',$data['email'])->first();
        request()->session()->put('loginId',$admin->id);
        request()->session()->put('adminName',$admin->name);
        return redirect('/admin/dashboard')
                ->with('alert-type','success')
                ->with('message','Admin Added Succesfully');
    }

    public function check()
    {
        $data = request()->validate([
            'email'=>'required',
            'password'=>'required',  
        ]);
        $admin = Admin::where('email','=',$data['email'])->first();
        if($admin)
        {
            if(Hash::check($data['password'], $admin['password']))
            {
                request()->session()->put('loginId',$admin->id);
                request()->session()->put('adminName',$admin->name);
                return redirect('/admin/dashboard')
                        ->with('alert-type','success')
                        ->with('message','Login Successfully');
            }
            else
            {
                return redirect('/admin')
                        ->with('alert-type','error')
                        ->with('message','Password is Wrong');
            }
        }
        else
        {
            return redirect('/admin')
                    ->with('alert-type','error')
                    ->with('message','E-mail is not Registered');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/')
              ->with('alert-type','error')
              ->with('message','Logout Successfully');
    }

    // Admin Profile Settings
    public function settings()
    {
        $admin = Admin::find(Session::get('loginId'));
        return view('admin.pages.settings.edit', compact('admin'));
    }

    public function updateSettings(Request $request)
    {
        $admin = Admin::find(Session::get('loginId'));

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admin,email,' . $admin->id,
            'password' => 'nullable|min:6',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $admin->update($data);
        $request->session()->put('adminName', $data['name']);

        return redirect('/admin/settings')
            ->with('alert-type', 'success')
            ->with('message', 'Profile updated successfully');
    }

    // Admin Forgot Password (simple reset)
    public function showForgotPassword()
    {
        return view('admin.pages.password.forgot');
    }

    public function resetPassword(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $admin = Admin::where('email', $data['email'])->first();
        if (!$admin) {
            return back()->with('alert-type', 'error')->with('message', 'Email is not registered');
        }

        $admin->update(['password' => Hash::make($data['password'])]);

        return redirect('/admin')
            ->with('alert-type', 'success')
            ->with('message', 'Password reset successfully. Please sign in.');
    }
}

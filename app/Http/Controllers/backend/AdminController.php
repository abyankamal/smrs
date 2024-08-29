<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function AdminLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $userdata = User::findOrFail($id);
        return view('admin.admin_profile', compact('userdata'));
    }

    public function AdminProfileUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $admin = User::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->photo = $request->photo;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $imageName = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/admin_profile'), $imageName);
            $admin['photo'] = $imageName;
        }
        $admin->save();
        return redirect()->back();
    }
}

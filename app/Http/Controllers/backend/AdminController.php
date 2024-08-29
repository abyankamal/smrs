<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $notification = array(
            'message' => 'Admin profile updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword()
    {
        return view('admin.admin_change-password');
    }

    public function AdminChangePasswordUpdate(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        // Check if the old password matches the current password
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            $notification = [
                'message' => 'Old password doesn\'t match',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }

        // Update the user's password
        User::whereId(Auth::user()->id)->update(['password' => Hash::make($request->new_password)]);

        // Return success notification
        $notification = [
            'message' => 'Admin password updated successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}

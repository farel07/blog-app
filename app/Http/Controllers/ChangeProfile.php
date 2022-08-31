<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChangeProfile extends Controller
{
    public function change_profile(Request $request)
    {


        if (!$request->file('profile')) {
            // jika user remove profile
            if ($request->remove_profile == 1) {
                // hapus foto profil user
                Storage::delete(auth()->user()->profile);

                User::where('id', auth()->user()->id)->update(['profile' => null]);

                return redirect('dashboard')->with('success', 'Profile photo successfully deleted <span data-feather="check" class="align-text-bottom"></span>');
            } else {

                return redirect('dashboard')->with('error', 'Profile photo not changed <span data-feather="x" class="align-text-bottom"></span>');
            }
        }

        $validatedData = $request->validate([
            'profile' => 'image|file|max:2048'
        ]);

        $validatedData['profile'] = $request->file('profile')->store('profile');

        if (auth()->user()->profile != 'profile/profile.png') {
            Storage::delete(auth()->user()->profile);
        }

        User::where('id', auth()->user()->id)->update($validatedData);

        return response()->json([
            'status' => 1,
            'msg' => 'Profile picture has been changed!',
            'session' => $request->session()->flash('success', 'Profile successfully changed!<span data-feather="check" class="align-text-bottom"></span>')
        ]);

        // return redirect('dashboard')->with('success', 'Profile photo successfully changed <span data-feather="check" class="align-text-bottom"></span>');
    }

    public function edit_info(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];

        if (auth()->user()->username != $request->username) {
            $rules['username'] = 'required|unique:users';
        }
        if (auth()->user()->email != $request->email) {
            $rules['email'] = 'required|unique:users|email:dns';
        }

        $validatedData = $request->validate($rules);

        User::where('id', auth()->user()->id)->update($validatedData);
        return redirect('/dashboard')->with('success', 'Profile info successfully updated <span data-feather="check" class="align-text-bottom"></span>');
    }
}

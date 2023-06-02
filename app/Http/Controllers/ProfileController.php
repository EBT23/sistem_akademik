<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function profile()
    {
        $data['title'] = 'My Profile';
        

        return view('profile.profile', $data);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id(),
        ]);
    
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        
        

        return redirect()
        ->route('profile')
        ->with('success', 'Profil berhasil diperbarui');
    }

}

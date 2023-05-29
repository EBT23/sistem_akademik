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
}

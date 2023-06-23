<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;

class ApiAdminController extends Controller
{
    public function information()
    {
        $information = Information::all();

        return response()->json([
            'information' => $information
        ]);
    }
}

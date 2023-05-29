<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function schedule()
    {
        $data['title'] = 'Kelola Jadwal';

        return view('admin.schedule', $data);
    }
}

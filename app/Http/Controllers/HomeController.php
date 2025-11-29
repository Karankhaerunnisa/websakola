<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Major;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $isOpen = (bool) Setting::getValue('is_registration_open', false);

        $announcements = Announcement::active()->latest()->take(3)->get();

        $majors = Major::withCount('registrants')->get();

        return view('welcome', compact('isOpen', 'announcements', 'majors'));
    }

    public function showAnnouncement(Announcement $announcement)
    {
        if (! $announcement->is_active) {
            abort(404);
        }

        return view('announcement-show', compact('announcement'));
    }
}

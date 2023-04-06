<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReadAllNotificationController extends Controller
{
    public function __invoke()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()-back();
    }
}

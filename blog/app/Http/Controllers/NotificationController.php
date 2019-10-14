<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function __construct()
    {
        $this.middleware('auth');
    }
    public function index()
    {
        return auth()->user()->notifications()->unreadNotifications();
    }

    public function destroy(User $user, $notificationId)
    {
        return auth()->user()->notifications()->findOrFail($notificationId)->markAsRead();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\Notification;

class NotificationController extends Controller
{
    protected $notification;

    public function __construct(Notification $notification) {
        $this->notification = $notification;
    }

    public function newNotifications(Request $request) {
        return json_encode($this->notification->getNewNotifications());
    }
}

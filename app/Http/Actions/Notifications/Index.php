<?php

namespace App\Http\Actions\Notifications;

class Index
{
    public function execute()
    {
        return view('layouts.Notifications.notifications');
    }
}

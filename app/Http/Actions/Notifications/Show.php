<?php

namespace App\Http\Actions\Notifications;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Show
{
    public function execute(int $id)
    {
        $notifications = DB::table('notifications')->orderBy('created_at', 'DESC')->where('notifiable_id', $id)->get();

        return response()->json($notifications, 200);
    }
}
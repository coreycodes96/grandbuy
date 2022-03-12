<?php

namespace App\Http\Actions\Notifications;

use Illuminate\Support\Facades\DB;

class GetNotification
{
    public function execute(string $id)
    {
        $notification = DB::table('notifications')->where('id', $id)->first();

        return response()->json($notification);
    }
}
<?php

namespace App\Http\Actions\Notifications;
use Illuminate\Support\Facades\DB;

class Delete
{
    public function execute(string $id)
    {
        DB::table('notifications')->where('id', $id)->delete();

        return response()->json('Notification has been deleted', 204);
    }
}
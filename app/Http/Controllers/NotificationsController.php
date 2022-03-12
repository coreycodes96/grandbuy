<?php

namespace App\Http\Controllers;

use App\Http\Actions\Notifications\Index;
use App\Http\Actions\Notifications\Show;
use App\Http\Actions\Notifications\GetNotification;
use App\Http\Actions\Notifications\Delete;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'user']);
    }

    public function index(Index $action)
    {
        return $action->execute();
    }

    public function show(int $id, Show $action)
    {
        return $action->execute($id);
    }

    public function getNotification(string $id, GetNotification $action)
    {
        return $action->execute($id);
    }

    protected function delete(string $id, Delete $action)
    {
        return $action->execute($id);
    }
}

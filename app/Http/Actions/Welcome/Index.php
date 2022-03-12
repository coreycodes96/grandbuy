<?php

namespace App\Http\Actions\Welcome;

class Index
{
    public function execute()
    {
        return view('welcome');
    }
}

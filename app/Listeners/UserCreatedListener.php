<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UserCreatedListener implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public function handle(UserCreated $event)
    {
    }
}

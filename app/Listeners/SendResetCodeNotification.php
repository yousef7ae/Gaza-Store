<?php

namespace App\Listeners;

use App\Events\ResetCode;
use App\Notifications\FrogetPasswordNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class SendResetCodeNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ResetCode $event)
    {
            // Log::info('Listener triggered'); // إضافة سجل في ملف اللوج

        
        $user = $event->user;

        $user->notify(new FrogetPasswordNotification());

        //
    }
}

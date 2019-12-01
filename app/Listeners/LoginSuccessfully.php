<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class LoginSuccessfully
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
     * @param Login $event
     * @return void
     */
    public function handle(Login $event)
    {
        DB::table('auth_activities')->insert([
                'subject' => 'login',
                'url' => Request::fullUrl(),
                'method' => Request::method(),
                'ip' => Request::ip(),
                'agent' => Request::header('user-agent'),
                'user_id' => $event->user->id,
                'guard' => $event->guard]
        );
    }
}

<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\user;
use Cache;

class UserEventSubscriber
{
    protected $user;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

//    /**
//     * Handle the event.
//     *
//     * @param  Login  $event
//     * @return void
//     */
//    public function handle(Login $event)
//    {
//        $event->user->last_login_at = Carbon::now();
//        $event->user->save();
//    }
    /**
     * Handle user login events.
     */
    public function onUserLogin($event) {
        $event->user->last_login_at = Carbon::now();
        $event->user->save();
    }

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event) {
        //clear the cache memory for storing user status
        Cache::forget('userOnline_' . $event->user->id);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@onUserLogout'
        );
    }

}

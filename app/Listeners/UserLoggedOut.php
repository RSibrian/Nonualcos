<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\BitacoraUsuario;

class UserLoggedOut
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        //
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        //
        $log = BitacoraUsuario::where('user_id', $event->user->id)
                  ->latest('horaInicio')
                  ->first();

        if($log) {
            $log->horaFinal = date('Y-m-d H:i:s');
            $log->save();
        }
    }
}

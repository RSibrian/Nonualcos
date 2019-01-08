<?php

namespace App\Listeners;

use App\Events\Event;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\BitacoraUsuario;

class LogSuccessfulLogin
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
     * @param  Event  $event
     * @return void
     */
    public function handle(Event $event)
    {
        //
         $user = $event->user;
         $bitacoraUsuario = new BitacoraUsuario;
         $bitacoraUsuario->fecha = date('Y-m-d H:i:s');
         $bitacoraUsuario->horaInicio = date('Y-m-d H:i:s');
         $bitacoraUsuario->horaFinal = date('Y-m-d H:i:s');
         $bitacoraUsuario->user_id = $user->id;
         $bitacoraUsuario->save();
    }
}

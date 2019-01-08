<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
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
     * @param  Login  $event
     * @return void
     */
     public function handle(Login $event)
     {
         $user = $event->user;
         //$user->last_login_at = date('Y-m-d H:i:s');
         //$user->last_login_ip = $this->request->ip();
         //$user->save();
         $bitacoraUsuario = new BitacoraUsuario;
         $bitacoraUsuario->fecha = date('Y-m-d H:i:s');
         $bitacoraUsuario->horaInicio = date('Y-m-d H:i:s');
         //$bitacoraUsuario->horaFinal = date('Y-m-d H:i:s');
         $bitacoraUsuario->user_id = $user->id;
         $bitacoraUsuario->save();
     }
}

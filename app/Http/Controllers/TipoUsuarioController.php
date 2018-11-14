<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoUsuario;
use App\user;
use Illuminate\Support\Facades\Validator;
class TipoUsuarioController extends Controller
{
    //
    public function create()
    {
        return view('usuario.create');
    }
    public function index()
    {
        $user=User::All();
        return view('usuario.index',compact('user'));

    }
    public function store(Request $data)
    {
        $user=User::All();
        return view('usuario.index',compact('user'));

    }
    public function edit($id)
    {
     $user=User::findOrFail($id);
      return view('usuario.edit',compact('user'));
      
    }
     public function show($id)
    {
        $user=User::find($id);
      return view('usuario.edit',compact('user'));
    }


     

}

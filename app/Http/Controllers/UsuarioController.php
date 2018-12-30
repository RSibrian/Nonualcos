<?php

namespace App\Http\Controllers;
use App\Empleado;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Foundation\Validation;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Hash;
class UsuarioController extends Controller
{
    //
    public function create()
    {
        $empleados=Empleado::pluck('nombresEmpleado','id');
        return view('usuario.create',compact('empleados'));
    }
    public function index()
    {
        $user=User::All();
        return view('usuario.index',compact('user'));

    }
    public function store(UserRequest $request)
    {
        $this->validate($request, [
            'password' => 'required|string|min:6',
        ],
            [
                'password.required' => '¡Por favor ingrese la contraseña del usuario!',
                'password.min' => '¡Contraseña muy corta. un minimo de 6 letras!',
            ]
        );
        $request['password']=bcrypt($request['password']);
        User::create($request->all());
        return redirect("/users")->with('create','Se ha creado con éxito el registro de usuario');


    }
    public function edit($id)
    {
        $raw= DB::raw("CONCAT (nombresEmpleado, ' ', apellidosEmpleado) as fullName");
        $empleados=Empleado::select($raw,'id')->pluck('fullName','id');

        $user=User::findOrFail($id);
        return view('usuario.edit',compact('user','empleados'));

    }
    public function show($id)
    {
        $user=User::findOrFail($id);
        return view('usuario.show',compact('user'));
    }

    public function update(UserRequest $request, $id)
    {
           $user = User::findOrFail($id);
           $user->name = $request['name'];
           $user->email = $request['email'];
           if($request['password']!=null) {
               $user->password = bcrypt($request['password']);
           }
           $user->idEmpleado=$request['idEmpleado'];
           $user->save();
           return redirect("/users/{$id}")->with('update', 'Se ha editado correctamente el registro de usuario');
    }
    public function password(){
        return View('usuario.password');
    }
    public function updatePassword(Request $request){
        $rules = [
            'mypassword' => 'required',
            'password' => 'required|confirmed|min:6|max:18',
        ];

        $messages = [
            'mypassword.required' => 'El campo es requerido',
            'password.required' => 'El campo es requerido',
            'password.confirmed' => 'Los passwords no coinciden',
            'password.min' => 'El mínimo permitido son 6 caracteres',
            'password.max' => 'El máximo permitido son 18 caracteres',
        ];
         $this->validate($request, $rules, $messages);
         if (Hash::check($request->mypassword, Auth::user()->password)){
             $user = new User;
             $user->where('email', '=', Auth::user()->email)
                 ->update(['password' => bcrypt($request->password)]);
             return redirect('users/'.Auth::user()->id)->with('update', 'La contraseña se modificó con éxito');
         }
         else {
             return redirect('users/password')->with('sin_pass', 'Contraseña Incorrecta');
            }
    }
    public function asignarRole($id)
    {
        $user=User::findOrFail($id);
        $roles=Role::all();

        return view('usuario.asignar_role',compact('user','roles'));

    }
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->roles()->sync($request->get('roles'));
        return redirect("/users/{$id}")->with('update', 'Se ha editado correctamente el registro');
    }
    public function reporte()
        {
          $users=User::All();
          $date = date('d-m-Y');
          $date1 = date('g:i:s a');
          $vistaurl="usuario.reporte";
          $view =  \View::make($vistaurl, compact('users', 'date','date1'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
            $pdf->setPaper('letter', 'portrait');
          return $pdf->stream('Reporte de Usuarios '.$date.'.pdf');
        }
}

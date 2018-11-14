<?php

namespace App\Http\Controllers;
use App\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
  public function index()
  {
      $prov=Proveedor::All();
      return view('proveedores.index',compact('prov'));

  }
  public function create()
  {
      return view('proveedores.create');
  }

  public function store(Request $request)
  {

      Proveedor::create([
          'nombreEmpresa'  =>$request['nombreEmpresa'],
          'nombreEncargado' =>$request['nombreEncargado'],
            'telefonoProve' =>$request['telefonoProve'],
              'email' =>$request['email'],

      ]);
      return redirect("/proveedores")->with('create','Sea creado con éxito el registro');
  }
  public function edit($id)
  {
      $prov=Proveedor::findOrFail($id);
      return view('proveedores.edit',compact('prov'));

  }
  public function show($id)
  {
      $prov=Proveedor::findOrFail($id);
      return view('proveedores.show',compact('prov'));
  }

  public function update(Request $request, $id)
  {
         $prov = Proveedor::findOrFail($id);
         $prov->nombreEmpresa = $request['nombreEmpresa'];
         $prov->nombreEncargado = $request['nombreEncargado'];
         $prov->email = $request['email'];
         $prov->telefonoProve = $request['telefonoProve'];

         $prov->save();
         return redirect("/proveedores")->with('update', 'Sea editado con éxito el registro');
  }

}

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
              'tipoProveedor'=>$request['tipoProveedor'],

      ]);
      return redirect("/proveedores")->with('create','Se ha creado con éxito el registro de proveedor');
  }
  public function storeAjax(Request $request)
  {
    if($request->ajax()){
    Proveedor::create($request->all());
    $proveedores=Proveedor::all();
    return response()->json($proveedores);
  }

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
         $prov->tipoProveedor=$request['tipoProveedor'];

         $prov->save();
         return redirect("/proveedores")->with('update', 'Se ha editado correctamente el registro de proveedor');
  }

}

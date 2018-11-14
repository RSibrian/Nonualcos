<?php

namespace App\Http\Controllers;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    //
    public function create()
    {
        $permissions=Permission::all();

        return view('roles.create',compact('permissions'));
    }
    public function index()
    {
        $roles=Role::All();
        return view('roles.index',compact('roles'));

    }
    public function store(Request $request)
    {
        $role= Role::create([
            'name'  =>$request['name'],
            'slug'  =>$request['slug'],
            'description'  =>$request['description'],
        ]);
        $role->permissions()->sync($request->get('permissions'));
        return redirect("/roles")->with('create','Sea creado con éxito el registro');


    }
    public function edit($id)
    {
        $role=Role::findOrFail($id);
        $permissions=Permission::all();

        return view('roles.edit',compact('role','permissions'));

    }
    public function show($id)
    {
        $role=Role::findOrFail($id);
        return view('roles.show',compact('role'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->all());
        $role->permissions()->sync($request->get('permissions'));
        return redirect("/roles/{$id}/edit")->with('update', 'Sea editado con éxito el registro');
    }



}

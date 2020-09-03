<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function index()
    {
    return view('admin.roles.index',
    ['roles'=>Role::all()]
);
    }

    public function store()
    {
        request()->validate([
'name'=>['required']

        ]);
        Role::create([
'name'=>Str::ucfirst(request('name')),
'slug'=>Str::of(Str::lower(request('name')))->slug('-'),


        ]);
      // return dd(request('name'));
    //return view('admin.roles.index');
    return back();
    }
    public function destroy(Role $role)
    {
        $role->delete();
        Session()->flash('role_delete', $role->name .'is deleted');
        return back();
    }
    public function edit(Role $role)
    {
        return view('admin.roles.edit',[
            'role'=>$role,
            'permissions'=>Permission::all()

            ]);
    }
    public function update(Role $role)
    {
        $role->name=Str::ucfirst(request('name'));
        $role->slug=Str::of(request('name'))->slug('-');

        if($role->isDirty('name'))
        {
            Session()->flash('role_up', $role->name .'is updated');
            $role->save();

        }else
        {
            Session()->flash('role_up', 'there is nothing to update');

        }

        return back();
    }

    public function attach_permission(Role $role)
    {
        $role->permission()->attach(request('permission'));
        return back();
    }
    public function detach_permission(Role $role)
    {
        $role->permission()->detach(request('permission'));
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index()
    {
    return view('admin.permissions.index',[
    'permissions'=>Permission::all()
    ]);
    }
    public function store()
    {
        request()->validate([
'name'=>['required']

        ]);
        Permission::create([
'name'=>Str::ucfirst(request('name')),
'slug'=>Str::of(Str::lower(request('name')))->slug('-'),


        ]);
      // return dd(request('name'));
    //return view('admin.roles.index');
    return back();
    }
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit',[

            'permission'=>$permission
        ]);
    }
    public function destroy(Permission $permission)
    {

        $permission->delete();
        return back();
    }
    public function update(Permission $permission)
    {
        $permission->name=Str::ucfirst(request('name'));
        $permission->slug=Str::of(request('name'))->slug('-');

        if($permission->isDirty('name'))
        {
            Session()->flash('permission_up', $permission->name .'is updated');
            $permission->save();

        }else
        {
            Session()->flash('permission_up', 'there is nothing to update');

        }

        return back();
    }

}

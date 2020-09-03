<?php
use Illuminate\Support\Facades\Route;
use App\User;

Route::put('admin/users/{user}/update', 'UserController@update')->name('user.profile.update');

Route::delete('admin/users/{user}/destroy', 'UserController@destroy')->name('user.destroy');
Route::middleware(['role:admin'])->group(function(){
    Route::get('admin/users', 'UserController@index')->name('users.index');
});
Route::get('admin/users/{user}/profile', 'UserController@show')->name('user.profile.show');

Route::put('users/{user}/attach','UserController@attach')->name('user.role.attach');
Route::put('users/{user}/detach','UserController@detach')->name('user.role.detach');


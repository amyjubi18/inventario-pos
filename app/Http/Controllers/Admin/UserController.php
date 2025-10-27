<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('read-users');
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-users');
        $roles = \Spatie\Permission\Models\Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create-users');
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,name'
            ]);

            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);
            $user->assignRole($data['role']);

            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Bien hecho!',
                'text' => 'El usuario se ha creado con exito'
            ]);

            return redirect()->route('admin.users.index', $user);

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        Gate::authorize('read-users');
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        Gate::authorize('update-users');
        $roles = \Spatie\Permission\Models\Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        Gate::authorize('update-users');
        $data= $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $user->id . '|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|exists:roles,name'
            ]);

        if(!empty($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }

        $user->update($data);
        $user->syncRoles([$data['role']]);
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'El usuario se ha actualizado con exito'
        ]);
        return redirect()->route('admin.users.index', $user);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('delete-users');
        $user->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'El usuario se ha eliminado con exito'
        ]);
        return redirect()->route('admin.users.index');

    }
}

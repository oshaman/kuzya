<?php

namespace App\Http\Controllers\Admin;


use App\User;
use Illuminate\http\Request;
use Validator;
use Illuminate\Validation\Rule;

class UsersController
{

    public function index()
    {
        $users = User::all();

        return view('admin.users.index')->with(compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required|string',
            'password' => 'required|string|min:6',
        ])->validate();

        User::add($data);

        return redirect()->route('users.index')->with(['flash_message' => trans('admins.user_created')]);

    }

    public function edit(User $user)
    {
        return view('admin.users.edit')->with(compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'password' => 'nullable|string|min:6',
            'name' => 'required|string',
        ])->validate();

        $user->edit($data);
        $user->generatePassword($data['password']);
        return redirect()->back()->with(['flash_message' => trans('admins.user_updated')]);
    }

    public function destroy(User $user)
    {
        $result = $user->remove();
        return redirect()->route('users.index')->with($result);
    }
}
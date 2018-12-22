<?php

namespace App\Http\Controllers\Admin;


use App\Models\Callback;
use Illuminate\Http\Request;

use Validator;

class CallbacksController
{

    public function index()
    {
        $callbacks = Callback::all();

        return view('admin.callbacks.index')->with(compact('callbacks'));
    }

    public function edit(Callback $callback)
    {
        return view('admin.callbacks.edit')->with(compact('callback'));
    }

    public function update(Request $request, Callback $callback)
    {
        $data = Validator::make($request->all(), [
            'email' => 'required|email',
            'copies' => 'nullable|string|max:1000',
        ])->validate();

        $callback->fill($data)->save();

        return redirect()->route('callbacks.index');
    }
}
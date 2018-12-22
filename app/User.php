<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function add($fields)
    {
        $user = new static;
        $user->fill($fields);
        $user->password = Hash::make($fields['password']);
        $user->save();

        return $user;
    }


    public function edit($fields)
    {
        $this->fill($fields);

        $this->save();
    }

    public function remove()
    {

        if(auth()->user()->id === $this->id){
            return ['flash_message' => trans('admins.self_delete')];
        }

        $this->delete();
        return ['flash_message' => trans('admins.user_deleted')];
    }

    public function generatePassword($password)
    {
        if($password != null)
        {
            $this->password = Hash::make($password);
            $this->save();
        }
    }
}

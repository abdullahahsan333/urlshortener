<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Http\Request;

class Admin extends Authenticatable
{
    use Notifiable, HasFactory, SoftDeletes;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    static function getAllUser(Request $request) {
        $where = [];
        if(!empty($request->status)) {
            $where['status'] = $request->status;
        }
        return Admin::where($where)->orderBy('id', 'DESC')->get();
    }

    static function getUser($id) {
        return Admin::find($id);
    }
}

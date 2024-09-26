<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->data['url'] = "admin";
        $this->data['activeMenu'] = 'users';
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->data['results'] = Admin::getAllUser($request);

        return view('admin.user.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            flash()->error('Please fill all required fields correctly.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(!Admin::where('email', $request->email)->exists()) {
            $data = new Admin;
            
            $data->name       = $request->name;
            $data->email      = $request->email;
            $data->mobile     = $request->mobile;
            $data->address    = $request->address;
            $data->password   = Hash::make($request->password);

            $avatar           = $request->file('avatar');
            if (!empty($avatar)) {
                $data->avatar  = uploadImage($avatar, 'uploads/users');
            }

            $data->save();

            flash()->success('Admin saved successfully.');
            return redirect()->route('admin.users');
        } else {
            flash()->warning('Admin already exists!');
            return redirect()->route('admin.user.create');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->data['info'] = Admin::getUser($id);

        return view('admin.user.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = Admin::find($request->id);
            
        $data->name       = $request->name;
        $data->mobile     = $request->mobile;
        $data->address    = $request->address;
        $data->status     = $request->status;

        $avatar = $request->file('avatar');
        if (!empty($avatar)) {
            if (file_exists($data->avatar)) unlink($data->avatar);
            $data->avatar = uploadImage($avatar, 'uploads/users');
        }

        $data->save();

        flash()->success('Admin Update successfully.');
        return redirect()->route('admin.users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Admin::find($id);

        $data->delete();

        flash()->success('Admin delete successful.', 'Delete');

        return redirect()->back();
    }
}

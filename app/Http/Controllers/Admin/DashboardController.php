<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->data['url'] = "admin";
        $this->data['activeMenu'] = 'dashboard';
    }

    public function index()
    {
        return view('admin.dashboard', $this->data);
    }

    public function profile()
    {
        $this->data['info'] = getAdminInfo();
        return view('admin.profile', $this->data);
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

}

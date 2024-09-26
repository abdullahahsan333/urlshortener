<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientDashboardController extends Controller
{
    public function __construct()
    {
        $this->data['url'] = "client";
        $this->data['activeMenu'] = 'dashboard';
    }

    public function index()
    {
        return view('client.dashboard', $this->data);
    }
    public function profile()
    {
        $this->data['info'] = getClientInfo();
        return view('client.profile', $this->data);
    }

        /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = Client::find($request->id);
            
        $data->name       = $request->name;
        $data->mobile     = $request->mobile;
        $data->address    = $request->address;
        $data->status     = $request->status;

        $avatar = $request->file('avatar');
        if (!empty($avatar)) {
            if (file_exists($data->avatar)) unlink($data->avatar);
            $data->avatar = uploadImage($avatar, 'uploads/clients');
        }

        $data->save();

        flash()->success('Client Update successfully.');
        return redirect()->route('admin.clients');
    }
    
}
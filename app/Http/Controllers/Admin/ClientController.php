<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->data['url'] = "admin";
        $this->data['activeMenu'] = 'clients';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->data['results'] = Client::getAllClient($request);

        return view('admin.client.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.client.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:clients'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            flash()->error('Please fill all required fields correctly.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(!Client::where('email', $request->email)->exists()) {
            $data = new Client;
            
            $data->name       = $request->name;
            $data->email      = $request->email;
            $data->mobile     = $request->mobile;
            $data->address    = $request->address;
            $data->password   = Hash::make($request->password);

            $avatar           = $request->file('avatar');
            if (!empty($avatar)) {
                $data->avatar  = uploadImage($avatar, 'uploads/clients');
            }

            $data->save();

            flash()->success('Client saved successfully.');
            return redirect()->route('admin.clients');
        } else {
            flash()->warning('Client already exists!');
            return redirect()->route('admin.client.create');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->data['info'] = Client::getClient($id);

        return view('admin.client.edit', $this->data);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Client::find($id);

        $data->delete();

        flash()->success('Client delete successful.', 'Delete');

        return redirect()->back();
    }
}

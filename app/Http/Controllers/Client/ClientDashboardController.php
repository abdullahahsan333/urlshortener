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
        return view('client.profile', $this->data);
    }
    
}
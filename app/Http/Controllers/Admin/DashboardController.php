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
        return view('admin.profile', $this->data);
    }

}

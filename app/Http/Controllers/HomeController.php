<?php
namespace App\Http\Controllers;

use App\Models\UrlShorter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        return view('home');
    }

    public function redirectUrl($short) {
        $data = UrlShorter::where('short_url', $short)->first();

        $hit = $data->hit + 1;

        UrlShorter::where('id', $data->id)->update(['hit' => $hit]);

        return redirect($data->main_url);
    }

}

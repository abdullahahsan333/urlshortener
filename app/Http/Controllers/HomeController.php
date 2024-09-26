<?php
namespace App\Http\Controllers;

use App\Models\UrlShorter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function redirectUrl($short) 
    {
        $data = UrlShorter::where('short_url', $short)->first();

        $hit = $data->hit + 1;

        UrlShorter::where('id', $data->id)->update(['hit' => $hit]);

        return redirect($data->main_url);
    }

    public function shortStore(Request $request) 
    {

        $validator = Validator::make($request->all(), [
            'main_url' => 'required|url',
        ]);

        if ($validator->fails()) {
            flash()->error('Please fill all required fields correctly.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $shortUrl = generateUniqueCode();

        if(!UrlShorter::where('short_url', $shortUrl)->exists()) {
            $data = new UrlShorter;
    
            $data->main_url     = $request->main_url;
            $data->short_url    = $shortUrl;

            $data->save();
        }

        flash()->success('Your Long Url Shortener successfully.');
        return redirect()->route('home')->with('myUrl', $data);
    }

}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\UrlShorter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UrlShortenerController extends Controller
{
    public function __construct()
    {
        $this->data['url'] = "client";
        $this->data['activeMenu'] = 'shortener';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->data['results'] = UrlShorter::getAllUrlForClient(getClientInfo()->id);

        return view('client.shortener.index', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
    
            $data->client_id    = getClientInfo()->id;
            $data->main_url     = $request->main_url;
            $data->short_url    = $shortUrl;

            $data->save();
        }

        flash()->success('Your Long Url Shortener successfully.');
        return redirect()->route('client.shorteners');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = UrlShorter::find($id);

        $data->delete();

        flash()->success('This Url delete successfully.', 'Delete');

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\UrlShorter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UrlShortenerController extends Controller
{
    public function __construct()
    {
        $this->data['url'] = "admin";
        $this->data['activeMenu'] = 'shortener';
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->data['results'] = UrlShorter::getAllUrl($request);

        return view('admin.shortener.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shortener.create', $this->data);
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
    
            $data->admin_id     = getAdminInfo()->id;
            $data->main_url     = $request->main_url;
            $data->short_url    = $shortUrl;

            $data->save();
        }

        flash()->success('Your Long Url Shortener successfully.');
        return redirect()->route('admin.shorteners');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = UrlShorter::find($id);

        $data->forceDelete();

        flash()->success('This Url delete successfully.', 'Delete');

        return redirect()->back();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Http\Request;

class UrlShorter extends Model
{
    use HasFactory, SoftDeletes;

    static function getAllUrl(Request $request) {
        $where = [];
        if(!empty($request->status)) {
            $where['status'] = $request->status;
        }
        return UrlShorter::where($where)->orderBy('id', 'DESC')->get();
    }

    static function getUrl($short) {
        return UrlShorter::where('short_url', $short)->first();
    }

    static function getAllUrlForClient($clientId) {
        return UrlShorter::where('client_id', $clientId)->orderBy('id', 'DESC')->get();
    }
}

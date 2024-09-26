<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Http\Request;

class UrlShorter extends Model
{
    use HasFactory, SoftDeletes;

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id')->select('id', 'name', 'mobile', 'address', 'email', 'avatar');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id')->select('id', 'name', 'mobile', 'address', 'email', 'avatar');
    }

    static function getAllUrl(Request $request) {
        $where = [];
        if(!empty($request->status)) {
            $where['status'] = $request->status;
        }
        return UrlShorter::with('admin', 'client')->where($where)->orderBy('id', 'DESC')->get();
    }

    static function getUrl($short) {
        return UrlShorter::where('short_url', $short)->first();
    }

    static function getAllUrlForClient($clientId) {
        return UrlShorter::where('client_id', $clientId)->orderBy('id', 'DESC')->get();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function demo()
    {
        $tmdb_id = 436270;

        $data = Http::asJson()
        ->get(config('services.tmdb.endpoint').'movie/'.$tmdb_id.'?api_key='.config('services.api_key'));

        return view('demo',compact('data'));
        
    }
}

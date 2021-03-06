<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PoeController extends Controller
{
    public function leagues(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://www.pathofexile.com/api/leagues', [
            'query' => $request->all()
        ]);
        return $res->getBody()->getContents();
    }

    public function ladders(Request $request, $id)
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://www.pathofexile.com/api/ladders/' . $id, [
            'query' => $request->all()
        ]);
        return $res->getBody()->getContents();
    }

    public function character(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $hash = hash('ripemd160', json_encode($request->all()));
        $res = $client->request('GET', 'https://poe.ninja/api/data/{$hash}/GetCharacter', [
            'query' => $request->all()
        ]);
        return $res->getBody()->getContents();
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PoeController extends Controller
{
    /**
     * Get leagues list from pathofexile.com API.
     *
     * @param Request $request
     *
     * @return string
     */
    public function leagues(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://www.pathofexile.com/api/leagues', [
            'query' => $request->all()
        ]);
        $data = $res->getBody()->getContents();

        return $data;
    }

    /**
     * Get ladders info from pathofexile.com API.
     *
     * @param Request $request
     * @param string $id       The league id.
     *
     * @return string
     */
    public function ladders(Request $request, string $id)
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://www.pathofexile.com/api/ladders/' . $id, [
            'query' => $request->all()
        ]);
        $data = $res->getBody()->getContents();

        return $data;
    }

    /**
     * Get character info from poe.ninja API.
     *
     * @param Request $request
     *
     * @return string
     */
    public function character(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $hash = hash('ripemd160', json_encode($request->all()));
        $res = $client->request('GET', 'https://poe.ninja/api/data/{$hash}/GetCharacter', [
            'query' => $request->all()
        ]);
        $data = $res->getBody()->getContents();

        return $data;
    }
}

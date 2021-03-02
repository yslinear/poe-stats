<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PoeController extends Controller
{
    public function leagues()
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://www.pathofexile.com/api/leagues?realm=pc');
        return $res->getBody()->getContents();
    }
}

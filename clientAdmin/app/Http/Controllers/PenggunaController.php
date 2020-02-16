<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use View;

class PenggunaController extends Controller
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://localhost:3000/api/',
        ]);
    }

    public function getAll()
    {
        $response = $this->_client->request('GET', 'pengguna', [
            'query' => [
                'API_KEY' => 'ara_tamvan'
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), false);

        if ($result->status == "Success") {
            $data =  [
                'penggunas' => $result->data,
            ];
            // return $data;
            return View::make('pengurus.table_pengguna', $data);
        } else {
            abort(404);
        }
    }
}

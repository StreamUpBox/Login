<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function murugoLogin()
    {
        $query = http_build_query([
            'client_id' => 9,
            'redirect_uri' => 'http://localhost:9002/callback',
            'response_type' => 'code',
            'scope' => '',
        ]);
        return redirect('http://localhost:8000/oauth/authorize?' . $query);
    }
    public function loginAuth()
    {

    }
    public function callback(Request $request)
    {
        $http = new \GuzzleHttp\Client;
        $response = $http->post('http://localhost:8000/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => 9,
                'client_secret' => 'XVbvMKYT6o8PqXG8TRXWpCkzUHNhJ7qIPqC252KC',
                'redirect_uri' => 'http://localhost:9002/callback',
                'code' => $request->code
            ]
        ]);

        return json_decode((string)$response->getBody(), true);
    }
}

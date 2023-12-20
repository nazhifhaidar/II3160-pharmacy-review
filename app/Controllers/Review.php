<?php
namespace App\Controllers;

class Review extends BaseController
{
    public function index()
    {
        if (session()->get('num_user') == '') {
            return redirect()->to('/login');
        }

        // echo session()->get('username');
        $apiURL = getenv('SERVICE_URL').'/api/data_complete';
        $client =  \Config\Services::curlrequest();
        $response = $client->setHeader('Content-Type', 'application/json')->request('GET', $apiURL);
        $jsonString = $response->getBody(); // Get the JSON string
        $arrayMedicine = json_decode($jsonString, true);
        return view('styling', ['data'=>$arrayMedicine]);
    }
}
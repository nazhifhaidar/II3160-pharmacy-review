<?php

namespace App\Controllers;
use App\Models\Review;

class DaftarObatController extends BaseController{
    public function index(){
        $apiURL = 'http://localhost:8080/api/data';
        $client =  \Config\Services::curlrequest();
        $response = $client->setHeader('Content-Type', 'application/json')->request('GET', $apiURL);
        $arrayMedicine = json_decode((string)$response->getJSON())["predictions"];
        $model = new Review();
        

    }
}
<?php

namespace App\Controllers;

use App\Models\Review;
use CodeIgniter\RESTful\ResourceController;


class ReviewAPIController extends ResourceController
{
    public function getReview($drugsId)
    {
        try {
            $model = model(Review::class);
            $result = $model->getReviewByProductId($drugsId);
            return $this->respond($result, 200, "Data retrieved");
        } catch (\Exception $e) {
            return $this->respond(null, 500, $e->getMessage());
        }
    }

    public function test()
    {
        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', 'http://localhost:8080/api/data');
        echo $response->getBody();
        echo $response->header('Content-Type');
    }
}

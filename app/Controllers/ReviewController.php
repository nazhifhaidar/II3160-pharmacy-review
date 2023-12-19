<?php

namespace App\Controllers;

use App\Models\Review;

class ReviewController extends BaseController
{
    public function showAllReviewOfCertainProduct($drugsId)
    {
        try {
            if (session()->get('num_user') == '') {
                return redirect()->to('/login');
            }

            $sessionUser = session()->get('username');
    
            $model = model(Review::class);
            // $productInfo = 
            $result = $model->getReviewByProductId($drugsId);
            $apiURL = 'http://localhost:8080/api/data/'.$drugsId;
            $client =  \Config\Services::curlrequest();
            $response = $client->setHeader('Content-Type', 'application/json')->request('GET', $apiURL);
            $jsonString = $response->getBody(); // Get the JSON string
            $medicine = json_decode($jsonString, true);
            $recommendedArray = [];
            foreach ($result as $data) {
                $prediction = $model->predictTextSentiment($data->comment);
                array_push($recommendedArray, $prediction);
            }
            $analysis = $model->analyzeReview($drugsId);
            return view('review_detail', ['data' => $result, 'sentiments' => $recommendedArray, 'id' => $drugsId, 'analysis' => $analysis, 'medicine'=>$medicine, 'user'=>$sessionUser]);
        } catch (\Exception $e) {
            // echo $e->getTraceAsString();
            echo $e->getMessage();
        }
    }

    public function addComment()
    {
        if (session()->get('num_user') == '') {
            return redirect()->to('/login');
        }

        $request = $this->request;
        $userName = $request->getPost('user_name');
        $comment  = $request->getPost('comment');
        $drugsId = $request->getPost('drugs_id');

        $reviewModel = new Review();
        $result = $reviewModel->addComment($userName, $comment, $drugsId);

        // Return the result as JSON (you can customize this based on your needs)
        return redirect()->to("/review/$drugsId");
    }
}

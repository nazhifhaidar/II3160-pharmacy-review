<?php

namespace App\Controllers;
use App\Models\Review;

class ReviewController extends BaseController{
    public function showAllReviewOfCertainProduct($drugsId){
        try{
            $model = model(Review::class);
            $result = $model->getReviewByProductId($drugsId);
            $recommendedArray = [];
            foreach ($result as $data){
                $prediction = $model->predictTextSentiment($data->comment);
                array_push($recommendedArray, $prediction);
            }
            return view('review', ['data'=>$result, 'sentiments'=>$recommendedArray]);

        }catch (\Exception $e){
            // echo $e->getTraceAsString();
            echo $e->getMessage();
        }

    }
}
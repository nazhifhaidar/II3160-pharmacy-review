<?php

namespace App\Controllers;
use App\Models\Review;

class ReviewController extends BaseController{
    public function showAllReviewOfCertainProduct($drugsId){
        try{
            $model = model(Review::class);
            // $productInfo = 
            $result = $model->getReviewByProductId($drugsId);
            $recommendedArray = [];
            foreach ($result as $data){
                $prediction = $model->predictTextSentiment($data->comment);
                array_push($recommendedArray, $prediction);
            }
            return view('review_detail', ['data'=>$result, 'sentiments'=>$recommendedArray, 'id'=>$drugsId]);

        }catch (\Exception $e){
            // echo $e->getTraceAsString();
            echo $e->getMessage();
        }
    }

    public function addComment(){
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
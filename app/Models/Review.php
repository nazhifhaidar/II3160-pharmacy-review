<?php

namespace App\Models;

use CodeIgniter\Model;

// include('vendor/autoload.php');

use NlpTools\Tokenizers\WhitespaceTokenizer;
use NlpTools\Models\FeatureBasedNB;
use NlpTools\Documents\TrainingSet;
use NlpTools\Documents\TokensDocument;
use NlpTools\FeatureFactories\DataAsFeatures;
use NlpTools\Classifiers\MultinomialNBClassifier;

class Review extends Model
{
    protected $table = "review";
    protected $db = "commerce";

    public $tok;
    public $cls;

    public function __construct()
    {
        $this->db = db_connect();
        $NLPModel = file_get_contents('model.ser');
        $ff = new DataAsFeatures();
        $this->tok = new WhitespaceTokenizer();
        $this->cls = new MultinomialNBClassifier($ff, unserialize($NLPModel));
    }
    public function getReviewByProductId($id)
    {
        $sql = 'SELECT * FROM review WHERE drugs_id = ?';
        return $this->db->query($sql, [$id])->getResult();
    }

    public function getReviewById($id)
    {
        try {
            $sql = "SELECT * FROM {$this->table} WHERE id = ?";
            return $this->db->query($sql, [$id])->getRow();
        } catch (\Exception $e) {
            return null;
        }
    }

    public function analyzeReview($id)
    {
        try {
            $reviewTexts = $this->getReviewByProductId($id);
            // Predict the sentiment
            $num_of_positive = 0;
            foreach ($reviewTexts as $reviewText) {
                $prediction = $this->predictTextSentiment($reviewText->comment);
                if ($prediction == 'recommended') {
                    $num_of_positive++;
                }
            }

            // Return the percentage of people who recommend it
            return ($num_of_positive / count($reviewTexts)) * 100;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Predict the sentiment (recommended or not recommended) of input text
     */
    public function predictTextSentiment(string $text)
    {
        return $this->cls->classify(
            ['recommended', 'not recommended'],
            new TokensDocument($this->tok->tokenize($text))
        );
    }

    public function addComment($userName, $comment, $drugsId){
        try {
            $data = [
                'user_name' => $userName,
                'comment' => $comment,
                'drugs_id' => $drugsId,
            ];
    
            $this->db->table($this->table)->insert($data);
    
            return true;
        } catch (\Exception $e) {
            return false; 
        }
    }

}

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
            $percentage = (count($reviewTexts) > 0) ? ($num_of_positive / count($reviewTexts)) * 100 :  null;
            return ['percentage' => $percentage, 'number' => $num_of_positive, 'total' => count($reviewTexts)];
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

    public function addComment($userName, $comment, $drugsId)
    {
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

    public function summarize()
    {
        try {
            //summarize the overall reviews
            $sql = "SELECT * FROM review";
            $allDataResult = $this->db->query($sql)->getResultArray();
            $countRecommendationResult = ['recommended' => 0, 'not recommended' => 0];
            foreach ($allDataResult as $index=>$row) {
                $prediction = $this->predictTextSentiment($row["comment"]);
                switch ($prediction) {
                    case 'recommended':
                        $countRecommendationResult['recommended']++;
                        break;
                    case 'not recommended':
                        $countRecommendationResult['not recommended']++;
                        break;
                    default:
                        break;
                }
            }
            $overall = [
                'total_review' => count($allDataResult),
                'recommend' => $countRecommendationResult['recommended'],
                'do not recommend' => $countRecommendationResult['not recommended']
            ];

            //=====================================================

            // summmarize the product with most review
            $sql = "SELECT drugs_id, COUNT(drugs_id) AS n_reviews FROM review GROUP BY drugs_id LIMIT 1";
            $mostResult = $this->db->query($sql)->getResultArray();
            $percentageOfMostResult = $this->analyzeReview($mostResult[0]['drugs_id']);

            $the_most_reviewed = ['id' => $mostResult[0]['drugs_id'], 'count' => $mostResult[0]['n_reviews'], 'percentage' => $percentageOfMostResult];

            // find the top 3 product who have the most positive reviews (by percentage)
            $sql = "SELECT drugs_id, COUNT(drugs_id) AS n_reviews FROM review GROUP BY drugs_id";
            $products = $this->db->query($sql)->getResultArray();
            $topProducts = [];
            foreach ($products as $index=> $product) {
                $percentage = $this->analyzeReview($product["drugs_id"]);
                $topProducts[] = [
                    'id' => $product['drugs_id'],
                    'count' => $product['n_reviews'],
                    'percentage' => $percentage
                ];
            }

            // sort the products by positive percentage
            usort($topProducts, function ($a, $b) {
                return $b['percentage'] <=> $a['percentage'];
            });
            $top3Products = array_slice($topProducts, 0, 3);

            return [
                'overall' => $overall,
                'the_most_reviewed' => $the_most_reviewed,
                'top3_products' => $top3Products,
            ];
        } catch (\Exception $e) {
            // return $e->getTraceAsString();
            return $e->getMessage();
        }
    }
}

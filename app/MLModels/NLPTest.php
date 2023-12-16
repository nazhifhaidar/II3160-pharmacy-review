<?php
include('vendor/autoload.php');

use NlpTools\Tokenizers\WhitespaceTokenizer;
use NlpTools\Models\FeatureBasedNB;
use NlpTools\Documents\TrainingSet;
use NlpTools\Documents\TokensDocument;
use NlpTools\FeatureFactories\DataAsFeatures;
use NlpTools\Classifiers\MultinomialNBClassifier;

$training = array(
    array('recommended', 'Good Product, I would to buy again 10/10'),
    array('recommended', 'Great great great, my mom love it'),
    array('not recommended', 'Worst product i ever use. my skin burned'),
    array('recommended', 'Excellent quality, exceeded my expectations'),
    array('recommended', 'I highly recommend this product to everyone'),
    array('not recommended', 'Terrible experience, waste of money'),
    array('recommended', 'The product is amazing, worth every penny'),
    array('not recommended', 'Caused an allergic reaction, stay away'),
    array('not recommended', 'Disappointing purchase, poor quality'),
    array('recommended', 'Incredible! It\'s a must-buy for everyone'),
    array('not recommended', 'Not worth the price, very disappointed'),
    array('recommended', 'Impressed with the quality and performance'),
    array('not recommended', 'Did not meet my expectations at all'),
    array('recommended', 'The best product I have ever purchased'),
    array('recommended', 'Perfect in every way, exceeded my expectations'),
    array('not recommended', 'Faulty product, stopped working after a week'),
    array('recommended', 'I can\'t imagine my life without this product'),
    array('recommended', 'Fantastic! Would recommend to friends and family'),
    array('not recommended', 'Poorly made, broke within a few days'),
    array('not recommended', 'Not as described, misleading product information'),
    array('recommended', 'Great value for money, satisfied with the purchase'),
    array('not recommended', 'Regret buying this product, total waste of money'),
    array('recommended', 'Love it! Best purchase I made this year'),
    array('recommended', 'Highly satisfied, will buy from this brand again'),
    array('not recommended', 'Cheaply made, fell apart after a few uses'),
    array('not recommended', 'Misleading advertising, does not deliver as promised'),
    array('recommended', 'Amazing product, exceeded my expectations'),
    array('not recommended', 'Not durable, broke within a month'),
    array('recommended', 'Impressed with the fast shipping and quality'),
    array('recommended', 'Best purchase ever, couldn\'t be happier'),
    array('recommended', 'Highly recommended, top-notch quality'),
    array('not recommended', 'Terrible quality, fell apart after a week'),
    array('recommended', 'Great customer service, resolved my issue quickly'),
    array('not recommended', 'Misleading product description, disappointed'),
    array('recommended', 'Amazing value for money, exceeded expectations'),
    array('recommended', 'I love this product, can\'t live without it'),
    array('not recommended', 'Regretting the purchase, not what I expected'),
    array('recommended', 'Perfect fit, exactly what I was looking for'),
    array('not recommended', 'Defective product, returned for a refund'),
    array('recommended', 'Absolutely fantastic, worth every penny'),
    array('not recommended', 'Low-quality materials, not durable'),
    array('recommended', 'Quick delivery, product as described'),
    array('recommended', 'Impressed with the durability and performance'),
    array('not recommended', 'Overpriced for the quality, disappointed'),
    array('recommended', 'Great addition to my collection, highly satisfied'),
    array('not recommended', 'Received damaged item, poor packaging'),
    array('recommended', 'Excellent customer reviews, lived up to the hype'),
    array('not recommended', 'Not as advertised, misleading marketing'),
    array('recommended', 'Outstanding product, exceeded my expectations'),
    array('not recommended', 'Unreliable, stopped working after a few uses'),
    array('recommended', 'Perfect gift, recipient was delighted'),
    array('not recommended', 'Uncomfortable to use, regret buying'),
    array('recommended', 'Awesome product, would buy again'),
    array('not recommended', 'Product didn\'t match the picture, disappointed'),
    array('recommended', 'Highly durable, still in great condition after months of use'),
    array('not recommended', 'Failed to meet expectations, not recommended'),
    array('recommended', 'Great features, easy to use, highly recommended'),
    array('recommended', 'Top-quality craftsmanship, impressed with the design'),
    array('not recommended', 'Product broke on the first use, very disappointed'),
    array('recommended', 'Fantastic product, changed my life for the better'),
    array('recommended', 'Met all my expectations, very satisfied'),
    array('not recommended', 'Poorly designed, difficult to use'),
    array('recommended', 'Similar to another highly recommended product'),
    array('not recommended', 'Similar to the worst purchase I ever made'),
    array('recommended', 'Comparable to other top-rated products'),
    array('not recommended', 'Reminds me of a disappointing buy in the past'),
    array('recommended', 'Looks promising, could be a good addition'),
    array('not recommended', 'Seems like a repeat of a regretful purchase'),
    array('recommended', 'Appears to meet my expectations based on reviews'),
    array('not recommended', 'Feels like it might disappoint based on the description'),
    array('recommended', 'Comparing well with other well-reviewed items'),
    array('not recommended', 'Shares similarities with a product I didn\'t like'),
    array('recommended', 'Looks like a great alternative to other recommended items'),
    array('not recommended', 'Brings back memories of a product I regret buying'),
    array('recommended', 'In line with other products I have found excellent'),
    array('recommended', 'Similar to a highly praised item I previously purchased'),
    array('not recommended', 'Giving off vibes of a product that fell short'),
    array('recommended', 'Seems like it could be a fantastic buy'),
    array('not recommended', 'Feels like it might have the same issues as a previous purchase'),
    array('recommended', 'Shares positive characteristics with well-received products'),
    array('not recommended', 'Comparable to a product that didn\'t live up to expectations'),
    array('recommended', 'Spectacular product, exceeded all expectations'),
    array('not recommended', 'Dreadful experience, regret buying it'),
    array('recommended', 'Worth every cent, would buy again'),
    array('not recommended', 'Deceptive advertising, not as described'),
    array('recommended', 'Unbelievably good, a game-changer'),
    array('not recommended', 'Poorly made, fell apart within days'),
    array('recommended', 'Exceptional quality, impressed with durability'),
    array('not recommended', 'Frustrating to use, not user-friendly'),
    array('recommended', 'Thrilled with my purchase, highly recommended'),
    array('not recommended', 'Unreliable, stopped working unexpectedly'),
    array('recommended', 'Top-tier product, unmatched quality'),
    array('not recommended', 'Regretful purchase, did not meet expectations'),
    array('recommended', 'Outstanding performance, exceeded my needs'),
    array('not recommended', 'False advertising, product does not deliver'),
    array('recommended', 'Great investment, adds significant value'),
    array('not recommended', 'Displeased with the quality, not recommended'),
    array('recommended', 'Flawless product, worth every penny'),
    array('not recommended', 'Inferior quality, disappointed with the purchase'),
    array('recommended', 'My go-to product, can\'t live without it'),
    array('not recommended', 'Unimpressed, did not live up to the hype'),
    array('recommended', 'Absolutely fantastic, would recommend to everyone'),
    array('recommended', 'Reliable and durable, exceeded my expectations'),
    array('not recommended', 'Misleading packaging, not what I expected'),
    array('recommended', 'Superb craftsmanship, impressed with the design'),
    array('not recommended', 'Not as described, feels like a scam'),
    array('recommended', 'Pleasantly surprised, exceeded all predictions'),
    array('not recommended', 'Defective, had to return for a refund'),
    array('recommended', 'Flawless functionality, a must-have'),
    array('not recommended', 'Unsatisfied, did not meet basic requirements'),
    array('recommended', 'Exceptional service, quick and efficient'),
    array('not recommended', 'Unpleasant experience, regret the purchase'),
    array('recommended', 'Perfect fit for my needs, highly recommended'),
    array('recommended', 'Remarkable product, a cut above the rest'),
    array('not recommended', 'Subpar quality, disappointed with the performance'),
    array('recommended', 'Delighted with my purchase, exceeded my expectations'),
    array('not recommended', 'Broke within days, poor durability'),
    array('recommended', 'Incredible value for money, highly satisfied'),
    array('recommended', 'Met and surpassed all expectations, outstanding'),
    array('not recommended', 'Not functional, a complete waste of money'),
    array('recommended', 'Looks like a winner, similar to top-rated products'),
    array('not recommended', 'Eerily reminiscent of a failed purchase'),
    array('recommended', 'Gives off positive vibes, akin to other great buys'),
    array('not recommended', 'Has the same feel as a previously regretted product'),
    array('recommended', 'Seems like a wise choice, comparable to highly recommended items'),
    array('not recommended', 'Brings back memories of a product that didn\'t work out'),
    array('recommended', 'Positive reviews align with my expectations'),
    array('not recommended', 'Feels like it might share the downsides of another disappointing purchase'),
    array('recommended', 'Similar to products I\'ve had success with in the past'),
    array('not recommended', 'Getting flashbacks of a purchase I wish I never made'),
    array('recommended', 'Looks like a fantastic addition, similar to my favorite products'),
    array('not recommended', 'Reminds me of a product I regretted buying'),
    array('recommended', 'Positive features align with what I\'m looking for'),
    array('not recommended', 'Similar to a product that left me unsatisfied'),
    array('recommended', 'Seems promising, comparable to well-loved items'),
    array('not recommended', 'Evokes memories of a product that fell short of expectations'),
    array('recommended', 'Good reviews make it seem like a great choice'),
    array('not recommended', 'Skeptical, as it brings back memories of a bad purchase'),
    array('recommended', 'Shares positive attributes with top-rated items'),
    array('not recommended', 'Brings back negative experiences from a previous purchase'),
);

$testing = array(
    array('recommended', 'Looks like a winner, similar to top-rated products'),
    array('not recommended', 'Eerily reminiscent of a failed purchase'),
    array('recommended', 'Gives off positive vibes, akin to other great buys'),
    array('not recommended', 'Has the same feel as a previously regretted product'),
    array('recommended', 'Seems like a wise choice, comparable to highly recommended items'),
    array('not recommended', 'Brings back memories of a product that didn\'t work out'),
    array('recommended', 'Positive reviews align with my expectations'),
    array('not recommended', 'Feels like it might share the downsides of another disappointing purchase'),
    array('recommended', 'Similar to products I\'ve had success with in the past'),
    array('not recommended', 'Getting flashbacks of a purchase I wish I never made'),
    array('recommended', 'Looks like a fantastic addition, similar to my favorite products'),
    array('not recommended', 'Reminds me of a product I regretted buying'),
    array('recommended', 'Positive features align with what I\'m looking for'),
    array('not recommended', 'Similar to a product that left me unsatisfied'),
    array('recommended', 'Seems promising, comparable to well-loved items'),
    array('not recommended', 'Evokes memories of a product that fell short of expectations'),
    array('recommended', 'Good reviews make it seem like a great choice'),
    array('not recommended', 'Skeptical, as it brings back memories of a bad purchase'),
    array('recommended', 'Shares positive attributes with top-rated items'),
    array('not recommended', 'Brings back negative experiences from a previous purchase'),
);

$tset = new TrainingSet(); // will hold the training documents
$tok = new WhitespaceTokenizer(); // will split into tokens
$ff = new DataAsFeatures(); // see features in documentation

foreach ($training as $d)
{
    $tset->addDocument(
        $d[0], // class
        new TokensDocument(
            $tok->tokenize($d[1]) // The actual document
        )
    );
}
 
$model = new FeatureBasedNB(); // train a Naive Bayes model
$model->train($ff,$tset);
 
// Serialize and save the model to a file
$modelFile = 'app/MLModels/model.ser';
file_put_contents($modelFile, serialize($model));

 
// ---------- Classification ----------------
// $cls = new MultinomialNBClassifier($ff,$model);
$cls = new MultinomialNBClassifier($ff, unserialize(file_get_contents($modelFile)));
$correct = 0;
foreach ($testing as $d)
{
    // predict if it is spam or ham
    $prediction = $cls->classify(
        array('recommended','not recommended'), // all possible classes
        new TokensDocument(
            $tok->tokenize($d[1]) // The document
        )
    );
    if ($prediction==$d[0])
        $correct ++;
}
 
printf("Accuracy: %.2f\n", 100*$correct / count($testing));
$text = 'bad product!. looks like shit';
$sentimentPred = $cls->classify(
    array('recommended','not recommended'),
    new TokensDocument(
        $tok->tokenize($text) // The document
    )
    );
printf("prediction for \"%s\" is \"%s\"", $text, $sentimentPred);
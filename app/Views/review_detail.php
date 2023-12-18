<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commercial System</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/card.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/med-info.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/cust-review.css'); ?>">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
</head>
<style>
    body {
        font-family: 'Inter';
    }

    .screen {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: flex-start;
    width: 90%;
    height: 100%;
    padding-left: 60px;
    padding-right: 60px;

    .right-container {
        display: flex;
        align-items: flex-start;
        padding: 16px;
    }
}

</style>

<body>
    <div class="screen">
        <div class="left-container">
            <div class="med-info-container">
                <div class="headline">
                    <img class="image-2" src="/assets/image-2.png" alt="Med Image" />
                    <div class="text-1 text-3">
                        <div class="med-name align-paragraph-middle headline-semibold-4">
                            Aldactone Spironolactone
                        </div>
                        <div class="review">
                            <div class="percent align-paragraph-middle headline-semibold-2">86%</div>
                            <div class="review-item align-paragraph-middle body-regular-2">Recommended</div>
                            <div class="review-item align-paragraph-middle boddy-regular-2">(13 of 15)</div>
                        </div>
                    </div>
                </div>
                <div class="med">
                    <div class="tion align-text-left body-semibold-2">Brief Explanation</div>
                    <p class="tion align-text-left body-regular-3">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Amet purus gravida quis blandit turpis cursus. Congue nisi vitae suscipit tellus mauris a diam.
                    </p>
                </div>
                <div class="med">
                    <div class="tion align-text-left body-semibold-2">Composition</div>
                    <p class="tion align-text-left body-regular-3">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Amet purus gravida quis blandit turpis cursus. Congue nisi vitae suscipit tellus mauris a diam.
                    </p>
                </div>
            </div>

            <div class="frame-49">
                <p class="write-title align-button-middle body-semibold-1">Write your Review for Aldactone Spironolactone</p>
                <form action="/review/addComment" method="POST">
                    <input type="hidden" name="user_name" value="User1">
                    <input type="hidden" name="drugs_id" value="<?= $id ?>">
                    <div class="frame-61">
                        <textarea type="text" class="share body-regular-3" name="comment" placeholder="Share your experience while using this product" id="comment"></textarea>
                    </div>
                    <button class="align-text-middle button-primary" id="postReviewButton" type="submit">
                        Post Your Review
                    </button>
                </form>
            </div>
        </div>
        <div class="right-container">
            <?php foreach ($data as $index => $record) : ?>
                <div class="comment-card">
                    <h3><?= $record->user_name ?></h3>
                    <p><?= $record->comment ?></p>
                    <p><?= $sentiments[$index] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>
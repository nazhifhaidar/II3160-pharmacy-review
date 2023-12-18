<!DOCTYPE html>
<html lang="en">
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
    }

    form {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px;
    }

    button {
        background-color: #ff5722;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    #search-bar {
        margin: 10px;
        display: flex;
        justify-content: flex-end;
    }

    #search-input {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .search-wrapper {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }
</style>

<body>
    <div class="screen">
        <div class="left-container">
            <div class="search-wrapper" id="search-bar">
                <form>
                    <label for="search-input" style="margin-right: 5px;">Search:</label>
                    <input type="text" id="search-input" name="search" placeholder="Enter keyword">
                    <button type="submit">Search</button>
                </form>
            </div>
            <div class="card-container">
                <article class="med-review-card">
                    <img class="image-1" src="../assets/image-2.png" alt="Med Image"/>
                    <div class="info-container">
                        <div class="brand-name body-regular-1">
                            Aldactone
                        </div>
                        <div class="generic-name body-semibold-1">
                            Spironolactone
                        </div>
                        <div class="button-wrapper">
                            <div class="align-text-middle button-secondary">
                                    Add Review
                            </div>
                        </div>
                    </div>
                </article>
                <article class="med-review-card">
                    <img class="image-1" src="../assets/image-2.png" alt="Med Image"/>
                    <div class="info-container">
                        <div class="brand-name body-regular-1">
                            Aldactone
                        </div>
                        <div class="generic-name body-semibold-1">
                            Spironolactone
                        </div>
                        <div class="button-wrapper">
                            <div class="align-text-middle button-secondary">
                                    Add Review
                            </div>
                        </div>
                    </div>
                </article>
                <article class="med-review-card">
                    <img class="image-1" src="../assets/image-2.png" alt="Med Image"/>
                    <div class="info-container">
                        <div class="brand-name body-regular-1">
                            Aldactone
                        </div>
                        <div class="generic-name body-semibold-1">
                            Spironolactone
                        </div>
                        <div class="button-wrapper">
                            <div class="align-text-middle button-secondary">
                                    Add Review
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
        <div class="right-container">
            <div class="med-info-container">
                <div class="headline">
                    <img class="image-2" src="../assets/image-2.png" alt="Med Image"/>
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
                <div class="frame-61">
                    <p class="share body-regular-3">Share your experience while using this product</p>
                </div>
                <div class="frame-62">
                    <div class="choose align-button-middle body-semibold-3">Are this product recommended?</div>
                    <img class="thumb-up" src="../assets/thumb_up.svg" alt="thumb-up"/><img class="thumb-down" src="../assets/thumb_down.svg" alt="thumb-down"/>
                </div>
                <div class="align-text-middle button-primary">
                    Post Your Review
                </div>
            </div>
        </div>
    </div>
</body>
</html>
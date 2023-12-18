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
    <div class="screen" style="display: flex; justify-content: center;">
        <div class="left-container" >
            <div class="search-wrapper" id="search-bar">
                <form>
                    <label for="search-input" style="margin-right: 5px;">Search:</label>
                    <input type="text" id="search-input" name="search" placeholder="Enter keyword">
                    <button type="submit">Search</button>
                </form>
            </div>
            <div class="card-container">
                <article class="med-review-card" id="1">
                    <img class="image-1" src="../assets/image-2.png" alt="Med Image" />
                    <div class="info-container">
                        <div class="brand-name body-regular-1">
                            Aldactone
                        </div>
                        <div class="generic-name body-semibold-1">
                            Spironolactone
                        </div>
                        <div class="button-wrapper">
                            <a href="<?= base_url('review/1') ?>" class="align-text-middle button-secondary">View Reviews</a>
                        </div>
                    </div>
                </article>
                <article class="med-review-card" id="2">
                    <img class="image-1" src="../assets/image-2.png" alt="Med Image" />
                    <div class="info-container">
                        <div class="brand-name body-regular-1">
                            Aldactone
                        </div>
                        <div class="generic-name body-semibold-1">
                            Spironolactone
                        </div>
                        <div class="button-wrapper">
                            <a href="<?= base_url('review/2') ?>" class="align-text-middle button-secondary">View Reviews</a>
                        </div>
                    </div>
                </article>
                <article class="med-review-card" id="3">
                    <img class="image-1" src="../assets/image-2.png" alt="Med Image" />
                    <div class="info-container">
                        <div class="brand-name body-regular-1">
                            Aldactone
                        </div>
                        <div class="generic-name body-semibold-1">
                            Spironolactone
                        </div>
                        <div class="button-wrapper">
                            <a href="<?= base_url('review/3') ?>" class="align-text-middle button-secondary">View Reviews</a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
        
    </div>
</body>

</html>
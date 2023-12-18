<?php
if (isset($_GET['search'])) {
    // Get the search keyword
    $searchKeyword = $_GET['search'];

    // Filter the $data array based on the search keyword
    $data = array_filter($data, function ($row) use ($searchKeyword) {
        foreach ($row as $field) {
            if (stripos($field, $searchKeyword) !== false) {
                return true; // Match found
            }
        }
        return false; // No match found
    });
}
?>

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
        <div class="left-container">
            <div class="search-wrapper" id="search-bar">
                <form>
                    <label for="search-input" style="margin-right: 5px;">Search:</label>
                    <input type="text" id="search-input" name="search" placeholder="Enter keyword">
                    <button type="submit">Search</button>
                </form>
            </div>
            <div class="card-container">
                <?php foreach ($data as $record) : ?>
                    <article class="med-review-card" id="<?= $record["id"] ?>">
                        <img class="image-1" src="../assets/Aldactone.png" alt="Med Image" />
                        <div class="info-container">
                            <div class="brand-name body-regular-1">
                                <?= $record["brandName"] ?>
                            </div>
                            <div class="generic-name body-semibold-1">
                                <?= $record["genericName"] ?>
                            </div>
                            <div class="button-wrapper">
                                <a href="<?= base_url('review/' . $record["id"]) ?>" class="align-text-middle button-secondary">View Reviews</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</body>

</html>
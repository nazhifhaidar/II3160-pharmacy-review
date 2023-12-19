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
        justify-content: center;
        align-items: flex-start;
        width: fit-content;
        height: 100%;
        padding-left: 20px;
        padding-right: 20px;
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

    .center {
        display: flex;
        justify-content: center;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        width: fit-content;
    }
    .card-container{
        display: grid;
        grid-template-columns: repeat(2, minmax(300px, 1fr));
        grid-gap: 20px;
        align-items: stretch;
        justify-content: center;
        width: 100%;
    }

    .med-review-card:hover {
        transform: scale(1.05);
    }
</style>

<body>
    <div class="center">
        <div class="screen">
            <div class="container">
                <div class="row-1" style="display: flex; flex-direction: row; justify-content:space-evenly; width:100%">
                    <div class="search-wrapper" id="search-bar">
                        <form>
                            <label for="search-input" style="margin-right: 5px;">Search:</label>
                            <input type="text" id="search-input" name="search" placeholder="Enter keyword">
                            <button type="submit">Search</button>
                        </form>
                    </div>
                    <div class="logout">
                        <a href="/logout">Logout</a>
                    </div>
                </div>

                <div class="card-container">
                    <?php foreach ($data as $record) : ?>
                        <article class="med-review-card" id="<?= $record["id"] ?>">
                            <img class="image-1" src="/assets/<?= $record['genericName'] ?>.png" alt="Med Image" />
                            <div class="info-container">
                                <div class="brand-name body-regular-1">
                                    <?= $record["brandName"] ?>
                                </div>
                                <div class="generic-name body-semibold-1">
                                    <?= $record["genericName"] ?>
                                </div>
                                <div class="days-depleted">
                                    Will be depleted in <?= $record['predicted_days_left'] ?> day(s)
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
    </div>

</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Review Page</title>
</head>

<body>
    <div class="container">
        <?php foreach ($data as $index => $record) : ?>
            <div class="comment-card">
                <h3><?= $record->user_name ?></h3>
                <p><?= $record->comment ?></p>
                <p><?= $sentiments[$index] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>
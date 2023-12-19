<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Home </title>
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
</head>
<style>
    body {
        font-family: 'Inter';
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f0f0f0;
    }

    .container-center {
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .main-content {
        border: solid 2px #fff;
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    .main-content button {
        margin-top: 10px;
        padding: 10px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .main-content button:last-child {
        background-color: rgba(86, 158, 137, 1);
        margin-top: 10px;
    }
</style>

<body>
    <div class="container-center">
        <h1>
            Welcome To The Jungle!!
        </h1>
        <h2>
            What are you looking for?
        </h2>
        <div class="main-content">
            <a href="/review"><button>Go to Review</button></a>
            <a href="/logout"><button>Logout</button></a>
        </div>
    </div>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../public/chabacano_logo.png">
    <link rel="stylesheet" href="../styles/index.css">
    <style>
        body {
            background-image: none;
            background: #F7F7F7;
        }

        body::after {
            display: none;
        }
    </style>
    <title>Login</title>
</head>

<body>
    <main class="login">
        <div class="login__content">
            <div class="login__content__logo--container container">
                <img src="../public/chabacano_logo.png" alt="Chabacano Translator Logo">
            </div>
            <div class="login__content__form--container container">
                <div class="login__content__form--container__form">
                    <h1 class="fs-heading-4">Admin Login</h1>
                    <form action="../scripts/loginProcess.php" method="post">
                        <div class="form-group">
                            <label for="username" class="fs-body-text text-acccent-3">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username">
                        </div>
                        <div class="form-group">
                            <label for="password" class="fs-body-text text-acccent-3">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="button button--secondary">Login</button>
                            <button type="button" onclick="window.location.href = '../';" class="button button--secondary">Home</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
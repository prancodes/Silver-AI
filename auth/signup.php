<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../assets/css/form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="icon" type="image/png" href="./favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="./favicon/favicon.svg" />
    <link rel="shortcut icon" href="./favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Silver AI" />
    <link rel="manifest" href="./favicon/site.webmanifest" />
</head>

<body>
    <?php
    require_once __DIR__ . '/../vendor/autoload.php';

    // Load the .env file
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    $clientID = $_ENV['GOOGLE_CLIENT_ID'];
    $clientSecret = $_ENV['GOOGLE_CLIENT_SECRET'];
    $redirectUri = 'http://localhost/SILVER%20AI/Silver-AI/views/silver.html';


    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUri);
    $client->addScope("email");
    $client->addScope("profile");


    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);

        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email =  $google_account_info->email;
        $name =  $google_account_info->name;
    ?>
        <div class="input-user">
            <label for="email">Email <?php echo $email; ?></label>
            <label for="name">Name <?php echo $name; ?></label>
        </div>

    <?php } else { ?>
        <div class="container" id="signUpForm">
            <h1 class="form-title">Register</h1>
            <form action="../services/register.php" method="post">
                <div class="input-user">
                    <i class="fas fa-user"></i>
                    <input type="text" name="Username" id="username" placeholder="Username">
                    <label for="username">Username</label>
                </div>
                <div class="input-user">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" placeholder="Valid Email ID">
                    <label for="email">Email</label>
                </div>
                <div class="input-user">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
                <input type="submit" class="button" value="Sign Up" name="signUp">
            </form>
            <p class="or">
                OR
            </p>
            <div class="icons">
                <a href="<?php echo $client->createAuthUrl() ?>"><i class="fab fa-google"></i></a>
            </div>
            <div class="link">
                <p>Already Have Account?</p>
                <a href="../auth/login.php"><button id="signInButton">Sign In</button></a>
            </div>
        </div>

    <?php } ?>
</body>

</html>
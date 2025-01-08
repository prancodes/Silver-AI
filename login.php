<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <?php
require_once 'vendor/autoload.php';


$clientID = '1034298807661-bgjk5c085fjpakvidkuqsuvuijvjhogm.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/Login/silver.php';


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
    
    <?php } else {?>
    <div class="container" id="signInForm">
        <h1 class="form-title">Sign In</h1>
        <form action="register.php" method="post">
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
            <p class="recover">
                <a href="#">Recover Password</a>
            </p>
            <input type="submit" class="button" value="Sign In" name="signIn">
        </form>
        <p class="or">
            OR
        </p>
        <div class="icons">
           <a href="<?php echo $client->createAuthUrl()?>"><i class="fab fa-google"></i></a>
            <i class="fab fa-facebook"></i>
        </div>
        <div class="link">
            <p>Don't Have Account Yet?</p>
            <a href="./signup.php"><button id="signUpButton">Sign Up</button></a>
        </div>
    </div>
    <script src="script.js"></script>
    <?php } ?>
</body>
</html>

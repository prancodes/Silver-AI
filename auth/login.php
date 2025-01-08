<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="../assets/css/form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <div class="container" id="signInForm">
        <h1 class="form-title">Sign In</h1>
        <form action="../services/register.php" method="post">
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
            <i class="fab fa-google"></i>
            <i class="fab fa-facebook"></i>
        </div>
        <div class="link">
            <p>Don't Have Account Yet?</p>
            <a href="./signup.php"><button id="signUpButton">Sign Up</button></a>
        </div>
    </div>

</body>
</html>
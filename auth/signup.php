<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../assets/css/form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
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
            <i class="fab fa-google"></i>
            <i class="fab fa-facebook"></i>
        </div>
        <div class="link">
            <p>Already Have Account?</p>
            <a href="./login.php"><button id="signInButton">Sign In</button></a>
        </div>
    </div>

</body>
</html>
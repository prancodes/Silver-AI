<?php
// api/views/vision.php
// Session protection: Check if user is logged in
session_start();

if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header("Location: /auth/login.php");
    exit();
}

$username = $_SESSION['username'] ?? 'User';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silver Vision</title>
    <link rel="stylesheet" href="/assets/css/silver.css">
    <link rel="stylesheet" href="/assets/css/style.css">

    <script src="https://js.puter.com/v2/"></script>
</head>
<body>
    <div class="navbar">
        <a href="/" class="nav-logo-a">
          <h2 class="nav-logo"><i class="fa-duotone fa-solid fa-circle-nodes" style="--fa-primary-color: #ffffff; --fa-secondary-color: #ffffff;"></i>Silver Vision</h2>
        </a>
        <div class="nav-login-section">
            <span style="color: white; margin-right: 15px;">Welcome, <?php echo htmlspecialchars($username); ?></span>
            <a href="/auth/logout.php" class="login nav-logo-a btn-primary">Logout</a>
        </div>
    </div>

<div class="container">
        <div id="chat-container">
            <div id="chat-input">
                <input type="url" id="image-url" placeholder="Paste Image URL/Link" required>
                <input type="text" id="input-message" placeholder="Describe this Image..." required>
                <button onclick="descImage()">Describe</button>
            </div>
          <div id="messages" class="vision-msg-tab"></div>
          <p>Silver AI - shaping the future with intelligent solutions</p>
        </div>
    
        <div class="img-desc">
          <a href="./silver.php" class="nav-logo-a"><div class="btn-primary">Silver AI</div></a>
        </div>
    </div>

    <script src="../assets/js/vision.js"></script>
</body>
</html>

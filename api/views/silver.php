<?php
// api/views/silver.php
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
    <title>Ask Silver</title>
    <link rel="stylesheet" href="/assets/css/silver.css">
    <link rel="stylesheet" href="/assets/css/style.css">

    <script src="https://js.puter.com/v2/"></script>
</head>
<body>
    <div class="navbar">
        <a href="/" class="nav-logo-a">
          <h2 class="nav-logo"><i class="fa-duotone fa-solid fa-circle-nodes" style="--fa-primary-color: #ffffff; --fa-secondary-color: #ffffff;"></i>Silver AI</h2>
        </a>
        <div class="nav-login-section">
            <span style="color: white; margin-right: 15px;">Welcome, <?php echo htmlspecialchars($username); ?></span>
            <a href="/auth/logout.php" class="login nav-logo-a btn-primary">Logout</a>
        </div>
    </div>

  <div class="container">
    <div id="chat-container">
      <div id="messages"></div>
      <div id="chat-input">
        <input type="text" id="input-message" placeholder="Ask me anything..." required>
        <button onclick="sendMessage()">Send</button>
      </div>
      <p>Silver AI - shaping the future with intelligent solutions</p>
    </div>

    <div class="img-desc">
      <a href="./vision.php" class="nav-logo-a"><div class="btn-primary">Silver Vision</div></a>
    </div>
  </div>

  <script src="../assets/js/silver.js"></script>
</body>
</html>
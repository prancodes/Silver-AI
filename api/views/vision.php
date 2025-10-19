<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Silver Vision</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300..700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/silver.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <link rel="icon" type="image/png" href="../favicon/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="../favicon/favicon.svg" />
  <link rel="shortcut icon" href="../favicon/favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png" />
  <meta name="apple-mobile-web-app-title" content="Silver AI" />
  <link rel="manifest" href="../favicon/site.webmanifest" />

  <script src="https://js.puter.com/v2/"></script>
</head>
<body>
    <div class="navbar">
        <a href="./vision.php" class="nav-logo-a">
          <h2 class="nav-logo"><i class="fa-duotone fa-solid fa-circle-nodes" style="--fa-primary-color: #ffffff; --fa-secondary-color: #ffffff;"></i>Silver Vision</h2>
        </a>
        <div class="nav-login-section">
          <a href="../auth/logout.php" class="nav-logo-a">
            <div class="btn-primary">Logout</div>
          </a>
        </div>
        <div class="sidebar">
          <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
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
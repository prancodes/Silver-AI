<?php
// api/services/register.php
require_once __DIR__ . '/connect.php';

if (isset($_POST['signUp'])) {
    // Validate username exists in POST data
    $username = isset($_POST['username']) ? trim($_POST['username']) : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;

    // Validation
    if (empty($username) || empty($email) || empty($password)) {
        die("Error: All fields are required (username, email, password)");
    }

    // CHANGED: Replaced insecure md5() with password_hash()
    // This creates a strong, salted hash.
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $checkEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        echo "Email Address Already Exists!";
    } else {
        $insertQuery = $conn->prepare("INSERT INTO users(username, email, password, created_at) VALUES (?, ?, ?, NOW())");
        
        // CHANGED: Bind the new $hashed_password instead of the md5 password
        $insertQuery->bind_param("sss", $username, $email, $hashed_password);

        if ($insertQuery->execute()) {
            // Session already started in index.php, just set variables
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;
            header("Location: /views/silver.php");
            exit();
        } else {
            echo "ERROR: " . $conn->error;
        }
    }
}

if (isset($_POST['signIn'])) {
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;

    if (empty($email) || empty($password)) {
        die("Error: Email and password are required");
    }

    // CHANGED: The entire login logic is different.
    // 1. We only select the user by their email.
    $sql = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // 2. We use password_verify() to securely check the submitted password against the hash stored in the database.
        if (password_verify($password, $row['password'])) {
            // Session already started in index.php, just set variables
            $_SESSION['email'] = $row['email'];
            $_SESSION['username'] = $row['username'];
            header("Location: /views/silver.php");
            exit();
        } else {
            // Invalid password
            echo "Not Found, Incorrect Email or Password";
        }
    } else {
        // No user found with that email
        echo "Not Found, Incorrect Email or Password";
    }
}
?>

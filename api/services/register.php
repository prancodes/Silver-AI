<?php
// api/services/register.php
// Fix: Use correct relative path to connect.php
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

    $password = md5($password);

    $checkEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        echo "Email Address Already Exists!";
    } else {
        $insertQuery = $conn->prepare("INSERT INTO users(username, email, password, created_at) VALUES (?, ?, ?, NOW())");
        $insertQuery->bind_param("sss", $username, $email, $password);

        if ($insertQuery->execute()) {
            // Start session and set user data
            session_start();
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

    $password = md5($password);

    $sql = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $sql->bind_param("ss", $email, $password);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        $_SESSION['username'] = $row['username'];
        header("Location: /views/silver.php");
        exit();
    } else {
        echo "Not Found, Incorrect Email or Password";
    }
}
?>
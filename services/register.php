<?php

// CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include './connect.php';

if (isset($_POST['signUp'])) {
    $username = $_POST['Username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

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
            header("location:../views/silver.html");
        } else {
            echo "ERROR: " . $conn->error;
        }
    }
}

if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $sql->bind_param("ss", $email, $password);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        header("location:../views/silver.html");
        exit();
    } else {
        echo "Not Found, Incorrect Email or Password";
    }
}
?>
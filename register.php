<?php

include 'connect.php';

if(isset($_POST['signUp'])){
    $username=$_POST['Username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

    $checkEmail="Select * From users where email='$email'";
    $result=$conn->query($checkEmail);
    if($result->num_rows>0){
        echo "Email Address Already Exists!";   
    }
    else{
        $insertQuery="INSERT INTO users(username,email,password)
        VALUES('$username','$email','$password')";

        if($conn->query($insertQuery)==TRUE){
            header("location:silver.php");
        }
        else{
            echo "ERROR: ".$conn->error;
        }
    }
}

if(isset($_POST['signIn'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

    $sql="SELECT * FROM users WHERE email='$email' and password='$password'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
        session_start();
        $row=$result->fetch_assoc();
        $_SESSION['email']=$row['email'];
        header("location:silver.php");
        exit();
    }
    else{
        echo "Not Found, Incorrect Email or Password";
    }
}
?>
<?php
session_start();
require 'connect.php';
require 'validation.php';

$username = "";
$password = "";
$message = "";

// Get the user submitted information
$username = test_input($_POST["username"]);
$password = test_input($_POST["password"]);

// Connect to the database
$connection = connect();

//SQL to find the user
$sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";

//Execute query and get the result
$result = mysqli_query($connection, $sql);

//Get the first row of the result as an array
$row = mysqli_fetch_array($result);

//check to see if email is entered, doesn't contain any malicious content ie only full stops, underscores, letters or numbers and the user exists
if(empty($username)) {
    $message = "Please go back and enter username";
}
elseif(empty($password)) {
    $message = "Please go back and enter password";
}
elseif (!preg_match('/[A_Za-z0-9_]/', $username)) {
    $message = "Username can only contain underscore, letters or numbers, please go back and try again";
}
elseif (!preg_match('/[A_Za-z0-9]/', $password)) {
    $message = "Password can only contain letters or numbers, please go back and try again";
}
elseif (mysqli_num_rows($result) === 0) {
    $message = "Sorry, there is no matching username and password in our database, go back and try again!";
}
else {
    $_SESSION["username"]=$username;
    //go to next page
    header("Location:home.php");
    exit();
}

mysqli_free_result($result);
mysqli_close($connection);

//Display the message on the webpage
echo $message;


?>
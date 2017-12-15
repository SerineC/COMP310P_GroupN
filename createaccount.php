<?php

require 'connect.php';
require 'validation.php';

$message = "";

// Get the user submitted information
$email = test_input($_POST["email"]);
$firstname = test_input($_POST["firstname"]);
$lastname = test_input($_POST["lastname"]);
$newusername = test_input($_POST["newusername"]);
$newpassword = test_input($_POST["newpassword"]);
$checknewpassword = test_input($_POST["checknewpassword"]);

// Connect to the database
$connection = connect();

//SQL to find the user

$sql1 = "SELECT * FROM user WHERE username='$newusername'";
$sql2 = "SELECT * FROM user WHERE email='$email'";

//Execute query and get the result

$result1 = mysqli_query($connection, $sql1);
$result2 = mysqli_query($connection, $sql2);
//Get the first row of the result as an array
$row1 = mysqli_fetch_array($result1);
$row2 = mysqli_fetch_array($result2);

$dataIsValid = true;

//check to see if email is entered, doesn't contain any malicious content ie only full stops, underscores, letters or numbers and the user exists
if(empty($email)) {
    $message = "Please go back and enter Email";
    $dataIsValid = false;
}
elseif(empty($firstname)) {
    $message = "Please go back and enter your first name";
    $dataIsValid = false;
}
elseif(empty($lastname)) {
    $message = "Please go back and enter your last name";
    $dataIsValid = false;
}
elseif(empty($newusername)) {
    $message = "Please go back and enter username";
    $dataIsValid = false;
}
elseif(empty($newpassword)) {
    $message = "Please go back and enter password";
    $dataIsValid = false;
}
elseif(empty($checknewpassword)) {
    $message = "Please go back and confirm password";
    $dataIsValid = false;
}
elseif (!filter_var ($email, FILTER_VALIDATE_EMAIL)) {
    $message = "Invalid email address, please go back and try again";
    $dataIsValid = false;
}
elseif (!preg_match('/[A-Za-z]/', $firstname)) {
    $message = "First name can only contain letters, please go back and try again";
    $dataIsValid = false;
}
elseif (!preg_match('/[A-Za-z]/', $lastname)) {
    $message = "Last name can only contain letters, please go back and try again";
    $dataIsValid = false;
}
elseif (!preg_match('/[A-Za-z0-9_]/', $newusername)) {
    $message = "Username can only contain underscore, letters or numbers, please go back and try again";
    $dataIsValid = false;
}
elseif (!preg_match('/[A-Za-z0-9]/', $newpassword)) {
    $message = "Password can only contain letters or numbers, please go back and try again";
    $dataIsValid = false;
}
elseif ($newpassword != $checknewpassword) {
    $message = "The passwords do not match, please go back and try again";
    $dataIsValid = false;
}
elseif (mysqli_num_rows($result1) != 0) {
    $message = "Sorry, the username has already existed, go back and try again!";
    $dataIsValid = false;
}
elseif (mysqli_num_rows($result2) != 0) {
    $message = "Sorry, the email has already been used, go back and try again!";
    $dataIsValid = false;
}

if ($dataIsValid) {
$sql = "INSERT INTO user (first_name, last_name, email, username, password) "
        . "VALUES ('$firstname', '$lastname', '$email', '$newusername', '$newpassword')";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_array($result);
mysqli_free_result($result);
mysqli_close($connection);
header("Location:login.php");
exit();
}



//Display the message on the webpage
echo $message;


?>
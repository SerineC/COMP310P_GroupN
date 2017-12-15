<?php
session_start();
require 'connect.php';
require 'validation.php';

$message = "";

// Get the user submitted information
$eventname = test_input($_POST["eventname"]);
$price = test_input($_POST["price"]);
$date = test_input($_POST["date"]);
$time = test_input($_POST["time"]);
$category = test_input($_POST["category"]);
$theatre = test_input($_POST["theatre"]);
$ticketno = test_input($_POST["ticketno"]);
$salesstart = test_input($_POST["salesstart"]);
$salesend = test_input($_POST["salesend"]);
$description = test_input($_POST["description"]);
$performer = test_input($_POST["performer"]);

$username=$_SESSION["username"];
// Connect to the database
$connection = connect();

//SQL to find the user

$sql1 = "SELECT * FROM event WHERE event_name='$eventname'";
$sql2 = "SELECT user_id FROM user WHERE username='$username'";

//Execute query and get the result

$result1 = mysqli_query($connection, $sql1);
$result2 = mysqli_query($connection, $sql2);

//Get the first row of the result as an array
$row1 = mysqli_fetch_array($result1);
$row2 = mysqli_fetch_array($result2);
$user_id=$row2['user_id'];
$diff = strtotime($salesend) - strtotime($salesstart);
$diff1 = strtotime($date) - strtotime($salesend);
$diff2 = strtotime($salesstart) - strtotime(date("Y-m-d"));
$diff3 = strtotime($date) - strtotime(date("Y-m-d"));
$dataIsValid = true;

      

//check to see if inputs are entered, don't contain any malicious content ie only full stops, underscores, letters or numbers and the user exists
if(empty($eventname)) {
    $message = "Please go back and enter Event name";
    $dataIsValid = false;
}
elseif(empty($price)) {
    $message = "Please go back and enter price";
    $dataIsValid = false;
}
elseif(empty($date)) {
    $message = "Please go back and enter date of the event";
    $dataIsValid = false;
}
elseif(empty($time)) {
    $message = "Please go back and enter time of the event";
    $dataIsValid = false;
}
elseif(empty($category)) {
    $message = "Please go back and select a category";
    $dataIsValid = false;
}
elseif(empty($theatre)) {
    $message = "Please go back and enter the theatre of the event";
    $dataIsValid = false;
}
elseif(empty($ticketno)) {
    $message = "Please go back and enter the number of tickets of the event";
    $dataIsValid = false;
}
elseif(empty($salesstart)) {
    $message = "Please go back and enter the start date of sales of the event";
    $dataIsValid = false;
}
elseif(empty($salesend)) {
    $message = "Please go back and enter the end date of sales of the event";
    $dataIsValid = false;
}
elseif(empty($description)) {
    $message = "Please go back and enter the description of the event";
    $dataIsValid = false;
}
elseif(empty($performer)) {
    $message = "Please go back and enter the lead performer of the event";
    $dataIsValid = false;
}
elseif (!preg_match('/[A-Z]/', $performer)) {
    $message = "Lead Performer name can only contain CAPITAL letters, please go back and try again";
    $dataIsValid = false;
}
elseif($ticketno < 50){
    $message = "Sorry, the number of tickets should be at least 50, please go back and try again";
    $dataIsValid = false;
}
elseif($ticketno > 500){
    $message = "Sorry, the number of tickets should be more than 500, please go back and try again";
    $dataIsValid = false;
}
elseif($diff3 < 24*60*60){
    $message = "Sorry, the event date should not be a past date";
    $dataIsValid = false;
}
elseif($diff2 < 24*60*60){
    $message = "Sorry, the sales should start at least tomorrow";
    $dataIsValid = false;
}
elseif($diff1 < 2*24*60*60){
    $message = "Sorry, the sales should end at least 2 days before the date of the event";
    $dataIsValid = false;
}
elseif($diff < 5*24*60*60){
    $message = "Sorry, the sales period should last at least 5 days";
    $dataIsValid = false;
}
elseif (mysqli_num_rows($result1) != 0) {
    $message = "Sorry, the event has already existed, go back and try again!";
    $dataIsValid = false;
}
$sql5 = "SELECT performer_id FROM performer WHERE performer='$performer'";
$result5 = mysqli_query($connection, $sql5);
$row5 = mysqli_fetch_array($result5);


if ($dataIsValid) {
    if (mysqli_num_rows($result5) != 0) {
        $performer_id=$row5['performer_id'];
    }
    if (mysqli_num_rows($result5) == 0) {
        $sql6 = "INSERT INTO performer (performer) VALUES ('$performer')";
        $result6 = mysqli_query($connection, $sql6);
        $row6 = mysqli_fetch_array($result6);
        $sql7 = "SELECT performer_id FROM performer WHERE performer='$performer'";
        $result7 = mysqli_query($connection, $sql7);
        $row7 = mysqli_fetch_array($result7);
        $performer_id = $row7['performer_id'];
    }
    $sql = "INSERT INTO event (user_id, location_id, event_name, description, no_of_tickets, event_date, event_time, category_id, performer_id) "
    . "VALUES ('$user_id', '$theatre', '$eventname', '$description', '$ticketno', '$date', '$time', '$category', '$performer_id')";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result);
    mysqli_free_result($result);
    
    $sql4 = "SELECT event_id FROM event WHERE event_name='$eventname'";
    $result4 = mysqli_query($connection, $sql4);
    $row4 = mysqli_fetch_array($result4);
    $event_id=$row4['event_id'];
    $sql3 = "INSERT INTO sales (event_id, start_date, end_date, price) "
            . "VALUES ('$event_id', '$salesstart', '$salesend', '$price')";
    $result3 = mysqli_query($connection, $sql3);
    $row3 = mysqli_fetch_array($result3);
    mysqli_free_result($result3);
    mysqli_close($connection);
    header("Location:user_info.php");
    exit();
}



//Display the message on the webpage
echo $message;


?>
<?php
session_start();
require 'connect.php';
require 'validation.php';

$message = "";

// Get the user submitted information

$ticketpurchase = test_input($_POST["ticketpurchase"]);
$_SESSION["ticketpurchase"]=$ticketpurchase;


// Connect to the database
$connection = connect();

$user= $_SESSION["username"];
$event=$_SESSION["event"];

$sql1 = "SELECT event_id FROM event WHERE event_name='$event'";
$result1 = mysqli_query($connection, $sql1);
$row1 = mysqli_fetch_array($result1);
$event_id=$row1['event_id'];
$sql2 = "SELECT user_id FROM user WHERE username='$user'";
$result2 = mysqli_query($connection, $sql2);
$row2 = mysqli_fetch_array($result2);
$user_id=$row2['user_id'];

//SQL to find the user

$sql4 = "SELECT no_of_tickets FROM event WHERE event_name='$event'";
$sql5 = "SELECT COUNT(*)AS total_sales FROM tickets JOIN event ON event.event_id=tickets.event_id WHERE event.event_name='$event'";
//Execute query and get the result

$result4 = mysqli_query($connection, $sql4);
$result5 = mysqli_query($connection, $sql5);

//Get the first row of the result as an arr
$row4 = mysqli_fetch_assoc($result4);
$row5 = mysqli_fetch_assoc($result5);
$ticketleft=$row4['no_of_tickets'] - $row5['total_sales'];

        
$dataIsValid = true;

      

//check to see if email is entered, doesn't contain any malicious content ie only full stops, underscores, letters or numbers and the user exists
if(empty($ticketpurchase)) {
    $message = "Please go back and enter the number of tickets you want to purchase";
    $dataIsValid = false;
}
elseif($ticketleft<$ticketpurchase){
    $message = "Sorry, there is not enough tickets left, please enter a number that is smaller than the number of tickets left";
    $dataIsValid = false;
}


if ($dataIsValid) {
    $i=1;
    while ($i<=$ticketpurchase) {
        $sql="INSERT INTO tickets (user_id, event_id) VALUES ('$user_id', '$event_id')";
        $result = mysqli_query($connection, $sql)
        or die('Error making select users query');
        $i++;        
    }
    mysqli_close($connection);
    header("Location:purchase_summary.php");
    exit();
}




?>
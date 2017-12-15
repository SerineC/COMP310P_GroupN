<?php
 session_start();
 
 require 'connect.php';
 require 'validation.php';
            
            // Connect to the database
$connection = connect();

$feedback = test_input($_POST["feedback"]);
$rating = test_input($_POST["rating"]);

$user= $_SESSION["username"];
$event=$_SESSION["event"];

$sql4="SELECT event_id FROM event WHERE event_name='$event'";
$result4=mysqli_query($connection, $sql4);
$row4=mysqli_fetch_array($result4);
$event_id=$row4['event_id'];


$sql5="SELECT user_id FROM user WHERE username='$user'";
$result5=mysqli_query($connection, $sql5);
$row5=mysqli_fetch_array($result5);
$user_id=$row5['user_id'];

$sql2="SELECT * FROM feedback_rating WHERE user_id='$user_id' AND event_id='$event_id'";
$result2=mysqli_query($connection, $sql2);
$row2=mysqli_fetch_array($result2);

$dataIsValid = true;

if(empty($feedback)) {
    echo "Please go back and enter feedback";
    $dataIsValid = false;
}
elseif(empty($rating)) {
    echo "Please go back and enter rating";
    $dataIsValid = false;
}
elseif (mysqli_num_rows($result2) != 0) {
    echo "Sorry, you have already entered the feedback and rating for this event, please go back!";
    $dataIsValid = false;
}

if($dataIsValid){

$sql6= "INSERT INTO feedback_rating (user_id, event_id, feedback, rating ) "
        . "VALUES ('$user_id','$event_id','$feedback','$rating')";

$result6 = mysqli_query($connection, $sql6);
$row6 = mysqli_fetch_array($result6);
mysqli_free_result($result6);
mysqli_close($connection);
header("Location:home.php");
exit();
}




?>

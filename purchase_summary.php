<?php
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <script src="/assets/jquery.js"></script>
        <script src="https:ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Londrina+Shadow' rel='stylesheet' type='text/css'>
        <title>Bloomington Orchestra</title>
        <link rel="stylesheet" href="style.css">

    </head>
    
    <body>
        <header>
        <div id="myaccount">
        <br><img src="https://cdn140.picsart.com/245339439045212.png?r240x240" style="width:30px">
        <a href="user_info.php">My Account</a>
        </div>
            <h1>
                <br><a id="homebutton" href="home.php">Bloomington Orchestra</a></br><br>
            </h1>
        </header>
        
        <h2 class="subtitle">Purchase Summary</h2 >
        <p> Thank you for reserving tickets from Bloomington Orchestra, your reservation has been successfully gone through.</p>
                
        <?php
        $user= $_SESSION["username"];
        $event=$_SESSION["event"];
        $ticketpurchase=$_SESSION["ticketpurchase"];
        
        require 'connect.php';
        
        // Connect to the database
        $connection = connect();

        // To find user record
        $sql1 = "SELECT b.price FROM event a, sales b WHERE a.event_id=b.event_id AND event_name='$event'";
        $sql2 = "SELECT b.start_date FROM event a, sales b WHERE a.event_id=b.event_id AND event_name='$event'";
        $sql3 = "SELECT b.end_date FROM event a, sales b WHERE a.event_id=b.event_id AND event_name='$event'";
        $sql4 = "SELECT no_of_tickets FROM event WHERE event_name='$event'";
        $sql5 = "SELECT COUNT(*)AS total_sales FROM tickets JOIN event ON event.event_id=tickets.event_id WHERE event.event_name='$event'";
                    
        //Execute query and get the result
        $result1 = mysqli_query($connection, $sql1);
        $result2 = mysqli_query($connection, $sql2);
        $result3 = mysqli_query($connection, $sql3);
        $result4 = mysqli_query($connection, $sql4);
        $result5 = mysqli_query($connection, $sql5);
        
        $row1 = mysqli_fetch_assoc($result1);
        $row2 = mysqli_fetch_assoc($result2);
        $row3 = mysqli_fetch_assoc($result3);
        $row4 = mysqli_fetch_assoc($result4);
        $row5 = mysqli_fetch_assoc($result5);

        ?>
        
        <div id="infokey">
            <table>
                <tr>
                    <th>Orchestra Name : </th>
                    <td><?php echo $event; ?></td>
                </tr>
                <tr>
                    <th>Sales Date From : </th>
                    <td><?php echo $row2['start_date']; ?></td>
                </tr>
                <tr>
                    <th>Sales Date To : </th>
                    <td><?php echo $row3['end_date']; ?> </td>
                </tr>
                <tr>
                    <th>Tickets available: </th>
                    <td><?php echo $row4['no_of_tickets'] - $row5['total_sales']; ?></td>
                </tr>
                <tr>
                    <th>Price : </th>
                    <td>£<?php echo $row1['price']; ?> </td>
                </tr>
                <tr>
                    <th>Number of Tickets :</th>
                    <td><?php echo $ticketpurchase; ?></td>
                </tr>
                <tr>
                    <th>Total Price:</th>
                    <td>£<?php echo $ticketpurchase*$row1['price']; ?></td>
                </tr>
            </table>
            
        </div>
        
    </body>
    
</html>
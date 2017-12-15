<?php
session_start();
?>

<html>
    <head>
        <script src="/assets/jquery.js"></script>
        <script src="https:ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Londrina+Shadow' rel='stylesheet' type='text/css'>
        <title>Event</title>
        <link rel="stylesheet" href="tablestyle.css">
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
        
        <?php
        $event=$_POST['event'];
        $_SESSION['event']=$event;
        ?>
        <p class="subtitle"><?php echo $event?></p>
        <br><br>
<div id="table">        
<?php 
            require 'connect.php';
            
            // Connect to the database
            $connection = connect();

            // To find user record
            $sql = "SELECT b.address, b.theater_name, c.city, a.description, a.event_date, a.event_time, d.category, e.price FROM event a, location b, region c, category d, sales e WHERE a.location_id=b.location_id AND b.region_id=c.region_id AND a.category_id=d.category_id AND a.event_id=e.event_id AND a.event_name='$event'";
                    
            //Execute query and get the result
            $result = mysqli_query($connection, $sql);
                    
            //Create table of results
            
            echo '<table align="center">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><th>Event Date</th><td>".$row['event_date']."</td></tr><tr><th>Event Time</th><td>".$row['event_time']."</td></tr><tr><th>Category</th><td>".$row['category']."</td></tr><tr><th>Description</th><td>".$row['description']."</td></tr><tr><th>Theater Name</th><td>".$row['theater_name']."</td></tr><tr><th>Address</th><td>".$row['address']."</td></tr><tr><th>City</th><td>".$row['city']."</td></tr><tr><th>Price</th><td>".$row['price']."</td></tr>";
            }
            echo '</table>';
                    
            //Close mySQL connection
            mysqli_free_result($result);                                     
            ?>
        </div>
        <?php
                $sql1 = "SELECT no_of_tickets FROM event WHERE event_name='$event'";
                
                $result1 = mysqli_query($connection, $sql1);
                
                $row1 = mysqli_fetch_assoc($result1);
                
                $sql2 = "SELECT COUNT(*)AS total_sales FROM tickets JOIN event ON event.event_id=tickets.event_id WHERE event.event_name='$event'";
                
                $result2 = mysqli_query($connection, $sql2);
                
                $row2 = mysqli_fetch_assoc($result2);
                
                ?>
        
        <?php $sql3= "SELECT start_date, end_date FROM sales JOIN event ON event.event_id=sales.event_id WHERE event_name='$event'";  
              $result3= mysqli_query($connection, $sql3);
              $row3=mysqli_fetch_array($result3);
              $difference1 = strtotime($row3['start_date']) - strtotime(date("Y-m-d H:i:s"));
              $difference2= strtotime($row3['end_date']) - strtotime(date("Y-m-d H:i:s"));
              
           
        ?>

        <p3>
            <?php if ($row1['no_of_tickets']-$row2['total_sales']==0){
            echo 'Sorry there are no tickets remaining'; 
        }
        else if ($difference1 >= 0){
            echo 'Sorry these tickets are not on sale yet';
        }
        else if ($difference2 <= 0){
            echo 'Sorry the end sales date has passed, so you cannot buy tickets';
            
        }
        else {
        ?>
        </p3>
        
                <p>Tickets Remaining : </p><p><?php echo $row1['no_of_tickets']-$row2['total_sales'];?></p>
                <form action="reserve_ticket.php" method="post">
            <button type='submit' align="center" id="reserve" name="reserve">Reserve</button>
    </form>
                <br><br><br><br><br><br>
              <?php
        }
            
            mysqli_free_result($result); 

            ?>
                <br>
                <p> Rating & Feedback </p>
        <?php 
        $sqldate="SELECT event_date FROM event WHERE event_name='$event'";
        $resultsqldate=mysqli_query($connection, $sqldate);
        $rowsqldate =mysqli_fetch_array($resultsqldate);
        $difference3= strtotime($rowsqldate['event_date'])- strtotime(date("Y-m-d H:i:s"));
        ?>
         <p3><?php if ($difference3 > 0){
             
             echo '(Sorry there is no add feedback section until the event has happened)';
             
          }
         else {
              ?></p3>
            
         
                <form id="ratingandfeedback" method="post" action="feedback.php">
                    <table align="center">
                
       <tr>
                <th> Rating between 1 & 5 : </th>
                <td> <input type="number" class="numberinput" name="rating" placeholder="Enter Rating (1-5)" min="1" max="5" size="60"> </td>
       </tr>
        <tr>
                <th> Feedback : </th>
                <td> <input type="text" name="feedback" placeholder="Enter Feedback" size="60"></td>
            </tr>
                    </table>
                    <button id="smallbutton" type='submit'>Add Rating and Feedback</button>
            </form>
         
         <?php
  
         }
         mysqli_free_result($resultsqldate)
         ?>
         
         
            
         
                
                
    <br><br> <br><br>
                <div id="table">
                    <?php
                $sqlrating="SELECT rating, feedback, username FROM feedback_rating JOIN event ON event.event_id=feedback_rating.event_id JOIN user ON user.user_id=feedback_rating.user_id WHERE event.event_name='$event'";
                $resultrating=mysqli_query($connection, $sqlrating);
                 echo '<table>';
                while ($row=mysqli_fetch_assoc($resultrating)){ 
                echo "<tr><th>Username</th><td>".$row['username']."</td></tr><tr><th>Rating</th><td>".$row['rating']."</td></tr><tr><th>Feedback</th><td>".$row['feedback']."</td></tr>";
                }
                echo '</table>';
               
                mysqli_free_result($resultrating);
                ?>
                </div>

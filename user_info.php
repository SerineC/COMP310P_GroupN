<?php
session_start();
?>

<html>
    <head>
        <script src="/assets/jquery.js"></script>
        <script src="https:ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Londrina+Shadow' rel='stylesheet' type='text/css'>
        <title>User Info</title>
        <link rel="stylesheet" href="tablestyle.css">
    </head>
    
    <body>
        <header>
            <h1>
                <br><a id="homebutton" href="home.php">Bloomington Orchestra</a></br><br>
            </h1>
        </header>
        <p><img src="https://cdn140.picsart.com/245339439045212.png?r240x240" style="width:150px"></p>
            <p class="subtitle">Personal Info</p>
            <div id="table">
                
            <?php 
            require 'connect.php';
                    
            //Get user ID
            $username = $_SESSION["username"];

            // Connect to the database
            $connection = connect();

            // To find user record
            $sql = "SELECT first_name, last_name, username, email FROM user WHERE username = '$username'";
                    
            //Execute query and get the result
            $result = mysqli_query($connection, $sql);
                    
            //Create table of results
            echo '<table align="center">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><th>First name</th><td>".$row['first_name']."</td></tr><tr><th>Last name</th><td>".$row['last_name']."</td></tr><tr><th>Username</th><td>".$row['username']."</td></tr><tr><th>Email</th><td>".$row['email']."</td></tr>";
            }
            echo '</table>';
                    
            //Close mySQL connection
            mysqli_free_result($result);                                     
            ?>
                
            </div>
            
            
            <br><br><p class="subtitle">Events Hosting</p>
            <div id="table">
            
            <?php 
               
            //Get user ID
            $username = $_SESSION["username"];

            // Connect to the database
            $connection = connect();

            // To find user record
            $sql = "SELECT a.event_name, a.event_date, b.address FROM event a, location b, user c WHERE a.location_id=b.location_id and a.user_id=c.user_id and c.username = '$username'";
                    
            //Execute query and get the result
            $result = mysqli_query($connection, $sql);
                    
            //Create table of results
            echo '<table align="center">';
            echo "<tr>
                    <th>Events Name</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th> </th>
                </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $eventname=$row['event_name'];
                echo "<tr>
                <td>".$row['event_name']."</td>
                <td>".$row['event_date']."</td>
                <td>".$row['address']."</td><td>"?>
                <form action="hosting_event.php" method="post">
                    <input type="submit" value="<?php echo $eventname ?>" name="hostingevent">
                </form>
                
                <?php "</td></tr>";
            }
            echo '</table>';
                    
            //Close mySQL connection
            mysqli_free_result($result);                                     
            ?>            
            
            </div>
    
            <br><p class="subtitle">Events Attending</p>   
                        <br>
                                                <div>
                            <p3><?php
$sqldate="SELECT event_date FROM event WHERE event_name='$event'";
        $resultsqldate=mysqli_query($connection, $sqldate);
        $rowsqldate =mysqli_fetch_array($resultsqldate);
        $difference3= strtotime($rowsqldate['event_date'])- strtotime(date("Y-m-d H:i:s"));
$sqlemail="SELECT email FROM user WHERE username='$username'";
$resultemail = mysqli_query($connection,$sqlemail);
$rowsqlemail=mysqli_fetch_array($resultemail);

        if ($difference3 <= 24*60*60 AND $difference3 >= 0){
            echo 'An email has been sent to' .$rowsqlemail['email'].' to warn you of the upcoming event :'. $event;
        }
        else {
            echo '(You have no upcoming events within the next day)';
        
        }
        ?></p3>
                            </div>
                        <div id="table">
                <?php 
               
            //Get user ID
            $username = $_SESSION["username"];

            // Connect to the database
            $connection = connect();

            // To find user record
            $sql = "SELECT DISTINCT (a.event_name), a.event_date, b.address FROM event a, location b, user c, tickets d WHERE a.location_id=b.location_id and d.user_id=c.user_id and a.event_id=d.event_id and c.username = '$username'";
                    
            //Execute query and get the result
            $result = mysqli_query($connection, $sql);
            
            //Create table of results
            echo '<table align="center">';
            echo "<tr>
                    <th>Events Name</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th> </th>
                </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $event=$row['event_name'];
                echo "<tr>
                <td>".$row['event_name']."</td>
                <td>".$row['event_date']."</td>
                <td>".$row['address']."</td><td>"?>
                <form action="event.php" method="post">
                    <input type="submit" value="<?php echo $event ?>" name="event">
                </form>        
                
                <?php "</td></tr>";
            }
            echo '</table>';
                    
            //Close mySQL connection
            mysqli_free_result($result);                                     
            ?>
                        </div>

    </body>
    
</html>
<html>
    <head>
        <script src="/assets/jquery.js"></script>
        <script src="https:ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Londrina+Shadow' rel='stylesheet' type='text/css'>
        <title>Hosting Event</title>
        <link rel="stylesheet" href="tablestyle.css">


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
        $hostingevent=$_POST['hostingevent'];
        ?>
        
            <p class="subtitle"><?php echo $hostingevent ?></p>
            <div id="table">
                
            <?php 
            require 'connect.php';
            
            // Connect to the database
            $connection = connect();

            // To find user record
            $sql = "SELECT b.address, b.theater_name, c.city, a.description, a.event_date, a.event_time, d.category, e.price FROM event a, location b, region c, category d, sales e WHERE a.location_id=b.location_id AND b.region_id=c.region_id AND a.category_id=d.category_id AND a.event_id=e.event_id AND a.event_name='$hostingevent'";
                    
            //Execute query and get the result
            $result = mysqli_query($connection, $sql);
                    
            //Create table of results
            echo '<table>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><th>Event Date</th><td>".$row['event_date']."</td></tr><tr><th>Event Time</th><td>".$row['event_time']."</td></tr><tr><th>Category</th><td>".$row['category']."</td></tr><tr><th>Description</th><td>".$row['description']."</td></tr><tr><th>Theater Name</th><td>".$row['theater_name']."</td></tr><tr><th>Address</th><td>".$row['address']."</td></tr><tr><th>City</th><td>".$row['city']."</td></tr><tr><th>Price</th><td>".$row['price']."</td></tr>";
            }
            echo '</table>';
                    
            //Close mySQL connection
            mysqli_free_result($result);                                     
            ?>

            </div>
            
            
            <br><br><p class="subtitle">Ticket Sales</p>
            <div id="table">
            
            <?php
                $sql1 = "SELECT no_of_tickets FROM event WHERE event_name='$hostingevent'";
                
                $result1 = mysqli_query($connection, $sql1);
                
                $row1 = mysqli_fetch_assoc($result1);
                
                $no1 = $row1['no_of_tickets'];
                
                $sql2 = "SELECT COUNT(*)AS total_sales FROM tickets JOIN event ON event.event_id=tickets.event_id WHERE event.event_name='$hostingevent'";
                
                $result2 = mysqli_query($connection, $sql2);
                
                $row2 = mysqli_fetch_assoc($result2);
                
                $no2 = $row2['total_sales'];
                
                $no3 = $no1 - $no2;
                
                echo '<table align="center">';

                echo "<tr><th>Total number of ticket</th><td>".$row1['no_of_tickets']."</td></tr><tr><th>Tickets Saled</th><td>".$row2['total_sales']."</td></tr><tr><th>Tickets Remaining</th><td>".$no3."</td></tr>";
            
                echo '</table>';
            
            mysqli_free_result($result); 

            ?>
            </div> 
            <br><div id="table">
                <?php 
              
            // Connect to the database
            $connection = connect();

            // To find user record
            $sql = "SELECT DISTINCT b.user_id, b.first_name, b.last_name, b.email FROM tickets a, user b, event c WHERE a.user_id=b.user_id AND a.event_id=c.event_id AND c.event_name='$hostingevent'";
            $result = mysqli_query($connection, $sql);
            
                    
            //Create table of results
            echo '<table align="center">';
            echo "<tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>User ID</th>
                    <th>Email</th>
                    <th>Number of Tickets</th>
                </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $user_id =$row['user_id'];
            $sql1= "SELECT COUNT(*) AS tickets_bought FROM tickets JOIN event ON event.event_id=tickets.event_id WHERE event_name='$hostingevent' AND tickets.user_id='$user_id'";
            $result1 = mysqli_query($connection, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
                echo "<tr>
                <td>".$row['first_name']."</td>
                <td>".$row['last_name']."</td>
                <td>".$row['user_id']."</td>
                <td>".$row['email']."</td>
                <td>".$row1['tickets_bought']."</td></tr>";
            }
            echo '</table>';
                    
            //Close mySQL connection
            mysqli_free_result($result);                                     
            ?>
            </div>
    </body>
    
</html>

<html>
    <head>
        <script src="/assets/jquery.js"></script>
        <script src="https:ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Londrina+Shadow' rel='stylesheet' type='text/css'>
        <title>Create Event</title>
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

            <h2> Create Events </h2>
            <div id="info">
                <form id="create" method="post" action="createevent.php">
                    <table align="center">
            <tr>
                <td>Event name:</td>
                <td> <input type="text" name="eventname" placeholder="Enter the name of the event" size="60"></td>
            </tr>
           <tr>
                <td>Price (&pound;): </td>
                <td> <input type="number" name="price" placeholder="Enter Price Per Ticket" min="0" size="60"></td>
            </tr>
            <tr>
                <td>Date: </td>
                <td> <input type="date" name="date" placeholder="Enter Date of Event" size="60"></td>
            </tr>
            <tr>
                <td>Time: </td>
                <td> <input type="time" name="time" placeholder="Enter Time" size="60"></td>
            </tr>
            <tr>
                <td> Category: </td>
                <td> 
                    <select name='category' style="width:820px">
                    <option value=''>---Select---</option>
                     <?php
                    require 'connect.php';
                    $connection= connect();
                    mysqli_select_db($connection,"event");
                    $select="event";
                    
                    if(isset($select) && $select!=""){
                    $select= filter_input(INPUT_POST, 'category');
                  
                    }
                    
                    ?>
                    <?php
                    $list=mysqli_query($connection,"select*from category");
                    while ($row_list = mysqli_fetch_assoc($list)) {
                        ?>
                        <option value="<?php echo $row_list['category_id'];?>"
                                <?php if ($row_list['category_id']==$select){echo "selected";}?>>
                        <?php echo $row_list['category'];?> 
                            
                        </option>              
                     <?php 
                    }
                    ?>                    
                     </select>
                    </form>   
            </td>
            </tr>
  
            
                <td> Theatre: </td>
                <td> 
                
                 <select name="theatre" style="width:820px">
                     <option value=''>---Select---</option>
                        
                        
                     <?php

                    
                    mysqli_select_db($connection,"event");
                    $select="event";
                    if(isset($select) && $select!=""){
                    $select= filter_input(INPUT_POST, 'theater_name');
                  
                    }
                    ?>
                    <?php
                    $list=mysqli_query($connection,"select*from location");
                    while ($row_list = mysqli_fetch_assoc($list)) {
                        ?>
                        <option value="<?php echo $row_list['location_id'];?>"
                                <?php if ($row_list['location_id']==$select){echo "selected";}?>>
                        <?php echo $row_list['theater_name'];?>
                            
                        </option>              
                     <?php 
                    }
                    ?>                    
                     </select>
                    </td>
                    </tr>

            <tr>
                <td> Number of tickets: </td>
                <td> <input class="numberinput" type="number" name="ticketno" placeholder="Enter Total Number of Tickets (50-500)" min="50" max="500" size="60"> </td>
            </tr>
            <tr>
                <td> Sales start date: </td>
                <td> <input type="date" name="salesstart" style="width:820px"> </td>
            </tr>            
           
            
            <tr>
                <td> Sales end date: </td>
                <td> <input type="date" name="salesend" style="width:820px"></td>
            </tr>
             <tr>
                <td> Description: </td>
                <td> <input type="text" name="description" placeholder="Enter Description" size="60"></td>
            </tr>
             <tr>
                <td> Lead performer: </td>
                <td> <input type="text" name="performer" placeholder="Enter Lead Performer name in CAPITAL LETTERS" size="60"></td>           
            </tr>

        </table>
            <button type='submit'>Create New Event</button>
                </form>

            </div>
      
         
    </body>
    
</html>




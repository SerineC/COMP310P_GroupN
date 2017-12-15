
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
        
        <h2>Search orchestra which match any criteria</h2>
        <form id="info" method="POST" action="advancesearch3.php" name="form" class="centre">
        <table align="center">
            <tr>
                <th>Orchestra Name: </th>
                <td> <input type="text" name="eventname"></td>
            </tr>
            <tr>
                <th>Performer Name: </th>
                <td> <input type="text" name="performername"></td>
            </tr>
            <tr>
                <th> Category: </th>
                <td> 
                    
                        <select name='category'>
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
                  
                </td>
            
            </tr>
            
            <tr>
                <th> Location: </th>
                <td> 
                
                        <select name='theatrename'>
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
               <th> Region: </th>
                <td> 
                
                        <select name='city' >
                        <option value=''>---Select---</option>
                    <?php
                    
                    mysqli_select_db($connection,"event");
                    $select="event";
                    
                    if(isset($select) && $select!=""){
                    $select= filter_input(INPUT_POST, 'city');
                  
                    }
                    ?>
                    <?php
                    $list=mysqli_query($connection,"select*from region");
                    while ($row_list = mysqli_fetch_assoc($list)) {
                        ?>
                        <option value="<?php echo $row_list['region_id'];?>"
                                <?php if ($row_list['region_id']==$select){echo "selected";}?>>
                        <?php echo $row_list['city'];?>
                            
                        </option>              
                     <?php 
                    }
                    ?>                    
                     </select>
                     
                </td>
            
            </tr>
          <tr>
                <th> Search Date From : </th>
                <td> <input type="date" name="startDate"> </td>
            </tr>
            <tr>
                <th> To : </th>
                <td> <input type="date" name="endDate"> </td>
            </tr>

        </table>
            <button type='submit'>Search</button>
        </form>
        
       
        
       

    </body>
    
</html>
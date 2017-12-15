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
<h2> Orchestra that match your search! </h2>
   


<br></br>
<?php
require 'connect.php';
require 'validation.php';

$eventname = $performername = $category = $theatrename = $city = $enddate = $startdate = '';

$eventname=$_POST["eventname"];
$performername=$_POST["performername"];
$category= $_POST["category"]; 
$theatrename=$_POST["theatrename"];
$city=$_POST["city"];
$enddate=$_POST["endDate"];
$startdate=$_POST["startDate"];



$connection = connect(); 


$sql="SELECT DISTINCT event.event_id, event_name, event_date, category, theater_name, city  FROM event JOIN performer ON performer.performer_id=event.performer_id JOIN category ON category.category_id=event.category_id JOIN location ON location.location_id=event.location_id JOIN region ON region.region_id=location.region_id  WHERE ";
if (!empty($startdate)&&empty($enddate)){
    echo 'Please enter both start date and end date';
}
if (!empty($enddate)&&empty($startdate)){
    echo 'Please enter both start date and end date';
}
else {
//If orchestra name is filled
                if (!empty($eventname)){
                    $sql .="event_name LIKE '%" . $eventname .  "%' AND ";
                }
                if (!empty($performername)){
                    $sql .="performer LIKE '%" . $performername .  "%' AND ";
                }
                //If category is filled and shows results for all category's selected
                if (!empty($category)) {
                        
                        $sql .="category.category_id =" . $category.' OR ';
                    
                    //Remove OR and add AND to fit with the other variables
                    $sql = substr($sql, 0, strlen($sql)-4);
                    $sql .= " AND ";
                }
                //If location is filled and shows results for all locations selected
                if (!empty($theatrename)) {
                    
                        $sql .="location.location_id =" .$theatrename.' OR ';
  
                    //Remove OR and add AND to fit with the other variables
                    $sql = substr($sql, 0, strlen($sql)-4);
                    $sql .= " AND ";
                }
                //If region is filled and shows results for all regions selected
                if (!empty($city)) {
                   
                        $sql .="region.region_id =" . $city.' OR ';
                    
                    //Remove OR and add AND to fit with the other variables
                    $sql = substr($sql, 0, strlen($sql)-4);
                    $sql .= " AND ";
                }
                //If start date is entered by itself, and if combined with an end date
                if (!empty($startdate)) {
                    if (!empty($enddate)) {
                        $sql .= "(event_date BETWEEN '".$startdate."' AND '".$enddate."') AND ";
                    }
                }
                
                $sql = substr($sql, 0, strlen($sql)-5);

$result = mysqli_query($connection, $sql);
?>
<br>
<div>
<?php
    if (mysqli_num_rows($result) == 0){
    echo "Sorry, there are no search results, go back and try again!";
}


else{
    echo '<table id="table">';
            echo "<tr>
                    <th>Orchestra Name</th>
                    <th>Orchestra Date</th>
                    <th>Category</th>
                    <th>Theater Name</th>
                    <th>City</th>
                </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $event=$row['event_name'];
                echo "<tr>
                <td>".$row['event_name']."</td>
                <td>".$row['event_date']."</td>
                <td>".$row['category']."</td>
                <td>".$row['theater_name']."</td>
                <td>".$row['city']."</td><td>"?>
                    <form action="event.php" method="post">
                        <input type="submit" value="<?php echo $event ?>" name="event">
                    </form>        
                
                <?php "</td></tr>";
            }
            echo '</table>';
            
}
}
     
           mysqli_free_result($result);  

           
          
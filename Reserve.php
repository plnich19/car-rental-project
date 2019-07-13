//Reserve page
<?php
include('connect.php'); //ตรงนี้คือบอกว่าเราจะ include mysqli ที่เป็น connection มาจากไฟล์ไหน
if ($mysqli->connect_errno) {
 echo $mysqli->connect_errno ." : ". $mysqli->connect_error;
}

if(isset($_GET['id'])) {
    $id=$_GET['id'];

?>

<!DOCTYPE html>
<html>
<head>
<title>Reservation</title>
<link rel="stylesheet" href="reserve.css">
</head>

<body>
<header>
                    <span class="menu">
                        <table  align="center" height="100"> 
                        <td class="btn" width="200px" id="main"><a href="index.php">Main</td>
                        <td class="btn" width="200px" id="car"><a href="car.php">Our Car</td>
                            <td class="btn" width="200px" id="res"><a href="howtoreserve.php">Reservation</td>
                            <td class="btn" width="200px" id="care"><a href="cuscare.php">Customer Care</td>
                            <td class="btn" width="200px" id="pro"><a href="promo.php">Promotion</td>
                            <td class="btn" width="200px" id="brm"><a href="Map.php">Our Branches</td>
                            <td class="btn" width="200px" id="helpm"><a href="help.php">Help</td>
                            </tr>
                        </table>
                    </span>
</header>
<br>
<!-- <span class="sub">Register to receive our newsletter<br><input type="email" name="email" placeholder="fill in your email"><button type="submit" name="submit">Submit</button></span>         -->
        <br>
        <br>
        <main>
		<div id="div_content" class="form">

                <?php
                    $q = "select *,streetNAME from car c, location l WHERE carID='$id' and c.rentallocationID=l.rentallocationID ; ";
				    if ($res = $mysqli->query($q)) 
				    {
					    while($ro = $res->fetch_array())
					    {
                        //var_dump($ro);
                ?>
                <form action="Reserve2.php" method="POST">
                <h2>Reservation</h2>
                <span><label>Your reserve car information</label><br>
                Car ID: <?php echo $id ?><br>
                Brand: <?php echo $ro['carNAME']; ?><br>
                Model: <?php echo $ro['model']; ?><br>
                Type: <?php echo $ro['carTYPE']; ?><br>
                Car price/day: <?php echo $ro['price']; ?><br>
                Pick up location: <?php echo $ro['streetNAME']; ?><br><br>
                <!-- <div id="resform"> -->
                <table width="100%" border="0">
                <div class="testnow">
                    <tr><td colspan="6" class="testnow"><label>Please fill in your information</label></td></tr>
                    <tr>
                        <td class="testnow"><label>First name : </label></td>
                        <td class="testnow"><input type="text" name="fname" required></td>
                        <td class="testnow"><label>Last name : </label></td>
                        <td class="testnow"><input type="text" name="lname" required></td>
                    <td class="testnow"><label>License no. : </label></td>
                        <td class="testnow"><input type="text" name="licenseno" required></td>
                    </tr>
                    <tr>
                    <td class="testnow"><label>ID card no. : </label></td>
                    <td class="testnow"><input type="text" name="idno" required><br></td>
                    <td class="testnow"><label>Phone no. : </label></td>
                    <td class="testnow"><input type="text" name="phoneno"><br></td>
                    <td class="testnow"><label>Email : </label></td>
                    <td class="testnow"><input type="text" name="email"><br></td>
                    </tr>
                <tr>
                <td class="testnow"><label>Current Address : </label></td>
                <td class="testnow"><input type="text" name="address"><br></td>
                <!-- <td class="testnow"><label>Promotion Code (if no type 0) : </label></td>
                <td class="testnow"><input type="text" name="promocode"><br></td> -->
                                  
                <td class="testnow"><label>Pickup Date : </label></td>
                <td class="testnow"><input type="date" name="pickdate" required><br></td>

                <td class="testnow"><label>Return Date : </label></td>
                <td class="testnow"><input type="date" name="retdate" required><br></td>
                </tr>
                        </div>
</table>
                <input type="hidden" name="carid" value= <?php echo $id?>>
                <input type="hidden" name="carname" value= <?php echo $ro['carNAME'];?>>
                <input type="hidden" name="carmodel" value= <?php echo $ro['model'];?>>
                <input type="hidden" name="cartype" value= <?php echo $ro['carTYPE'];?>>
                <input type="hidden" name="carins" value= <?php echo $ro['insuranceTYPE'];?>>
                <input type="hidden" name="carprice" value= <?php echo $ro['price'];?>>
                <input type="hidden" name="picklo" value= <?php echo $ro['rentallocationID'];?>>
				<div class="center">
                <input id="resbutton" type="submit" name="next" value="Next">
				<!-- </div> -->
                <?php
                        
                        }
                    }
                }
                ?>
        </div>
          
    </div>
</main>
    <footer>
    <div class="footer">
        <p id="f">© Car Rental ©</p>
        <p id ="addr">Address 56/1 Street</p>
        <!-- <img id="face"src="bloggif_5bb8bc2d97d96.png" width=50px height=50px><img id="twit"src=bloggif_5bb8bd9be8059.png width="50" height="50"> -->
</footer>
<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
  <script src="js111.js"></script>
</body>
</html>

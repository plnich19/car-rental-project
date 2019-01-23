//do functions on admin page

<?php
include('connect.php'); 
if ($mysqli->connect_errno) {
 echo $mysqli->connect_errno ." : ". $mysqli->connect_error;
}
if(isset($_POST['addcar'])) {
  $carCODE= $_POST["carcode"];
  $carName = $_POST["carname"];
  $carModel = $_POST["carmodel"];
  $carPic = $_POST["carpic"];
  $carType = $_POST["cartype"];
  $carSeat = $_POST["carseat"];
  $carPrice = $_POST["carprice"];
  $carYear = $_POST["caryear"];
  $carColor = $_POST["carcolor"];
  $carInsurance = $_POST["carinsurance"];
  $carLocation= $_POST["carlocation"];
  
  
  $q="INSERT INTO car (carCODE,carNAME,model,picture,carTYPE,seatCAP,price,status,year,color,insuranceTYPE,rentallocationID) 
  VALUES ('$carCODE','$carName','$carModel','$carPic','$carType','$carSeat','$carPrice','available','$carYear','$carColor','$carInsurance','$carLocation')";
  $result=$mysqli->query($q);
  if(!$result){
    echo "INSERT failed. Error: ".$mysqli->error ;
  }
}

if(isset($_POST['addpro'])) {
  $proDescription = $_POST["protitle"];
  $proType = $_POST["protype"];
  $proDiscount = $_POST["prodiscount"];
  $proPic = $_POST["propic"];
  
  
  $q2="INSERT INTO promotion (description,promotionTYPE,discount,status,propic) 
  VALUES ('$proDescription','$proType','$proDiscount','available','$proPic')";
  $result2=$mysqli->query($q2);
  if(!$result2){
    echo "INSERT failed. Error: ".$mysqli->error ;
  }
}

if(isset($_POST['addlo'])) {
  $loName = $_POST["loname"];
  $loPhone = $_POST["lophone"];
  $loStreet = $_POST["lostreet"];
  $loDistrict = $_POST["lodistrict"];
  $loEmail = $_POST["loemail"];
  $loZip = $_POST["lozip"];
  $loPic = $_POST["lopic"];
  
  
  $q3="INSERT INTO location (phone,streetNAME,district,email,Zip,lopic) 
  VALUES ('$loPhone','$loStreet','$loDistrict','$loEmail','$loZip','$loPic')";
  $result3=$mysqli->query($q3);
  if(!$result3){
    echo "INSERT failed. Error: ".$mysqli->error ;
  }
}

if(isset($_POST['addad'])) {
  $adfName = $_POST["fname"];
  $adlName = $_POST["lname"];
  $adPhone = $_POST["adphone"];
  $adEmail = $_POST["ademail"];
  $adGender = $_POST["gender"];
  $adSalary = $_POST["adsalary"];
  $adUsername=$_POST["username"];
  $adPassword=$_POST["password"];
  
  
  $q9="INSERT INTO admin (fname,lname,email,telNO,gender,salary,username,password) 
  VALUES ('$adfName','$adlName','$adEmail','$adPhone','$adGender','$adSalary','$adUsername','$adPassword')";
  $result9=$mysqli->query($q9);
  if(!$result9){
    echo "INSERT failed. Error: ".$mysqli->error ;
  }
}


if(isset($_POST['updatecar'])) {
  $rentalID = $_POST["checkrentid"];
  $actualEnd = $_POST["actualend"];
  // $customerID = $_POST["checkcusid"];
  $customerLicense = $_POST["checkcuslicense"];
  $dateTO = $_POST["dateto"];
  
  $q4 = " UPDATE reservations 
        SET status = 'returned', actualendDATA= '$actualEnd'
        WHERE reserveID = '$rentalID' AND licenseNO = '$customerLicense'";
  $result4=$mysqli->query($q4);
  if(!$result4){
    echo "UPDATE failed. Error: ".$mysqli->error ;
  }

  $q5 = " UPDATE car 
        SET status = 'available'
        WHERE (SELECT carID from reservations WHERE reserveID = '$rentalID' AND licenseNO = '$customerLicense') ";

  $result5=$mysqli->query($q5);
  if(!$result5){
    echo "UPDATE failed. Error: ".$mysqli->error ;
  }
        

 $date1=strtotime($dateTO);
 $date2=strtotime($actualEnd);

 if($date2>$date1){
  $q7 = "select rentalAMO, insuranceAMO from reservations where reserveID='$rentalID' AND licenseNO='$customerLicense'; ";
  if ($res7 = $mysqli->query($q7)) 
  {
    while($ro7 = $res7->fetch_array())
    {
      //var_dump($ro7);
    
    $date11=idate("z",$date1);
    $date22=idate("z",$date2);
    $diff=$date22-$date11;
     $penalty=$diff*1000;
     $totalam=$ro7['rentalAMO']+$ro7['insuranceAMO']+$penalty;
     //echo $ro7['insamo'];
     $q6="UPDATE reservations SET  
 		penalty = '".$penalty."', totalAMO='".$totalam."'
     WHERE reserveID = '".$rentalID."' AND licenseNO= '".$customerLicense."'";
  $result6=$mysqli->query($q6);
    if(!$result6){
      echo "UPDATE failed. Error: ".$mysqli->error ;
   }
  else{}
  }
}
}
}

if(isset($_POST['updatepro'])) {
  $promotionCode = $_POST["procode"];
  $proStatus = $_POST["prostatus"];
  $proDescription = $_POST["prodescription"];
  
  $q6 = " UPDATE promotion 
        SET status = '$proStatus', description='$proDescription'
        WHERE promotionCODE = '$promotionCode'";
  $result6=$mysqli->query($q6);
  if(!$result6){
    echo "UPDATE failed. Error: ".$mysqli->error ;
  }
}

  if (isset($_GET['delcarID']) && strlen($_GET['delcarID']) > 0)
  {
	  $q7 = "DELETE FROM car WHERE carID=" . $_GET['delcarID'];
	  if (!$mysqli->query($q7))
	  {
		  echo "ERROR DELETE FAIL!!!";
	  }	
	//echo "XX";
}

if (isset($_GET['delproCode']) && strlen($_GET['delproCode']) > 0)
  {
	  $q8 = "DELETE FROM promotion WHERE promotionCODE=" . $_GET['delproCode'];
	  if (!$mysqli->query($q8))
	  {
		  echo "ERROR DELETE FAIL!!!";
	  }	
	//echo "XX";
}

if (isset($_GET['delloid']) && strlen($_GET['delloid']) > 0)
  {
	  $q9 = "DELETE FROM location WHERE rentallocationID=" . $_GET['delloid'];
	  if (!$mysqli->query($q9))
	  {
		  echo "DELETE failed. Error: ".$mysqli->error;
	  }	
	//echo "XX";
}

if (isset($_GET['deladid']) && strlen($_GET['deladid']) > 0)
  {
	  $q10 = "DELETE FROM admin WHERE adminID=" . $_GET['deladid'];
	  if (!$mysqli->query($q10))
	  {
		  echo "ERROR DELETE FAIL!!!";
	  }	
	//echo "XX";
}

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin Page</title>
    <link rel="stylesheet" href="new.css">
    <script src="new.js" charset="utf-8"></script>
  </head>
  <body>

    <!-- Navigator on the top -->
    <header>
                    <span class="menu">
                        <table  align="center" height="100"> 
                            <tr>
                            <td class="btn" width="200px" id="main"><a href="index.php">Main</td>
                        <td class="btn" width="200px" id="car"><a href="car.php">Our Car</td>
                            <td class="btn" width="200px" id="res"><a href="reserve.php">Reservation</td>
                            <td class="btn" width="200px" id="care"><a href="cuscare.php">Customer Care</td>
                            <td class="btn" width="200px" id="pro"><a href="promo.php">Promotion</td>
                            <td class="btn" width="200px" id="brm"><a href="Map.php">Our Branches</td>
                            <td class="btn" width="200px" id="helpm"><a href="help.php">Help</td>
                            </tr>
                        </table>
                    </span>
</header>

    <!-- Register to receive our newsletter -->
    <div class="sub">
      <!-- <span>Register to receive our newsletter</span>
      <br>
      <input type="email" name="email" placeholder="fill in your email">
      <button type="submit" name="submit">Submit</button> -->
    </div>

    <!-- Main of this page -->
    <main>
      <h1>Welcome ADMIN!</h1>
        <!-- Toggle between add / delete tab-->
        <ul class="tabLinks">
          <li class="tabLink1 active" onclick="changeTab(event, 'tabLink1', 'tabContent1', 'add')">Add Car</li>
          <li class="tabLink1" onclick="changeTab(event, 'tabLink1', 'tabContent1', 'delete')">Delete Car</li>
          <li class="tabLink1" onclick="changeTab(event, 'tabLink1', 'tabContent1', 'update')">Update Car Status</li>
        </ul>

        <!-- Add tab -->
        <div id="add" class="tabContent1 myForm">
          <form action="new.php" method="POST">
            <h2>Add car</h2>
            <table border="0" width="100%">
            <tr>
            <td><label>Car Code (ex. c01):</label>
                <input type="text" name="carcode" required></td>
              <td><label>Car Name (Brand):</label>
                <input type="text" name="carname" required></td>
              <td><label>Car Model :</label>
                <input type="text" name="carmodel" required></td>
              <td><label>Car type (ex. saloon) :</label>
                  <select name="cartype">
              <option value="Select">Please select car type</option>
              <option value="cross over">Cross Over</option>
              <option value="sedan">Sedan</option>
              <option value="sport car">Sport Car</option>
              <option value="suv">SUV</option>
              <option value="van">Van</option>
              <option value="pickup">PickUp</option>
              <option value="saloon">Saloon</option>
              <option value="mpv">MPV</option>
              </select></td>
            </tr>
            <tr>
            <td><label>Seat:</label>
                <input type="text" name="carseat" required></td>
            <td><label>Price:</label>
                <input type="text" name="carprice" required></td>
              <td><label>Year:</label>
                <input type="text" name="caryear" required></td>
              <td><label>Color (ex. grey):</label>
                <input type="text" name="carcolor" required></td>
            </tr>
            <tr>
            <td><label>Insurance type:</label>
                  <input type="text" placeholder="1 or 2 or 3 only" name="carinsurance" required></td>
            <td><label>Picture :</label>
                <input type="file" name="carpic"></td>
            <td><label>Branch :</label>
                  <select name="carlocation">
                  <option value="Select">Branch that owns this car</option>
                  <option value="1">Bangkok</option>
                  <option value="2">Rangsit</option>
                  <option value="3">Bangkadi</option>
              </select></td>
              </tr>
            </table>
            <!-- <label>Status [available/not available]:</label>
            <input type="text" name="carstatus"> -->
            <br>
            <input type="submit" name="addcar" value="Add">
          </form>
        </div>

        <!-- Delete tab -->
        <div id='delete' class="tabContent1 myForm" style="display:none">
          <form action="new.php?delcarID=' <?php $delcarID ?>'" method="GET">
            <h2>Delete car</h2>
            <label>[delete] Car ID :</label>
            <input type="text" name="delcarID" required>
            <button>Delete</button></a>
          </form>
        </div>

        <!-- Update tab -->
        <div id='update' class="tabContent1 myForm" style="display:none">
          <form action="new.php" method="POST">
            <h2>Update car status</h2>
            <table border="0" width="100%">
            <tr>
              <td><label>Reserve ID:</label>
                <input type="text" name="checkrentid" required></td>
              <td><label>Date from:</label>
                <input type="date" name="datefrom"></td>
              <td><label>Date to:</label>
                <input type="date" name="dateto" required></td>
              
            </tr>
            <tr>
              <td><label>Actual end:</label>
                <input type="date" name="actualend" required></td>
              <!-- <td><label>Customer ID:</label>
                <input type="text" name="checkcusid"></td> -->
              <td><label>Customer License No:</label>
                <input type="text" name="checkcuslicense" required></td>
              <td><label>Other detail : </label><textarea rows="4" cols="50" name="comment" form="usrform"></textarea></label></td>
            </tr>
            </table>
            <input type="submit" name="updatecar" value="Confirm update">
          </form>
        </div>

        <!-- Toggle between Add Promotion / Remove Promotion tab-->
        <ul class="tabLinks">
          <li class="tabLink2 active" onclick="changeTab(event, 'tabLink2', 'tabContent2', 'addPro')">Add Promotion</li>
          <li class="tabLink2" onclick="changeTab(event, 'tabLink2', 'tabContent2', 'removePro')">Remove Promotion</li>
          <li class="tabLink2" onclick="changeTab(event, 'tabLink2', 'tabContent2', 'updatePro')">Update Promotion Status</li>
        </ul>

        <!-- Add Promotion tab -->
        <div id='addPro' class="tabContent2 myForm">
          <form action="new.php" method="POST">
            <h2>Add Promotion</h2>
            <label>Promotion Title :</label>
            <input type="text" name="protitle" required>
            <!-- <label>Promotion Code :</label>
            <input type="text"> -->
            <!-- <label>Available from :</label>
            <input type="date" name="dateava">
            <label>Available until :</label>
            <input type="date" name="dateuntil"> -->
            <label>Promotion Type :</label>
            <input type="text" name="protype" required>
            <label>Discount (ex. 10%=0.1) :</label>
            <input type="text" name="prodiscount">
            <label>Picture :</label>
            <input type="file" name="propic">
            <br>
            <input type="submit" name="addpro" value="Add Promotion">
          </form>
        </div>

        <!-- Remove Promotion tab -->
        <div id='removePro' class="tabContent2 myForm" style="display:none">
        <form action="new.php?delproCode=' <?php $delproCode ?>'" method="GET">
            <h2>Remove Promotion</h2>
            <label>[delete] Promotion Title :</label>
            <input type="text" name="delproDesc" required>
            <label>[delete] Promotion Code :</label>
            <input type="text" name="delproCode" required>
            <br>
            <input type="submit" name="rempro" value="Remove this promotion">
          </form>
        </div>

        <!-- Update Promotion tab -->
        <div id='updatePro' class="tabContent2 myForm" style="display:none">
          <form action="new.php" method="POST">
            <h2>Update Promotion</h2>
            <label>Promotion Code :</label>
            <input type="text" name="procode" required>
            <label>Updated status :</label>
            <input type="text" name="prostatus" required>
            <label>Promotion description :</label>
            <input type="text" name="prodescription">
            <br>
            <input type="submit" name="updatepro" value="Remove this promotion">
          </form>
        </div>

        <!-- Toggle between Add Location / Remove loction tab-->
        <ul class="tabLinks">
          <li class="tabLink4 active" onclick="changeTab(event, 'tabLink4', 'tabContent4', 'addlo')">Add Location</li>
          <li class="tabLink4" onclick="changeTab(event, 'tabLink4', 'tabContent4', 'removelo')">Remove Location</li>
          <li class="tabLink4" onclick="changeTab(event, 'tabLink4', 'tabContent4', 'addadmin')">Add Admin</li>
          <li class="tabLink4" onclick="changeTab(event, 'tabLink4', 'tabContent4', 'removeadmin')">Remove Admin</li>
          <li class="tabLink4" onclick="changeTab(event, 'tabLink4', 'tabContent4', 'adlist')">Admin List</li>
        </ul>

        <!-- Add Location tab -->
        <div id='addlo' class="tabContent4 myForm">
          <form action="new.php" method="POST">
            <h2>Add Location</h2>
            <table border="0" width="100%">
            <tr>
              <td><label>Location name :</label>
                <input type="text" name="loname" required></td>
              <td><label>Phone :</label>
                <input type="text" name="lophone" required></td>
              <td><label>Street name :</label>
                <input type="text" name="lostreet" required></td>
              <td><label>District :</label>
                <input type="text" name="lodistrict" required></td>
            </tr>
            <tr>
              <td><label>Email :</label>
                <input type="text" name="loemail" required></td>
              <td><label>Zip code :</label>
                <input type="text" name="lozip"></td>
              <td><label>Map Picture :</label>
                <input type="file" name="lopic"></td>
            </tr>
            </table>
            <input type="submit" name="addlo" value="Add Location">
          </form>
        </div>

        <!-- Remove Location tab -->
        <div id='removelo' class="tabContent4 myForm" style="display:none">
        <form action="new.php?delloid=' <?php $delloid ?>'" method="GET">
            <h2>Remove Location</h2>
            <label>[delete] Location ID :</label>
            <input type="text" name="delloid" required>
            <br>
            <input type="submit" name="remlo" value="Remove this location">
          </form>
        </div>

        <!-- Add Admin tab -->
        <div id='addadmin' class="tabContent4 myForm" style="display:none">
          <form action="new.php" method="POST">
            <h2>Add admin</h2>
            <table border="0" width="100%">
            <tr>
              <td><label>First name :</label>
                <input type="text" name="fname" required></td>
              <td><label>Last name :</label>
                <input type="text" name="lname" required></td>
              <td><label>Gender :</label>
                <input type="text" name="gender" required></td>
              <td><label>Phone :</label>
                <input type="text" name="adphone" required></td>
            </tr>
            <tr>
              <td><label>Email :</label>
                <input type="text" name="ademail" required></td>
              <td><label>Salary :</label>
                <input type="text" name="adsalary"></td>
              <td><label>Username :</label>
                <input type="text" name="username"></td>
              <td><label>Password :</label>
                <input type="text" name="password"></td>
            </tr>
            </table>
            <input type="submit" name="addad" value="Add Admin">
          </form>
        </div>


        <!-- Remove admin tab -->
        <div id='removeadmin' class="tabContent4 myForm" style="display:none">
          <form action="new.php?deladid=' <?php $deladid ?>&delfname='<?php $delfname?>'&dellname='<?php $dellname ?>'" method="GET">
            <h2>Remove admin</h2>
            <table border="0" width="100%">
            <tr>
              <td><label>Admin ID : </label>
                <input type="text" name="deladid" required></td>
              <td><label>First name :</label>
                <input type="text" name="delfname" required></td>
              <td><label>Last name :</label>
                <input type="text" name="dellname" required></td>
            </tr>
            </table>
            <input type="submit" name="removead" value="Remove Admin">
          </form>
        </div>


        <!-- Admin List tab -->
        <div id='adlist' class="tabContent4 myForm"  style="display:none">
        <h2>Admin List</h2>
        <table width="600" border="1">
          <tr>
            <th>Admin ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Salary</th>
          </tr>
          <?php 
				$q13 = "select * from admin; ";
				if ($res13 = $mysqli->query($q13)) 
				{
					while($ro13 = $res13->fetch_array())
					{
						//var_dump($ro13);
				?>
        <tr>
                    <td><?php echo $ro13['adminID']; ?></td></td>
                    <td><?php echo $ro13['fname']; ?></td> 
                    <td><?php echo $ro13['lname']; ?></td>
                    <td><?php echo $ro13['email']; ?></td>
                    <td><?php echo $ro13['telNO']; ?></td>
                    <td><?php echo $ro13['gender']; ?></td>
                    <td><?php echo $ro13['salary']; ?></td></td>
                    
        </tr> 
        <?php
					}
				}
				?>  
        </table>
        </div>

        <!-- Toggle between all return / return / >no return tab-->
        <h2>Rental history</h2>
        <ul class="tabLinks">
          <li class="tabLink3 active" onclick="changeTab(event, 'tabLink3', 'tabContent3', 'allReturn')">All</li>
          <li class="tabLink3" onclick="changeTab(event, 'tabLink3', 'tabContent3', 'returned')">Returned</li>
          <li class="tabLink3" onclick="changeTab(event, 'tabLink3', 'tabContent3', 'noReturn')">Not returned</li>
        </ul>

        <!-- All return tab -->
        <div id='allReturn' class="tabContent3 myForm">
          <h3>All history</h3>
          <table width="600" border="1">
            <tr>
              <td>Reserve ID</td>
              <td>License no.</td>
              <td>First Name</td>
              <td>Last Name</td>
              <td>Phone no.</td>
              <td>Start date</td>
              <td>End date</td>
              <td>Car ID</td>
              <td>Return status</td>
              <td>Pick up Location</td>
              <td>Penalty</td>
              <td>Total amount</td>
            </tr>
            </tr>
          <tr>
          <?php 
				$q2 = "select reserveID, r.licenseNO, fname, lname, phoneNO, startDate, endDate, carID, status,streetNAME, penalty, r.totalAMO from reservations r,location l, customer c WHERE r.licenseNO=c.licenseNO AND r.rentallocationID=l.rentallocationID; ";
				if ($res2 = $mysqli->query($q2)) 
				{
					while($ro2 = $res2->fetch_array())
					{
						//var_dump($ro2);
				?>
        <tr>
                    <td><?php echo $ro2['reserveID']; ?></td> 
                    <td><?php echo $ro2['licenseNO']; ?></td>
                    <td><?php echo $ro2['fname']; ?></td>
                    <td><?php echo $ro2['lname']; ?></td>
                    <td><?php echo $ro2['phoneNO']; ?></td>
                    <td><?php echo $ro2['startDate']; ?></td></td>
                    <td><?php echo $ro2['endDate']; ?></td></td>
                    <td><?php echo $ro2['carID']; ?></td></td>
                    <td><?php echo $ro2['status']; ?></td></td>
                    <td><?php echo $ro2['streetNAME']; ?></td></td>
                    <td><?php echo $ro2['penalty']; ?></td></td>
                    <td><?php echo $ro2['totalAMO']; ?></td></td>
        </tr> 
        <?php
					}
				}
				?>  
        </table>

          <div>
          <?php 
				$q5 = "select COUNT(*) AS count FROM reservations; ";
				if ($res5 = $mysqli->query($q5)) 
				{
					while($ro5 = $res5->fetch_array())
					{
						//var_dump($ro2);
				?>
            <p>Total customers: <?php echo $ro5['count']; ?></p>
          <?php
					}
        }
        ?>
        <?php
        $q11="select SUM(totalAMO) AS sumincome FROM reservations r where r.status='returned' or r.status='renting'; ";
        if ($res11 = $mysqli->query($q11)) 
				{
					while($ro11 = $res11->fetch_array())
					{
						//var_dump($ro6);
				?> 
        <p>Total income (exclude the customer that cancelled the reservations) : <?php echo $ro11['sumincome'];?></p>
        
        <?php
				$income=$ro11['sumincome'];	}
        }
        ?>
        
        <?php
        $q12="select SUM(salary) AS sumsalary FROM admin; ";
        if ($res12 = $mysqli->query($q12)) 
				{
					while($ro12 = $res12->fetch_array())
					{
						//var_dump($ro6);
				?> 
        <p>Total Expense : <?php echo $ro12['sumsalary'];?></p>
        <p>Total Revenue : <?php 
        if($income-$ro12['sumsalary']<0){
          $c="red";
        }
        else{
          $c="green";
        }?>
        <span style="color:<?php echo $c?>;">
        <?php echo $income-$ro12['sumsalary'];
        ?>
        </span></P>

        <?php
					}
        }
        ?>
        </div>
      </div>
        
        

        <!-- Returned tab -->
        <div id='returned' class="tabContent3 myForm" style="display:none">
          <h3>Returned list</h3>
          <table class="table" width="600" border="1">
            <tr class="colname">
              <td>Reserve ID</td>
              <td>License no.</td>
              <td>First Name</td>
              <td>Last Name</td>
              <td>Phone no.</td>
              <td>Start date</td>
              <td>End date</td>
              <td>Car ID</td>
              <td>Return status</td>
              <td>Location ID.</td>
              <td>Penalty</td>
              <td>Total amount</td>
            </tr>
            <tr>
          <?php 
				$q3 = "select reserveID, r.licenseNO, fname, lname, phoneNO, startDate, endDate, carID, status, penalty, totalAMO, streetNAME from reservations r,customer c, location l WHERE r.licenseNO=c.licenseNO AND r.rentallocationID=l.rentallocationID AND status='returned'; ";
				if ($res3 = $mysqli->query($q3)) 
				{
					while($ro3 = $res3->fetch_array())
					{
						//var_dump($ro2);
				?>
        <tr>
                    <td><?php echo $ro3['reserveID']; ?></td> 
                    <td><?php echo $ro3['licenseNO']; ?></td>
                    <td><?php echo $ro3['fname']; ?></td>
                    <td><?php echo $ro3['lname']; ?></td>
                    <td><?php echo $ro3['phoneNO']; ?></td>
                    <td><?php echo $ro3['startDate']; ?></td></td>
                    <td><?php echo $ro3['endDate']; ?></td></td>
                    <td><?php echo $ro3['carID']; ?></td></td>
                    <td><?php echo $ro3['status']; ?></td></td>
                    <td><?php echo $ro3['streetNAME']; ?></td></td>
                    <td><?php echo $ro3['penalty']; ?></td></td>
                    <td><?php echo $ro3['totalAMO']; ?></td></td>
        </tr> 
        <?php
					}
				}
				?>  
        </table>
        </div>

        <!-- No return tab -->
        <div id='noReturn' class="tabContent3 myForm" style="display:none">
          <h3>Not return list</h3>
          <table class="table" width="600" border="1">
            <tr class="colname">
              <td>Reserve ID</td>
              <td>License no.</td>
              <td>First Name</td>
              <td>Last Name</td>
              <td>Phone no.</td>
              <td>Start date</td>
              <td>End date</td>
              <td>Car ID</td>
              <td>Return status</td>
              <td>Location ID.</td>
              <td>Penalty</td>
              <td>Total amount</td>
            </tr>
            <tr>
          <?php 
				$q4 = "select reserveID, r.licenseNO, fname, lname, phoneNO, startDate, endDate, carID, status, streetNAME, penalty, totalAMO from reservations r,customer c, location l WHERE r.licenseNO=c.licenseNO AND r.rentallocationID=l.rentallocationID AND status='renting'; ";
				if ($res4 = $mysqli->query($q4)) 
				{
					while($ro4 = $res4->fetch_array())
					{
						//var_dump($ro2);
				?>
        <tr>
                    <td><?php echo $ro4['reserveID']; ?></td> 
                    <td><?php echo $ro4['licenseNO']; ?></td>
                    <td><?php echo $ro4['fname']; ?></td>
                    <td><?php echo $ro4['lname']; ?></td>
                    <td><?php echo $ro4['phoneNO']; ?></td>
                    <td><?php echo $ro4['startDate']; ?></td></td>
                    <td><?php echo $ro4['endDate']; ?></td></td>
                    <td><?php echo $ro4['carID']; ?></td></td>
                    <td><?php echo $ro4['status']; ?></td></td>
                    <td><?php echo $ro4['streetNAME']; ?></td></td>
                    <td><?php echo $ro4['penalty']; ?></td></td>
                    <td><?php echo $ro4['totalAMO']; ?></td></td>
        </tr> 
        <?php
					}
				}
				?>
        </div>  
        </table>
        </div>

        <!-- Car list -->
        <h2>Car list</h2>
        <ul class="tabLinks">
          <li class="tabLink4 active" onclick="changeTab(event, 'tabLink4', 'tabContent4', 'allcar')">All car</li>
          <li class="tabLink4" onclick="changeTab(event, 'tabLink4', 'tabContent4', 'avcar')">Available car</li>
          <li class="tabLink4" onclick="changeTab(event, 'tabLink4', 'tabContent4', 'unavcar')">Unavailable car</li>
        </ul>

        <!-- All car tab -->
        <div id='allcar' class="tabContent4 myForm">
        <h3>All car</h3>
        <table width="600" border="1">
          <tr>
            <th>Car ID</th>
            <th>Car CODE</th>
            <th>Car name</th>
            <th>Model</th>
            <th>Type</th>
            <th>Car price</th>
            <th>Year</th>
            <th>Color</th>
            <th>Location</th>
          </tr>
          <?php 
				$q10 = "select *,streetNAME from car c, location l WHERE c.rentallocationID=l.rentallocationID; ";
				if ($res10 = $mysqli->query($q10)) 
				{
					while($ro10 = $res10->fetch_array())
					{
						//var_dump($ro10);
				?>
        <tr>
                    <td><?php echo $ro10['carID']; ?></td>
                    <td><?php echo $ro10['carCODE'];?></td> 
                    <td><?php echo $ro10['carNAME']; ?></td>
                    <td><?php echo $ro10['model']; ?></td>
                    <td><?php echo $ro10['carTYPE']; ?></td>
                    <td><?php echo $ro10['price']; ?></td>
                    <td><?php echo $ro10['year']; ?></td></td>
                    <td><?php echo $ro10['color']; ?></td></td>
                    <td><?php echo $ro10['streetNAME']; ?></td></td>
        </tr> 
        <?php
					}
				}
				?>  
        </table>
        </div>

        <!-- Available car tab -->
        <div id='avcar' class="tabContent4 myForm" style="display:none">
        <h3>Available car</h3>
        <table width="600" border="1">
          <tr>
            <th>Car ID</th>
            <th>Car CODE</th>
            <th>Car name</th>
            <th>Model</th>
            <th>Type</th>
            <th>Car price</th>
            <th>Year</th>
            <th>Color</th>
            <th>Location</th>
          </tr>
          <?php 
				$q = "select *,streetNAME from car c, location l where status='available' and c.rentallocationID=l.rentallocationID; ";
				if ($res = $mysqli->query($q)) 
				{
					while($ro = $res->fetch_array())
					{
						//var_dump($ro);
				?>
        <tr>
                    <td><?php echo $ro['carID']; ?></td> 
                    <td><?php echo $ro['carCODE'];?></td>
                    <td><?php echo $ro['carNAME']; ?></td>
                    <td><?php echo $ro['model']; ?></td>
                    <td><?php echo $ro['carTYPE']; ?></td>
                    <td><?php echo $ro['price']; ?></td>
                    <td><?php echo $ro['year']; ?></td></td>
                    <td><?php echo $ro['color']; ?></td></td>
                    <td><?php echo $ro['streetNAME']; ?></td></td>
        </tr> 
        <?php
					}
				}
				?>  
        </table>
      </div>

      <!-- Unavailable car tab -->
      <div id='unavcar' class="tabContent4 myForm" style="display:none">
        <h3>Unvailable car</h3>
        <table width="600" border="1">
          <tr>
            <th>Car ID</th>
            <th>Car CODE</th>
            <th>Car name</th>
            <th>Model</th>
            <th>Type</th>
            <th>Car price</th>
            <th>Year</th>
            <th>Color</th>
            <th>Location</th>
          </tr>
          <!-- <tr>
            <td>c03</td>
            <td>Volvo1</td>
            <td>Saloon</td>
            <td>Model1</td>
            <td>2018</td>
            <td>Gray</td>
          </tr> -->
          <?php 
				$q11 = "select *,streetNAME from car c, location l where c.status='unavailable' and c.rentallocationID=l.rentallocationID;";
				if ($res11 = $mysqli->query($q11)) 
				{
					while($ro11 = $res11->fetch_array())
					{
						//var_dump($ro);
				?>
        <tr>
                    <td><?php echo $ro11['carID']; ?></td> 
                    <td><?php echo $ro11['carCODE'];?></td>
                    <td><?php echo $ro11['carNAME']; ?></td>
                    <td><?php echo $ro11['model']; ?></td>
                    <td><?php echo $ro11['carTYPE']; ?></td>
                    <td><?php echo $ro11['price']; ?></td>
                    <td><?php echo $ro11['year']; ?></td></td>
                    <td><?php echo $ro11['color']; ?></td></td>
                    <td><?php echo $ro11['streetNAME']; ?></td></td>
                    
        </tr> 
        <?php
					}
				}
				?>  
        </table>
      </div>

    </main>

    <!-- Footer of this page -->
    <footer>
      <p id="f">© Car Rental ©</p>
      <p id="addr">Address 56/1 Street</p>
      <!-- <img id="face" src="bloggif_5bb8bc2d97d96.png" width=50px height=50px>
      <img id="twit" src=bloggif_5bb8bd9be8059.png width="50" height="50"> -->
    </footer>

  </body>
</html>

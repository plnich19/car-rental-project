//This file will be the page after clicking submit in customer care page. It will do query in database depend on the category that customer declare on the previous page
<?php
include('connect.php'); 
if ($mysqli->connect_errno) {
 echo $mysqli->connect_errno ." : ". $mysqli->connect_error;
}

if(isset($_GET['licenseno'])) {
    $cusFirstname=$_GET['fname'];
    $cusLastname=$_GET['lname'];
    $cusPhone=$_GET['tel'];
    $cusEmail=$_GET['email'];
    $reserveID=$_GET['reserveid'];
    $licenseNo=$_GET['licenseno'];
  ?>
<!DOCTYPE html>
    <head>
        <title>Car</title>
        <link rel="stylesheet" href="cuscare.css" type="text/css">
                <style>
        table {
            border-collapse: collapse;
            text-align: left;
        }

        table, td, th {
            border: 1px solid black;
        }
        </style>
    </head>
    <body>
    <header>
            <span class="menu">
                <table  align="center" height="100"> 
                    <tr>
                    <td class="btn" width="200px" id="main"><a href="index.php">Main</td>
                    <td class="btn" width="200px" id="car"><a href="car.php">Our Car</td>
                        <td class="btn" width="200px" id="res"><a href="howtoreserve.php">Reservation</td>
                        <td class="btn" width="200px" id="care"><a href="cuscare.php">Customer Care</td>
                        <td class="btn" width="200px" id="pro"><a href="promo.php">Promotion</td>
                        <td class="btn" width="200px" id="brm"><a href="Map.php">Our Branches</td>
                        <td class="btn" width="200px" id="helpm"><a href="help.html">Help</td>
                    </tr>
                </table>
            </span>
        </header>
        <br>
        <!-- <span class="sub">Register to receive our newsletter<br><input type="email" name="email" value="fill in your email"><button type="submit" name="submit">Submit</button></span> -->
        <br>
        <br>
        <main>
        <div id="div_content">
        <div id="printableArea">
        <?php
            $category = $_GET['category'];
                    if ($category=='cancel'){
                        $q = " UPDATE reservations SET status = 'cancelled' WHERE reserveID = '$reserveID'";
                        $result=$mysqli->query($q);
                        if(!$result){
                            echo "UPDATE failed. Error: ".$mysqli->error ;
                        }
                        $q2 = "DELETE FROM payment WHERE reserveID='$reserveID'";
                        if (!$mysqli->query($q2))
                        {
                            echo "ERROR DELETE FAIL!!!";
                        }
                        echo "See you next time :("; }	
                    if ($category=='maintenance')
                        echo "We already got your requirement. Thank you.";
                    if ($category=='praise')
                        echo "Thank you for submitting the feedback! We will forward your feedback to our team.";
                    if ($category=='complain')
                        echo "Thank you for submitting the feedback! We will forward your feedback to our team.";
                    if ($category=='others')
                        echo "We will forward your message to our team. Thank you.";
                    if ($category=='reciept'){
                            $q="select * from reservations r where reserveID='$reserveID' and licenseNO='$licenseNo'";
                                if ($res = $mysqli->query($q)) 
                                {
                                    while($ro = $res->fetch_array())
                                    {
                                        $rentalloID=$ro['rentallocationID'];
                                        $procode=$ro['promotionCODE'];
                                        $q2="select * from customer c,payment p, promotion pr, location l where c.licenseNO='$licenseNo' and p.licenseNO='$licenseNo' and pr.promotionCODE='$procode' and l.rentallocationID='$rentalloID'" ;
                                        //var_dump($ro);
                                        if ($res2 = $mysqli->query($q2)) 
                                            {
                                                while($ro2 = $res2->fetch_array())
                                    {
                                    ?>
                                    <table border="0" width="100%">
                                    <tr>
                                    <td colspan="5" id="topic"><h3>Rental Document no. <?php echo $reserveID ?></h3></td>
                                    </tr>
                                    <tr>
                                    <td colspan="3"><h4>Customer name : <?php echo $ro2['fname']?> <?php echo $ro2['lname']?><br>
                                    License no: <?php echo $ro2['licenseNO']?><br>
                                    Pick up location: <?php echo $ro2['streetNAME'];?></h4></td>
                                    <td><h5>Start Date : <?php echo $ro['startDATE']?></h5></td> 
                                    <td><h5>End Date : <?php echo $ro['endDATE']?></h5></td>

                                    </tr>
                                    <tr>
                                    <td colspan="5"><h5>Reservations detail </h5></td>
                                    </tr>
                                    <tr>
                                    <td><p>Car ID</p></td>
                                    <td><p>Rental amount</p></td>
                                    <td><p>Discount</p></td>
                                    <td><p>Penalty</p></td>
                                    <td><p>Total Amount</p></td>
                                    </tr>
                                    <tr>
                                    <td><p><?php echo $ro['carID'];?></p></td>
                                    <td><p><?php echo $ro['rentalAMO'];?></p></td>
                                    <td><p><?php echo $ro2['discount'];?></p></td>
                                    <td><p><?php echo $ro['penalty'];?></p></td>
                                    <td><p><?php echo $ro['totalAMO'];?></p></td>
                                    </tr>
                                    </table>
                                    <br>
                                    <br>
                                    <br>
                                    <input type="button" onclick="printDiv('printableArea')" value="PRINT RECEIPT" />
                                    <?php
                                }
                            }
                        }
                    }
                }
                
            }?>
</div>
</div>
    </main>
            <footer>
                    <p id="f">© Car Rental ©</p>
                    <p id ="addr">Address 56/1 Street</p>
                    <img id="face"src="bloggif_5bb8bc2d97d96.png" width="50" height="50"><img id="twit"src=bloggif_5bb8bd9be8059.png width="50" height="50">
            </footer>
</body>
</html>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>

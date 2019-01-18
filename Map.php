<?php
include('connect.php'); //ตรงนี้คือบอกว่าเราจะ include mysqli ที่เป็น connection มาจากไฟล์ไหน
if ($mysqli->connect_errno) {
 echo $mysqli->connect_errno ." : ". $mysqli->connect_error;
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Map.css">
    <title>Map</title>
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
          <!-- <div class="image">
            <img  id="myImage" src="map.png">
          </div> -->
          <div class="contents">
            <h1 class="carre">Choose a Car Rental locations</h1>
            <table width="100%">
            <tr>
            <?php
                    $q = "select * from location ";
				    if ($res = $mysqli->query($q)) 
				    {
					    while($ro = $res->fetch_array())
					    {
                        //var_dump($ro);
                ?>
            <td width="30%"><?php echo $ro['streetNAME'];?> 
                <br>Phone : <?php echo $ro['phone'];?>
                <br>Email : <?php echo $ro['email'];?></p></td>
            <td width="70%"><?php echo "<img src=".$ro['lopic']." width='60%'/>"?></td>
            </tr>
                        <?php
                        }
                        } ?>
            
            <!-- <p onclick="document.getElementById('myImage').src='map2.png'"><u>SIIT Bangadi</u></p>
            <p onclick="document.getElementById('myImage').src='map3.png'"><u>SIIT Rangsit</u></p> -->
            </table>
         </div>
          
      </main>

      <footer>
          <p>© Car Rental ©</p>
          <p>Address 56/1 Street</p>
          <!-- <img src="bloggif_5bb8bc2d97d96.png" width="50" height="50"><img id="twit"src=bloggif_5bb8bd9be8059.png width="50" height="50"> -->
      </footer>
    <script src="M.js"></script>
  </body>
</html>

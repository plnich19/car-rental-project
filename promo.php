<?php
include('connect.php'); //ตรงนี้คือบอกว่าเราจะ include mysqli ที่เป็น connection มาจากไฟล์ไหน
if ($mysqli->connect_errno) {
 echo $mysqli->connect_errno ." : ". $mysqli->connect_error;
}

?>

<!DOCTYPE html>
    <head>
        <title>Promotion</title>
        <link rel="stylesheet" href="prostyle.css" type="text/css">
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
        <div  id="div_content">
            <div class = "flex-item">
            <table border="0" align="left" height=300px width="100%">
            <?php $q="select * from promotion where status='available' and promotionCODE != 0";  
            if ($res = $mysqli->query($q)) {
                            while($ro = $res->fetch_array())
                            { ?>
                <!-- <tr> -->
                    <span>
                    <td width="250"><?php echo "<img src=".$ro['propic']."  width='250px'/>"?><p><?php echo $ro['description']?><br>Promotion Code : <?php echo $ro['promotionCODE']?></td>  
                    </span>
                
                <?php                
                        }
                      
                    }
                ?>
                <!-- </tr> -->
            </table> 
        </div>
                </div>
    </main>
    <footer>
            <p>© Car Rental ©</p>
            <p>Address 56/1 Street</p>
            <!-- <img src="bloggif_5bb8bc2d97d96.png" width="50" height="50"><img id="twit"src=bloggif_5bb8bd9be8059.png width="50" height="50"> -->
    </footer>
    </body>
</html>

            

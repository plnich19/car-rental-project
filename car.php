// Car list page
<?php
include('connect.php'); //ตรงนี้คือบอกว่าเราจะ include mysqli ที่เป็น connection มาจากไฟล์ไหน
if ($mysqli->connect_errno) {
 echo $mysqli->connect_errno ." : ". $mysqli->connect_error;
}

?>
<!DOCTYPE html>
    <head>
        <title>Car</title>
        <link rel="stylesheet" href="car.css" type="text/css">
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
            <div id="CounterVisitor">
                    
                </div>
            <div id="establish">
                    
                </div>
                
        <main>
            <div id="div_content" class="table">
                <h2>Our car type</h2>
                <h3>We can offer you a variuos types of car.</h3>
                <h4>Please select your location first.</h4>
                <div id='cart' align="center"><span>
                <form action="car.php" method="POST">
                <label>Location : </label>
                <select name="picklo" required>
                    <option value="select">Select</option>
                <?php
                
                $q2="select * from location";
                
                if ($res2 = $mysqli->query($q2)) {
                            while($ro2 = $res2->fetch_array())
                            {
                                ?>
                    <option value="<?php echo $ro2['rentallocationID']?>"><?php echo $ro2['streetNAME'];?></option>
                    <?php
                }
            }?>
                </select>
                <label>Brand : </label>
                <select name="carname" >
            <option value="select">Select</option>
              <option value="toyota">Toyota</option>
              <option value="honda">Honda</option>
              <option value="mitsu">Mitsubishi</option>
              <option value="mercedes-benz">Mercedes Benz</option>
              <option value="bmw">BMW</option>
              <option value="Volkswagen">Volkswagen</option>
              <option value="ford">Ford</option>
              <option value="mazda">Mazda</option>
              <option value="isuzu">Isuzu</option>
              </select>

                <label>Type : </label><select name="cartype" >
                <option value="select">Select</option>
              <option value="cross over">Cross Over</option>
              <option value="sedan">Sedan</option>
              <option value="sport car">Sport Car</option>
              <option value="suv">SUV</option>
              <option value="van">Van</option>
              <option value="pickup">PickUp</option>
              <option value="saloon">Saloon</option>
              </select>

               <label>Color : </label><select name="carcolor">
               <option value="select">Select</option>
              <option value="white">White</option>
              <option value="black">Black</option>
              <option value="grey">Grey</option>
              <option value="red">Red</option>
              <option value="blue">Blue</option>
              <option value="yellow">Yellow</option>
              </select>

               <label>Year : </label><select name="caryear">
               <option value="select">Select</option>
              <option value="2018">2018</option>
              <option value="2017">2017</option>
              <option value="2016">2016</option>
              <option value="2015">2015</option>
              </select>
              <input type="submit" name="search" value="Search">
            </form>
                </span></div>
                <div class = "flex-item">
                    <?php 
                    if(isset($_POST['search'])) {
                        // if(isset($_POST["carname"]!="select")){
                        $location=$_POST["picklo"];
                        $carName = $_POST["carname"];
                    // }
                    
                        $carType = $_POST["cartype"];
                        $carYear = $_POST["caryear"];
                        $carColor = $_POST["carcolor"];
                        
                        $q="select * from car where status='available'";
                        if ($location=="select") {}
                        if ($location!="select") {
                            $q=$q.'AND rentallocationID='.'"'.$location.'"';
                           }
                        if ($carName!="select") {
                            $q=$q.'AND carNAME='.'"'.$carName.'"';
                           }
                        if ($carName=="select") {
                           }
                        if ($carType!="select") {
                            $q=$q.'AND carTYPE='.'"'.$carType.'"';
                           }
                        if ($carType=="select") {}
                        if ($carYear!="select") {
                            $q=$q.'AND year='.'"'.$carYear.'"';
                        }
                        if ($carYear=="select") {}
                        if ($carColor!="select") {
                            $q=$q.'AND color='.'"'.$carColor.'"';
                        }
                        if ($carColor=="select") {}
                    }

                    else{
                        $q="select * from car where status='available'";
                    }

                        if ($res = $mysqli->query($q)) {
                            while($ro = $res->fetch_array())
                            {
                           //var_dump($ro);
                        ?>    
                            
                            <table border="0" align="left" width="33%"> 
                        <tr>
                            <td>
                            <?php echo "<img src=".$ro['picture']." height='200px' width='100%'/>"?>
                                <span>
                                    <div>
                                        <p>Product code: <?php echo $ro['carCODE']; ?></p>
                                        <p>Name: <?php echo $ro['carNAME']; ?></p>
                                        <p>Model: <?php echo $ro['model']; ?></p>
                                        <p>Type: <?php echo $ro['carTYPE']; ?></p>
                                        <p>Price: <?php echo $ro['price']; ?></p>
                                        <p>Seat: <?php echo $ro['seatCAP']; ?></p>
        

                                        <a href="Reserve.php?id=<?php echo $ro['carID']; ?>"><button id="resbutton">Reserve</button></a>                                        
                                    </div>
                                
                                </span>
                            </td> 
                        </tr> 
                      </table>  
                    <?php                
                        }
                      
                    }
                    
                    else{
                        $q = "select * from car where status='available'; ";
                    if ($res = $mysqli->query($q)) 
                    {
                        while($ro = $res->fetch_array())
                        {
                            //var_dump($ro);
                    ?>
                        
                       <table border="1" align="left" class="cartab" width="33%"> 
                        <tr>
                            <td>
                            <!-- <form action="Reserve.php?reservecarCODE=' '" method="GET"> -->
                            <?php echo "<img src=".$ro['picture']." height='200px' width='100%'/>"?>
                                <span>
                                    <div>
                                        <p>Product code: <?php echo $ro['carCODE']; ?></p>
                                        <p>Name: <?php echo $ro['carNAME']; ?></p>
                                        <p>Model: <?php echo $ro['model']; ?></p>
                                        <p>Type: <?php echo $ro['carTYPE']; ?></p>
                                        <p>Price: <?php echo $ro['price']; ?></p>
                                        <p>Seat: <?php echo $ro['seatCAP']; ?></p>

                                       <a href="Reserve.php?id=<?php echo $ro['carID']; ?>&carname=<?php echo $ro['carNAME'];?>&model=<?php echo $ro['model'];?>&cartype=<?php echo $ro['carTYPE'];?>&price=<?php echo $ro['price'];?>"?>"><button>reserve</button></a>                                   
                                    </div>
                                
                                </span>
                            </td>
                        <!-- </form>  -->
                        </tr> 
                      </table>      
            <?php
                        }
                    }
                }
                    ?>  
                 
                <!-- </div> -->
            </div>
        </main>
            
        <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
            <script src="js111.js"></script>

            <footer>
                <p id="footerP">© Car Rental ©</p>
                <p id ="addr">Address 56/1 Street</p>
                <img id="face"src="bloggif_5bb8bc2d97d96.png" width="50" height="50"><img id="twit"src=bloggif_5bb8bd9be8059.png width="50" height="50">
        </footer>
            
    </body>
</html>

//php file
<!DOCTYPE html>
    <head>
        <title>Car</title>
        <link rel="stylesheet" href="cuscare.css" type="text/css">
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
		<div id="div_content" class="form">
			<form action="aftercare.php?reserve='<?php $reserveid ?>'" method="GET">
                <h2>Customer Care Service</h2>
                <h3>Feel free to contact us.</h3>
                <label>First name :</label>
				<input type="text" name="fname"><br><br>

                <label>Last name :</label>
				<input type="text" name="lname"><br><br>

                <label>License No. :</label>
				<input type="text" name="licenseno"><br><br>


				<label>Email :</label>
                <input type="text" name="email"><br><br>

                <label>Telephone/Mobile :</label>
                <input type="text" name="tel"><br><br>

                <!-- <label>Rental Document no: </label>
                <input type="text" name="tel"><br><br> -->
				
				<label>Reservation no. : </label>
                <input type="text" name="reserveid"><br><br>
                <div></div><br>
        
                <label>Category</label>
				<select name="category">
                    <option value="praise">Praise</option>
                    <option value="complain">Complain</option>
                    <option value="reciept">Require reciept</option>
                    <option value="maintenance">Require maintenance</option>
                    <option value="cancel">Cancellation the reservation</option>   
					<option value="others">Others</option>                   
                </select><br><br>
                
                <label>Detail : </label><textarea rows="4" cols="50" name="comment" form="usrform"></textarea>
			
				<div class="center">
					<input type="submit" value="Submit" >			
				</div>
            </form>
</main>
            <footer>
                    <p id="f">© Car Rental ©</p>
                    <p id ="addr">Address 56/1 Street</p>
                    <img id="face"src="bloggif_5bb8bc2d97d96.png" width="50" height="50"><img id="twit"src=bloggif_5bb8bd9be8059.png width="50" height="50">
            </footer>
    </div>
</body>

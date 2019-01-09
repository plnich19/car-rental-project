<?php
include('connect.php'); //ตรงนี้คือบอกว่าเราจะ include mysqli ที่เป็น connection มาจากไฟล์ไหน
if ($mysqli->connect_errno) {
 echo $mysqli->connect_errno ." : ". $mysqli->connect_error;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login to admin</title>
<link rel="stylesheet" href="cuscare.css">
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
<span class="sub">Register to receive our newsletter<br><input type="email" name="email" placeholder="fill in your email"><button type="submit" name="submit">Submit</button></span>        
        <br>
        <br>
        <main>
        <div class="content" id="div_content">
        <table >
				<form action="logintoadmin.php" method="POST">
                        <h3>Log in to admin page only</h3>
							<label>Username:</label> 
							<input type="text" name="username" placeholder="Username" required><br>
							<label>Password: </label>
							<input type="password" name="password" placeholder="Password"><br><br>
                            <input type="submit" name="login" value="Login" width="100%">
                            <!-- <input type="reset" name="reset" value="reset" width="100%"><br> -->
                            <input type="submit" name="forgotpass" value="Forgot Password" width="100%">
					</form>
                </table>
                <?php
	echo "<br>";
	// Check login input
	if (isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$q="select * from admin 
			where username='".$username."' and password='".$password."'" ;
		//echo $q;
		$result = $mysqli->query($q);
		if (!$result){
			die('Error: '.$q." ". $mysqli->error);
		}
		$count = $result->num_rows;
		//echo $count;
		// If result matches, there must be one row returned
			if($count==1){
				echo "Login Sucessfully!";
				//* // go to member page with session variables
					header("Location: new.php");//for session part
					$row = $result->fetch_array();
					$_SESSION['id'] = $row["id"]; 
					$_SESSION['name'] = $row["name"];
				//*/
			} else {
				echo "Wrong Username or Password!";
			}
		}
	?>
	<hr>
	<?php
	// show the forgot pass form if they need
	if (isset($_POST['forgotpass'])){ ?>
	
		<h1> Forgot password</h1>
			<form method="post" action="logintoadmin.php">
			Username: <input type="text" name="username" size="20"><br><br>
			<input type="submit" name="getpass" value="getpass">  
			<input type="reset" name="reset" value="reset">
			</form>
	<?php
	}
	?>
	
	<?php
		// without hassing pass
	/*
		if(isset($_POST['getpass'])){
			$username = $_POST['username'];
			$q="select * from admin where username='".$username."'" ;
			$result = $mysqli->query($q);
			if (!$result){
				die('Error: '.$q." ". $mysqli->error );
			}
			$count = $result->num_rows;
			if($count==1){
					$row = $result->fetch_array();
					$password = $row["password"];
					echo "Your password is: ".$password;
			}else{
				echo "No such username in the system. Please try again!";
			}
		}
	*/
		// Use this with hashing pass
	//*	
		if (isset($_POST['getpass'])){
			$username = $_POST['username'];
			$q="select * from admin where username='".$username."'" ;
			$result = $mysqli->query($q);
			if (!$result){
				die('Error: '.$q." ". $mysqli->error );
			}
			$count = $result->num_rows;
			if($count==1){
				$password = "1234";
				$newpassword =$password;
				$q="update admin set password ='".$newpassword."'
						where username='".$username."'" ;
				if ($mysqli->query($q)){
					echo "Your password is reset to: $password";
				}else{
					die('Updating password failed: ' .$mysqli->error);
				}	
			}else{
				echo "No such username in the system. please try again!";
			}
		}
	//*/
	//echo md5('12345');
	?>

</div>
</main>

<footer>
    <div class="footer">
        <p id="f">© Car Rental ©</p>
        <p id ="addr">Address 56/1 Street</p>
        <!-- <img id="face"src="bloggif_5bb8bc2d97d96.png" width=50px height=50px><img id="twit"src=bloggif_5bb8bd9be8059.png width="50" height="50"> -->
</footer>
</body>

<!DOCTYPE html>
    <head>
        <title>Car Rental System</title>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
    <body>
    <header>
			<a href="logintoadmin.php"><img src="https://cdn4.iconfinder.com/data/icons/adiante-apps-app-templates-incos-in-grey/512/app_type_rent_a_car_512px_GREY.png" style="float:left;width:50px;height;50px"></a>
    </header>
    <main>    
    <br>
            <h1> Welcome to car rental web </h1>
            <br>
			<p> <img src="http://cdn.onlinewebfonts.com/svg/img_536593.png" style="float:left;width:120px;height:100px;" ><img src="http://cdn.onlinewebfonts.com/svg/img_536593.png" style="float:right;width:120px;height:100px;" >Please choose our service below </p>
            <div class="menu">
                <table style="width:100%" border="0" height=1000px>  
                    <tr>
                        <td id="car" width="250"><a href="car.php">Our Car</a></td>
                        <td id="reserve" width="250"><a href="howtoreserve.php">Reservation</a></td>     
                    <tr>     
                        <td id="cuscare"width="250"><a href="cuscare.php">Customer Care</a></td>
                        <td id="promo" width="250"><a href="promo.php">Promotion</a></td>
                    </tr>   
                    <tr>
                        <td id="loca" width="250"><a href="Map.php">Locations</a></td>
                        <td id="help" width="250"><a href="help.php">Help</a></td>
                    </tr>
                </table> 
            </div>
</main>
            <script>
                    var slideIndex = 0;
                    carousel();
                  
                    function carousel() {
                        var i;
                        var x = document.getElementsByClassName("banner");
                        for (i = 0; i < x.length; i++) {
                          x[i].style.display = "none"; 
                        }
                        slideIndex++;
                        if (slideIndex > x.length) {slideIndex = 1} 
                        x[slideIndex-1].style.display = "block"; 
                        setTimeout(carousel, 4000); // Change image every 2 seconds
                    }
                   </script>
    <footer>
            <p>© Car Rental ©</p>
            <p>Address 56/1 Street</p>
            <!-- <img src="bloggif_5bb8bc2d97d96.png" width="50" height="50"><img id="twit"src=bloggif_5bb8bd9be8059.png width="50" height="50"> -->
    </footer>
    </body>
</html>

            

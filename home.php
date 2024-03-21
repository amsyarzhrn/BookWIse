<?php
// Include the database connection
require_once "dbconnect.php";

// Start the session
session_start();


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Home</title>
   
    <link rel="icon" type="image/png" href="favicon.ico">




<style>
   
    
  
     /*----------------Start NAV Section CSS----------------------*/

    *{
    margin:0;
    padding:0;
    font-family: 'Poppins', sans-serif;
    }

    .sub-header{
        height: 110px;
        width: 100%;
        background-color:steelblue ;
        image-resolution: from-image;
        background-position:center;
        background-size: cover;
        position: relative;
    }
    nav{
        display: flex;
        padding: 2% 3% 3% 3%;
        justify-content: space-between;
        align-items: center;
    }
    nav img{
        width: 130px;
        margin-top: -20px;
    }

    nav img:hover {
    width: 140px; /* Increase width on hover */
    }


    .nav-links{
        padding-top: 2px;
        flex:1;
        text-align: right;
    }
    .nav-links ul li{
        list-style: none;
        display: inline-block;
        padding: 8px 20px;
        position:relative;
    }
    .nav-links ul li a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    font-family: lato;
    transition: font-size 0.3s; /* Add transition for smooth effect */
    }

    .nav-links ul li.active a {
    color: black;
    font-weight: bold;
    font-size: 18px; /* Maintain the same font size as hover state */
}

    .nav-links ul li:hover a {
    color: black;
    font-weight: bold;
    font-size: 18px; /* Increase font size on hover */
    }
    .nav-links ul li:hover::after{
        width: 100%;    
    }

    


/*----------------End NAV Section CSS----------------------*/



    main {
    width: 95%;
    margin-left: 50px;
    background-color: white;
    font-size: 17px;
    margin-top: 20px;
    align-content: center;
    border: 10px;
}

.WelcomeParagraph {
    margin-left: 50px;
    margin-right: 100px;
}

.WelcomeParagraph p {
    text-align: justify;
}

.image-container {
    border: 2px;
    width: 100%;
    height: 300px;
    overflow: hidden;
}

.image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}


table {
    border: 2px solid;
    width: 100%;
    border-collapse: separate; /* Ensure that the table border radius applies */
    border-spacing: 0; /* Remove any space between table cells */
    border-radius: 5px; /* Add rounded corners to the table */
}

th,
td {
    border: 1px solid #dddddd;
    padding: 2px ;
    text-align: center;
    
}

th {
    background-color: cadetblue;
}

td {
    background-color: ghostwhite;
}




.buttonContainer {
    text-align: center; /* Center the buttons horizontally */
    margin-top: 20px; /* Add some margin from the top */
}

.buttonContainer .button{
        display: inline-block;
    padding: 10px 20px;
    background-color: green;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.3s ease;
    margin: 0 5px; /* Add some margin between buttons */
}



.buttonContainer .myButton {
    display: inline-block;
    padding: 10px 20px;
    background-color: steelblue;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.3s ease;
    margin: 0 5px; /* Add some margin between buttons */
}

.buttonContainer .courtButton {
    display: inline-block;
    padding: 10px 20px;
    background-color: green;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.3s ease;
    margin: 0 5px; /* Add some margin between buttons */
}

.buttonContainer .viewButton {
    display: inline-block;
    padding: 10px 20px;
    background-color: cadetblue;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.3s ease;
    margin: 0 5px; /* Add some margin between buttons */
    margin-right: 40px;
}


.buttonContainer .viewButton:hover,
.buttonContainer .button:hover,
.buttonContainer .myButton:hover,
.buttonContainer .courtButton:hover {
    background-color: navy;
    transform: scale(1.05); /* Increase size by 5% on hover */
    cursor: pointer; /* Change cursor to pointer on hover */
}

body {
    background-image: url('bodywallpaper.png'); /* Set the background image */
    background-size: cover; /* Cover the entire background */
    background-position: center; /* Center the background image */
    background-repeat: no-repeat; /* Do not repeat the background image */
}


</style>


  
</head>




<body>

        <!-- Start webpage header html-->

   <section class="sub-header">

        <nav>

            <a href="home.php"><img src="CSLogoNoBackground.png" height="100" width="280" ></a>
            <div class="nav-links" id="navLinks">
                <ul>
                    <li class="active"><a href="home.php"><span class="material-symbols-outlined">
                    home
                    </span> Home</a></li>
                    <li><a href="bookresource.php"><span class="material-symbols-outlined">
                    edit_calendar
                    </span> Book Resource</a></li>
                    <li><a href="about.php"><span class="material-symbols-outlined">
                    help
                    </span> About</a></li>
                    <li><a href="profile.php">
                    <span class="material-symbols-outlined">
                    manage_accounts
                    </span> Profile</a></li>
                    <li><a href="logout.php"><span class="material-symbols-outlined">
                    logout
                    </span> Logout</a></li>
                </ul>
 <!-- Display logged in username -->
        <?php
       // Check if the session variable is set
        if(isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            echo "<span style='font-size: 11px;font-weight: bold;'>Logged in as: $username";// Display a welcome message with the username
        } else {
            // If the session variable is not set, the user is not logged in
            // Redirect the user to the login page or display an error message
            header("Location: login.php"); // Redirect to the login page
            exit(); // Stop further execution of the script
        }
        ?>
            </div>
        </nav>
       
    </section>
<!-- End webpage header html-->


    

    <main>

        <br>
        

<!-- Add a container for the image -->
    <div class="image-container">
        <img id="carouselImage" src="LCD_p1.png" alt="book wise Picture">

        
    </div><br><br>

    

    <div class="WelcomeParagraph">
        <h2>Welcome to  Bookwise booking system!</h2>
        <p><n> The Unisel LCD and Classes Booking System is a web-based application designed to facilitate the efficient booking of LCDs (Liquid Crystal Displays) and classrooms by students at Universiti Selangor (Unisel). With the increasing demand for technology integration in educational settings, such a system becomes essential to streamline the process of reserving LCDs for presentations and securing classrooms for various academic activities.</p>

        <br><br><br>
    </div>





    <div class="buttonContainer">


    <a href="bookresource.php" class="button">Book Now</a>
    <a href="mybookings.php" class="myButton">My Bookings</a>
    <a href="resourceavailability.php" class="courtButton">View Availability</a>


    </div>


    <br><br>





    <div class="courtPriceTable">
        <h3>Booking Availablity:</h3><br>
    <table id="courts">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Booking Type</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Query to fetch court information from the database
            $sql = "SELECT  resourceID, resourceName, resourceType FROM resourceinfo";
            $result = mysqli_query($conn, $sql);

            // Check if query executed successfully
            if ($result) {
                // Fetch associative array
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    //
                    echo "<td>" . $row['resourceID'] . "</td>";
                    echo "<td>" . $row['resourceName'] . "</td>";
                    //
                    echo "</tr>";
                }
            } else {
                echo "Error retrieving court information: " . mysqli_error($conn);
            }
            ?>
        </tbody>
    </table><br><br>

    <!-- <div class="buttonContainer">
        <a href="map.php" class="viewButton">View Court Floor Layout</a>
    </div> -->
    <br><br><br>
</div>



</main>

<script>
    // JavaScript for changing images from a list
    const images = ['LCD_p1.jpeg', 'LCD_p2.jpeg', 'key1.jpg']; // List of image filenames
    let currentIndex = 1; // Index to track the current image (starting from 1)

    // Function to change the image
    function changeImage() {
        const carouselImage = document.getElementById('carouselImage');
        carouselImage.src = images[currentIndex];
        currentIndex = (currentIndex + 1) % images.length; // Loop through the images
    }

    // Change the image immediately and then every 7 seconds (7000 milliseconds)
    changeImage(); // Change image immediately
    setInterval(changeImage, 4000); // Change image every 4 seconds
</script>
        <br><br><br>
    </main><br><br>
</body>
</html>

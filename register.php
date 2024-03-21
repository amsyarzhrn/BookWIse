<?php
// Include the database connection
require_once "dbconnect.php";

// Define variables to store user data
$userUsername = $userFirstName = $userLastName = $userNRIC = $userPassword = $userGender = $userPhone = $userAddress = "";
$userEmail = "";
$confirmPassword="";


// Define variable to store success or error message
$registerMessage = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and store user data if the form was submitted
    if (isset($_POST["userUsername"])) {
        $userUsername = $_POST["userUsername"];
    }
    if (isset($_POST["userFirstName"])) {
        $userFirstName = $_POST["userFirstName"];
    }
    if (isset($_POST["userLastName"])) {
        $userLastName = $_POST["userLastName"];
    }
    if (isset($_POST["userNRIC"])) {
        $userNRIC = $_POST["userNRIC"];
    }
    if (isset($_POST["userPassword"])) {
        $userPassword = $_POST["userPassword"];
    }
    if (isset($_POST["userGender"])) {
        $userGender = $_POST["userGender"];
    }
    if (isset($_POST["userPhone"])) {
        $userPhone = $_POST["userPhone"];
    }
    if (isset($_POST["userEmail"])) {
    $userEmail = $_POST["userEmail"];
    }
    if (isset($_POST["userAddress"])) {
        $userAddress = $_POST["userAddress"];
    }
    if (isset($_POST["confirmPassword"])) {
        $confirmPassword = $_POST["confirmPassword"];
    }

        


    // Check if the userUsername or userNRIC already exists in the database
    $checkQuery = "SELECT * FROM user WHERE userUsername = ? OR userNRIC = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("ss", $userUsername, $userNRIC);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        $registerMessage = "User with the same username or NRIC already exists. <br> Please register with a different username or NRIC.";
        $registerMessageClass = "error"; // Set error message class


    } else if ($userPassword !== $confirmPassword) {
        $registerMessage = "Passwords inserted do not match. Please try again.";
        $registerMessageClass = "error"; // Set error message class





    }else  {
        // Prepare SQL statement to insert user data into the database
        $insertQuery = "INSERT INTO user (userUsername, userFirstName, userLastName, userNRIC, userPassword, userGender, userPhone,userEmail, userAddress) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";

        // Prepare and bind parameters
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("sssssssss", $userUsername, $userFirstName, $userLastName, $userNRIC, $userPassword, $userGender, $userPhone, $userEmail, $userAddress, );


        // Execute the statement
        if ($insertStmt->execute()) {
            $registerMessage = "User registered successfully! You may now head to the <a href='login.php'>Login page</a>";
            $registerMessageClass = "success"; // Set success message class
        } else {
            $registerMessage = "Error occurred while registering user.Please try again";
            $registerMessageClass = "error"; // Set error message class
        }

        // Close statement
        $insertStmt->close();
    }

    // Close check statement
    $checkStmt->close();
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register New User</title>
    <link rel="icon" type="image/png" href="favicon.png">




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
        background-color:cadetblue ;
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
    .nav-links{
        padding-top:;
        flex:1;
        text-align: center;
        margin-right: 150px;
        font-size: 32px;

    }
    .nav-links ul li{
        list-style: none;
        display: inline-block;
        padding: 8px 20px;
        position:relative;
    }
    .nav-links ul li a{
        color:white;
        text-decoration: none;
        font-size: 15px;
        font-family:lato;
    }
    .nav-links ul li:hover::after{
        width: 100%;
    }

/*----------------End NAV Section CSS----------------------*/



    main {
        width: 50%; /* Adjust the width as needed */
        margin: auto;
        background-color: whitesmoke;
        font-size: 17px;
        margin-top: 20px; /* Add margin to push it below the nav */
        padding: 50px;
    }


    /*  Form  CSS  */
form {
    width: 50%;
    margin: 0 auto;
    background-color: #f2f2f2;
  padding: 20px;
  border-radius: 10px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="password"],
input[type="email"],
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: cadetblue;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-left: 150px;
    margin-right: 10px;
}

input[type="submit"]:hover {
    background-color: #45a049;;
}

.success {
            color: green;
            font-weight: bold;
        }

        /* Style for error message */
        .error {
            color: red;
            font-weight: bold;
        }
</style>


  
</head>




<body>

        <!-- Start webpage header html-->


     <section class="sub-header">
        <nav>
            <a href="home.php"><img src="CSLogoNoBackground.png" height="100" width="280" ></a>
           <div class="nav-links" id="navLinks">
                <h1>Welcome to Book Wise</h1>
            </div>
            
        </nav>
    </section>
    <!-- End webpage header html-->





<main>
    <br>
    <h1>Register New User</h1><br>

    <p class="<?php echo $registerMessageClass; ?> "> 
    <?php echo $registerMessage; ?></p>

     
    <br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="userUsername">Username:</label>
    <input type="text" id="userUsername" name="userUsername" required><br>

    <label for="userFirstName">First Name:</label>
    <input type="text" id="userFirstName" name="userFirstName" required><br>

    <label for="userLastName">Last Name:</label>
    <input type="text" id="userLastName" name="userLastName" required><br>

    <label for="userNRIC">NRIC:</label>
    <input type="text" id="userNRIC" name="userNRIC" required><br>

    <label for="userPassword">Password:</label>
    <input type="password" id="userPassword" name="userPassword" required><br>

    <label for="confirmPassword">Re-confirm Password:</label>
    <input type="password" id="confirmPassword" name="confirmPassword" required><br>


    <label for="userGender">Role:</label>
    <select id="userGender" name="userGender" required>
        <option value="Lecturer">Lecturer</option>
        <option value="Student">Student</option>
    </select><br>

    <label for="userPhone">Phone:</label>
    <input type="text" id="userPhone" name="userPhone" required><br>

    <label for="userEmail">Email Address:</label>
    <input type="email" id="userEmail" name="userEmail" required><br>

    <label for="userAddress">Address:</label>
    <textarea id="userAddress" name="userAddress" rows="4" cols="50"></textarea><br>

    <br><br><input type="submit" value="Register">
</form>


    

    <br><br>
        <p style="font-size: 15px; ">Already a registered member? <a href="login.php" style="color: blue;">Login Here</a></p> 
    <br>



    
      


    

</main>

</body>
</html>

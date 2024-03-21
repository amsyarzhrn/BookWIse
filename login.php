<?php
// Start the session
session_start();

// Include the database connection
require_once "dbconnect.php";

// Define variables to store username and password
$username = $password = $loginType = "";

// Define variables to store error messages
$usernameErr = $passwordErr = $loginTypeError = "";
$loginSuccess = "";

// Function to sanitize input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to validate username and password
function validateInput($data) {
    return !empty($data);
}

// Function to authenticate user
function authenticateUser($username, $password, $loginType) {
    global $conn;

    // Sanitize input data
    $username = sanitizeInput($username);
    $password = sanitizeInput($password);

    // Determine the table based on loginType
    if ($loginType === "admin") {
        $tableName = "admin";
        $usernameColumn = "adminUsername";
        $passwordColumn = "adminPassword";
    } else {
        $tableName = "user";
        $usernameColumn = "userUsername";
        $passwordColumn = "userPassword";
    }

    // Query to fetch user from database
    $query = "SELECT * FROM $tableName WHERE $usernameColumn = ? AND $passwordColumn = ?";

    // Prepare and bind parameters
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        // Store user information in session variables
        $_SESSION['username'] = $username;
        $_SESSION['loginType'] = $loginType;
        return true;
    } else {
        return false;
    }
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate username
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = $_POST["username"];
    }

    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = $_POST["password"];
    }

    // Check if the loginType checkbox is checked
    $loginType = isset($_POST["loginType"]) ? $_POST["loginType"] : "";

    // Attempt authentication based on loginType
    if (empty($loginType)) {
        // If loginType is not specified, attempt authentication for normal user
        if (validateInput($username) && validateInput($password)) {
            if (authenticateUser($username, $password, "user")) {
                header("Location: home.php");
                exit;
            } else {
                $loginSuccess = "Invalid username or password. Please try again";
            }
        }
    } else if ($loginType === "admin") {
        // If loginType is admin, attempt authentication for admin
        if (validateInput($username) && validateInput($password)) {
            if (authenticateUser($username, $password, "admin")) {
                header("Location: adminhome.php");
                exit;
            } else {
                $loginSuccess = "Invalid admin username or password";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    
    <link rel="icon" type="image/png" href="favicon.png">

<style>

    main {
        text-align: center;
        width: 40%; /* Adjust the width as needed */
        margin: auto;
        background-color: whitesmoke;
        font-size: 17px;
        border: 2px solid black; /* Outer border */
        padding: 10px; /* Add padding for better spacing */
        position: relative; /* Add position relative */
        z-index: 1; /* Set a higher z-index to ensure it's above other elements */
        margin-top: 50px; /* Add margin to push it below the nav */
        border-radius: 30px;
    }

    .submit-form {
        background-color: white;
        border: none;
        color: black;
        padding: 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 13px;
        margin: 4px 3px;
        cursor: pointer;
        border-radius: 12px;
    }

    input[type=text] {
        background-color: lightblue;
    }

    input[type=password] {
        background-color: lightblue ;
    }

    body {
    background-image: url('loginBackground.png'); /* Specify the path to your image */
    background-size: cover; /* Cover the entire background */
    background-repeat: no-repeat; /* Prevent repeating the background image */
}
          
     /*----------------NAV Section CSS----------------------*/

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
    text-align: left;
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
    margin-left: 10px;
    margin-right: 10px;
}

input[type="submit"]:hover {
    background-color: #45a049;;
}
</style>
  
</head>

<body>
    <!-- Webpage header HTML -->
    <section class="sub-header">
        <nav>
            <a href="home.php"><img src="CSLogoNoBackground.png" height="100" width="280" ></a>
            <div class="nav-links" id="navLinks">
                <h1>Welcome to Book Wise</h1>
            </div>
        </nav>
    </section>
    <!-- End webpage header HTML -->

   <main>
    <br>
    <h1>Login</h1><br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>"><br>
        <span style="color: red;"><?php echo $usernameErr; ?></span><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <span style="color: red;"><?php echo $passwordErr; ?></span><br>

        <div style="display: flex; align-items: center;">
            <input type="checkbox" id="loginType" name="loginType" value="admin" <?php if ($loginType === "admin") echo "checked"; ?>>
            <label for="loginType" style="margin-left: 5px;">Tick to login as Administrator</label><br>
        </div>

        <br>
        <input type="submit" value="Login"><br>
    </form>

    <span style="color: red;"><?php echo $loginSuccess; ?></span>

    <br><br>
    <p style="font-size: 13px; color: blue;">Not a registered member? <a href="register.php">Register now!</a></p>

    <br><br>
    

    
</main>
<br>
    <br>


</body>
</html>

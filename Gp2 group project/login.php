<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<?php

// if the loginError cookie exist
if (isset($_COOKIE['loginError'])) {
    $errorMessage = $_COOKIE['loginError'];

    // Delete cookie
    setcookie('loginError', '', time() - 600, '/');
}
?>

<html>
<title>Login Page</title>
	<style>
		body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            }
		.icon {
			display: flex;
			align-items: center;
			}

		.icon i {
			font-size: 50px;
			margin-right: 10px;			
			}
    </style>
    <body>
	<div class="icon"><i class="fas fa-chalkboard"></i><h1><span>Whiteboard</span></h1></div>
	<br/><br/><br/>

        <form method="post" action="validateLogin.php">

			<!-- Student ID field -->
            <label for="id">Student ID:</label>
            <input type="text" id="id" name="id"/>
            <br/><br/>
			
			<label for="password">Password:</label>
            <input type="password" id="pw" name="pw"/>
            <br/><br/>
            
            <!-- form action type field -->
            <input type="submit" id="Login" value="Login"/>
			<p><a href="forgot_password.php">Forgot your password? </a></p>
			<p><a href="Createacc.php">Don't have a account? </a></p>
        </form>
		
	<?php
	// Display the error message if it exists
	if (isset($errorMessage)) {
		echo "<p style='color:#ff0000'>$errorMessage</p>";
	}
	?>
    </body>
</html>
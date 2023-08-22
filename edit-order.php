<?php

// Template Name:Edit Order
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Order</title>
    <style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>
</head>
<body>
<?php get_header(); ?>





<?php





// Load the WordPress environment
require_once(ABSPATH . 'wp-load.php');

// Check if the database connection is established
global $wpdb;
if ( ! empty( $wpdb->dbh ) ) {
    // Database connection is established
    echo "Hello";
} else {
    // Database connection is not established
    echo "Database connection error";
}

// Check if the form is submitted
$table_name = $wpdb->prefix . 'data';
$find = $_GET['id'];

$results = $wpdb->get_results("SELECT * FROM $table_name WHERE id = '$find'");


if($_SERVER['REQUEST_METHOD']==='POST')
{

  $email = $_POST['email'];
  $password = $_POST['psw'];
  $confirmPassword = $_POST['psw-repeat'];
  $reg_no = $_POST['reg'];

  $data = array(
    'email' => $email,
    'password' => $password,
    'c_password' => $confirmPassword,
    'reg_no'=>$reg_no,
    
);

$where=array (

  'id'=>$find
);
$wpdb->update($table_name, $data,$where);

session_start();
$successMessage = "Order updated successfully."; // Set the success message

// Store the success message in a session variable
$_SESSION['successMessage'] = $successMessage;

// Redirect to the destination page
wp_redirect('http://localhost/wordpress/all-order/');



}

?>



<form method="POST" style="border:1px solid #ccc">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" value="<?php echo $results[0]->email; ?>" required>


    <label for="psw-repeat"><b>Registration Number</b></label>
    <input type="text" placeholder="Enter Registration Number" name="reg" value="<?php echo $results[0]->reg_no; ?>" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" value="<?php echo $results[0]->password; ?>" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" value="<?php echo $results[0]->c_password; ?>" required>

    <input type="hidden"  name="id" value="<?php echo $results[0]->c_password; ?>" required>
    
    <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>
    
    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button>
      <button type="submit" class="signupbtn">Sign Up</button>
    </div>
  </div>
</form>

    
</body>
</html>
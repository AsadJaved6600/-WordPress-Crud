<?php

// Template Name:All Order
?>


<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
.success-message {
  background-color: #4CAF50;
  color: white;
  padding: 10px;
  margin-bottom: 10px;
  /* Add any other custom styles you want */
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

// Retrieve the data from the database table
$table_name = $wpdb->prefix . 'data';
$find = "RYX5263";
// $results = $wpdb->get_results("SELECT * FROM $table_name WHERE reg_no = '$find'");

$results = $wpdb->get_results("SELECT * FROM $table_name");




// Start the session
session_start();

// Store the results in a session variable
$_SESSION['search_results'] = $results;

// Loop through the results and display the data

?>


<h2>HTML Table</h2>

<?php
session_start();
// Check if a success message is present in the session
if (isset($_SESSION['successMessage'])) {
    $successMessage = $_SESSION['successMessage'];
    // Display the success message
    echo "<div class='success-message'>$successMessage</div>";

    // Clear the success message from the session to prevent it from being displayed again on subsequent page visits
    unset($_SESSION['successMessage']);
}
?>

<table>


  <tr>
    <th>Email</th>
    <th>Registration Number</th>
    <th>Password</th>
    <th>Action</th>
  </tr>


  
  <?php
  $directory = dirname($_SERVER['PHP_SELF']);
if (count($results) > 0) {
    foreach ($results as $row) {
        $email = $row->email;
        $password = $row->password;
        $confirmPassword = $row->c_password;
        $reg = $row->reg_no;
        $id = $row->id;

        echo "<tr>";
        echo "<td>$email</td>";
        echo "<td>$reg</td>";
        echo "<td>$password</td>";
      
        echo "<td><a href='$directory/edit-order?id=$id'>Edit</a>
        <a href='$directory/delete-order?id=$id'>Delete</a>
        </td>"; // Add the edit button
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No data found.</td></tr>";
}
?>



 
</table>

</body>
</html>
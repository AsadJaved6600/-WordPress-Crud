<?php

// Template Name:Reg Data
?>


<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
// Start the session
session_start();

// Retrieve the stored results from the session
$results = $_SESSION['search_results'];

// Check if there are results in the session
if (!empty($results)) {
    foreach ($results as $row) {
        $email = $row->email;
        $password = $row->password;
        $confirmPassword = $row->c_password;
        $reg = $row->reg_no;
        
        // Display the retrieved data
        echo "Email: $email<br>";
        echo "Password: $password<br>";
        echo "Confirm Password: $confirmPassword<br>";
        echo "Registration Number: $reg<br>";
    }
} else {
    echo "No data found in the session.";
}

?>


</body>
</html>
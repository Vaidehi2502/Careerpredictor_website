<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "career_predictor";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username, skills, and cgpa are set and not empty
    if (isset($_POST["username"]) && !empty($_POST["username"]) && 
        isset($_POST["skills"]) && !empty($_POST["skills"]) && 
        isset($_POST["cgpa"]) && !empty($_POST["cgpa"])) {

        // Get the form data
        $username = $_POST["username"];
        $skills = $_POST["skills"];
        $cgpa = $_POST["cgpa"];

        
        $sql = "INSERT INTO user_details (username, skills, cgpa) VALUES (?, ?, ?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "ssd", $username, $skills, $cgpa);

            
            if (mysqli_stmt_execute($stmt)) {
                
                header("Location: predict_career.php");
                exit();
            } else {
                echo "Error: " . mysqli_stmt_error($stmt);
            }

            
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing query: " . mysqli_error($conn);
        }

        
        mysqli_close($conn);
    } else {
        echo "Please fill in all fields.";
    }
}
?>

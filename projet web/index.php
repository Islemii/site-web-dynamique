<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projet";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Retrieve form data
$avis = $_POST['avis'];
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully<br>";
}

    // Check if email is empty
    if (empty($avis)) {
        echo "Error: Email cannot be empty.<br>";
    } else {
        // Debugging: Output retrieved form data
        

        // Prepare and bind the statement
        $stmt = $conn->prepare("INSERT INTO user (avis) VALUES (?)");
        $stmt->bind_param("s", $avis);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            echo "New record created successfully<br>";
        } else {
            if ($conn->errno == 1062) {
                echo "Error: avis already exists.<br>";
            } else {
                echo "Error: " . $stmt->error . "<br>";
            }
        }

        // Close the statement and connection
        $stmt->close();
    }
    $conn->close();

?>
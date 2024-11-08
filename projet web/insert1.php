<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projet";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully<br>";
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve form data
    $name = isset($_GET['name']) ? $_GET['name'] : "";
    $email = isset($_GET['email']) ? $_GET['email'] : "";
    $adress = isset($_GET['adress']) ? $_GET['adress'] : "";
    $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";
    $country = isset($_GET['country']) ? $_GET['country'] : "";
    $tel = isset($_GET['tel']) ? $_GET['tel'] : "";
    $paymentmethod = isset($_GET['paymentmethod']) ? $_GET['paymentmethod'] : "";
    $message = isset($_GET['message']) ? $_GET['message'] : "";

    // Check if email is empty
    if (empty($email)) {
        echo "Error: Email cannot be empty.<br>";
    } else {
        // Debugging: Output retrieved form data
        echo "Name: " . $name . "<br>";
        echo "Email: " . $email . "<br>";
        echo "Address: " . $adress . "<br>";
        echo "Quantity: " . $quantity . "<br>";
        echo "Country: " . $country . "<br>";
        echo "Tel: " . $tel . "<br>";
        echo "Payment Method: " . $paymentmethod . "<br>";
        echo "Message: " . $message . "<br>";

        // Prepare and bind the statement
        $stmt = $conn->prepare("INSERT INTO user (name, email, adress, quantity, country, tel, paymentmethod, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssissss", $name, $email, $adress, $quantity, $country, $tel, $paymentmethod, $message);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            echo "New record created successfully<br>";
        } else {
            if ($conn->errno == 1062) {
                echo "Error: Email already exists.<br>";
            } else {
                echo "Error: " . $stmt->error . "<br>";
            }
        }

        // Close the statement and connection
        $stmt->close();
    }
    $conn->close();
} else {
    echo "Form not submitted";
}
?>

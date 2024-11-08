<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projet";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$adress = $_POST['adress'];
$quantity = $_POST['quantity'];
$country = $_POST['country'];
$tel = $_POST['tel'];
$paymentmethod =$_POST['paymentmethod'];
$message = $_POST['message'];
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully<br>";
}

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

?>

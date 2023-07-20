<!DOCTYPE html>
<html>
<head>
    <title>Edit doctor</title>
    
    <script>
        function showMessage(message) {
            alert(message);
        }
    </script>
</head>
<body>
<?php
// Check if the doctor ID is provided in the URL
if (isset($_GET['id'])) {
    // Include the database configuration file
    require_once '../database/db_connect.php';

    // Create a new instance of the db_connect class
    $dbConnect = new db_connect();
    $conn = $dbConnect->connect();

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the doctor details based on the provided ID
    $doctorId = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM doctors WHERE id = ?");
    $stmt->bind_param("i", $doctorId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the doctor exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row["firstname"];
        $lastName = $row["lastname"];
        $email = $row["email"];
        $phoneNumber = $row["phone_number"];

        // Handle the form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the updated doctor details from the form
            $newFirstName = $_POST["firstname"];
            $newLastName = $_POST["lastname"];
            $newEmail = $_POST["email"];
            $newPhoneNumber = $_POST["phone_number"];

            // Update the doctor details in the database
            $stmt = $conn->prepare("UPDATE doctors SET firstname = ?, lastname = ?, email = ?, phone_number = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $newFirstName, $newLastName, $newEmail, $newPhoneNumber, $doctorId);
            $stmt->execute();

            // Display a pop-up message
            echo "<script>showMessage('Changes saved successfully');</script>";

            // Redirect to the doctor_details.php page with the updated changes
            echo "<script>window.location.href = '../view doctor_details.php?id=" . $doctorId . "';</script>";
            exit();
        }
?>
        <h1>Edit doctor
        </h1>
        <form method="POST" action="">
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" id="firstname" value="<?php echo $firstName; ?>" required><br><br>

            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" id="lastname" value="<?php echo $lastName; ?>" required><br><br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>" required><br><br>

            <label for="phone_number">Phone Number:</label>
            <input type="tel" name="phone_number" id="phone_number" value="<?php echo $phoneNumber; ?>" required><br><br>

            <input type="submit" value="Save Changes">
        </form>
<?php
    } else {
        echo "<p>Doctor not found.</p>";
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
} else {
    echo "<p>Invalid request. Please provide a valid doctor ID.</p>";
}
?>
</body>
</html>

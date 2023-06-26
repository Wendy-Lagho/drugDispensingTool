<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient</title>
    <style>
        /* CSS styles for the edit page */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .card {
            width: 400px;
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            margin-right: 5px;
            cursor: pointer;
        }

        .submit-button {
            background-color: #4caf50;
            color: #fff;
        }

        .cancel-button {
            background-color: #ddd;
            color: #000;
        }
    </style>
    
    <script>
        function showMessage(message) {
            alert(message);
        }
    </script>
</head>
<body>
<?php
// Check if the patient ID is provided in the URL
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

    // Fetch the patient details based on the provided ID
    $patientId = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM patients WHERE id = ?");
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the patient exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row["firstname"];
        $lastName = $row["lastname"];
        $email = $row["email"];
        $phoneNumber = $row["phone_number"];

        // Handle the form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the updated patient details from the form
            $newFirstName = $_POST["firstname"];
            $newLastName = $_POST["lastname"];
            $newEmail = $_POST["email"];
            $newPhoneNumber = $_POST["phone_number"];

            // Update the patient details in the database
            $stmt = $conn->prepare("UPDATE patients SET firstname = ?, lastname = ?, email = ?, phone_number = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $newFirstName, $newLastName, $newEmail, $newPhoneNumber, $patientId);
            $stmt->execute();

            // Display a pop-up message
            echo "<script>showMessage('Changes saved successfully');</script>";

            // Redirect to the patient_details.php page with the updated changes
            echo "<script>window.location.href = '../view/patient_details.php?id=" . $patientId . "';</script>";
            exit();
        }
?>
        <h1>Edit Patient</h1>
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
        echo "<p>Patient not found.</p>";
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
} else {
    echo "<p>Invalid request. Please provide a valid patient ID.</p>";
}
?>
</body>
</html>

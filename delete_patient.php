<?php
require_once 'connection.php';

// Check if ID parameter is provided
if (isset($_GET['id'])) {
    $patientId = $_GET['id'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("SELECT * FROM Patients WHERE id = ?");
    $stmt->bind_param("i", $patientId);

    // Execute the SQL statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if patient exists
    if ($result->num_rows > 0) {
        $patient = $result->fetch_assoc();
        $firstname = $patient['firstname'];
        $lastname = $patient['lastname'];
    } else {
        echo "Patient not found.";
        exit();
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request.";
    exit();
}

// Handle delete confirmation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if delete confirmation is submitted
    if (isset($_POST['confirm_delete'])) {
        // Delete the patient record
        $stmt = $conn->prepare("DELETE FROM Patients WHERE id = ?");
        $stmt->bind_param("i", $patientId);

        // Execute the SQL statement
        if ($stmt->execute()) {
            $successMessage = "Patient deleted successfully!";
            echo "<script>alert('$successMessage'); window.location.href = 'doctor_dashboard.php';</script>";
        } else {
            echo "Error deleting patient: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // User canceled the deletion
        echo "<script>window.location.href = 'doctor_dashboard.php';</script>";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Patient</title>
    <link rel="stylesheet" href="css/delete_patient.css">
</head>
<body>
<div class="card">
    <h1>Delete Patient</h1>
    <p>Are you sure you want to delete the patient:</p>
    <p><?php echo $firstname . ' ' . $lastname; ?></p>
    <div class="button-container">
        <form method="POST" action="">
            <button class="confirm-button" type="submit" name="confirm_delete">Confirm Delete</button>
            <button class="cancel-button" type="submit" name="cancel_delete">Cancel</button>
        </form>
    </div>
</div>
</body>
</html>
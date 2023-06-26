<!DOCTYPE html>
<html>
<head>
    <title>Patient Details</title>
    <style>
        /* CSS styles for the table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            font-weight: bold;
        }

        .pagination {
            margin-top: 10px;
        }

        .pagination a {
            color: #4CAF50;
            background-color: transparent;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 5px;
        }

        .pagination a.active-page {
            color: #fff;
            background-color: #4CAF50;
        }

        .pagination a:hover {
            background-color: #45a049;
            color: #f1f1f1;
        }

        .edit-button, .delete-button {
            background-color: #45a049; /* Changed to green */
            border: none;
            color: white;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
        }

        .delete-button {
            background-color: #f44336;
        }

        .add-button {
            background-color: #45a049;
            border: none;
            color: white;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 10px;
        }
    </style>
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
        $registrationDate = $row["reg_date"];
        ?>
        <h1>Patient Details</h1>
        <table>
            <tr>
                <th>First Name:</th>
                <td><?php echo $firstName; ?></td>
            </tr>
            <tr>
                <th>Last Name:</th>
                <td><?php echo $lastName; ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <th>Phone Number:</th>
                <td><?php echo $phoneNumber; ?></td>
            </tr>
            <tr>
                <th>Registration Date/Time:</th>
                <td><?php echo $registrationDate; ?></td>
            </tr>
        </table>
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

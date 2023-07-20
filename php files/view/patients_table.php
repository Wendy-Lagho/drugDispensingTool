<!DOCTYPE html>
<html>
<head>
    <title>Registered Patients</title>
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

        .edit-button {
            background-color: green; /* Changed to green */
        }

        .delete-button {
            background-color: red; /* Changed to red */
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

        /* New CSS styles for the hover functionality */
        .edit-link {
            text-decoration: none;
            color: #000;
        }

        .edit-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php
// Include the database configuration file
require_once '../database/db_connect.php';

// Create a new instance of the db_connect class
$dbConnect = new db_connect();
$conn = $dbConnect->connect();

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch total number of patients
$sqlCount = "SELECT COUNT(*) AS total FROM patients";
$resultCount = $conn->query($sqlCount);
$totalPatients = $resultCount->fetch_assoc()['total'];

// Define how many patients to display per page
$patientsPerPage = 10;

// Calculate the total number of pages
$totalPages = ceil($totalPatients / $patientsPerPage);

// Get the current page number
$currentPage = isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $totalPages ? $_GET['page'] : 1;

// Calculate the starting index of patients for the current page
$startingIndex = ($currentPage - 1) * $patientsPerPage;

// Fetch patients for the current page
$sql = "SELECT * FROM patients LIMIT $startingIndex, $patientsPerPage";
$result = $conn->query($sql);
?>

<h1>Registered Patients</h1>

<a class="add-button" href="../view/signup.php">Add New Patient</a>

<?php if ($result->num_rows > 0) { ?>
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Registration Date/Time</th>
            <th>Actions</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><a class='edit-link' href='../view/patient_details.php?id=" . $row['id'] . "'>" . $row["firstname"] . "</a></td>";
            echo "<td>" . $row["lastname"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone_number"] . "</td>";
            echo "<td>" . $row["reg_date"] . "</td>";
            echo "<td>";
            echo "<a class='edit-button' href='../database/edit_patient.php?id=" . $row['id'] . "'>Edit</a>";
            echo "<a class='delete-button' href='../database/delete_patient.php?id=" . $row['id'] . "'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <!-- Display pagination links -->
    <div class="pagination">
        <?php
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $currentPage) {
                echo "<a class='active-page' href='patients_table.php?page=" . $i . "'>" . $i . "</a>";
            } else {
                echo "<a href='patients_table.php?page=" . $i . "'>" . $i . "</a>";
            }
        }
        ?>
    </div>
<?php } else {
    echo "<p>No patients found.</p>";
}

// Close the database connection
$conn->close();
?>
</body>
</html>

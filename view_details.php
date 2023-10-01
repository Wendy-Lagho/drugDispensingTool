<!DOCTYPE html>
<html>
<head>
    <title>View Drug Details</title>
    <!-- Include any additional CSS or stylesheet links if needed -->
    <style>
        /* Add CSS styles for the view_details.php page */
        body {
            position: relative;
            /* Add any other body styles if needed */
        }
        &::before {
             content: '';
             position: absolute;
             top: 0;
             left: 0;
             width: 100%;
             height: 100%;
             background-color: rgb(255, 255, 255); /* Adjust the transparency value as needed (e.g., 0.5 for 50% transparency) */
             z-index: -1; /* Place the overlay behind other content */
         }

        /* Copy the styles for .navbar from your existing CSS */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            padding: 10px;
            border-radius: 5px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 100;
        }
        .navbar .logo {
            max-height: 90px;
            width: 100%;
            max-width: 100px;
            background-color: transparent;
        }
        .navbar ul {
            list-style: none;
            display: flex;
        }

        .navbar ul li {
            position: relative;
            margin: 0;
        }
        .navbar .dropdown-menu {
            display: none; /* Hide the dropdown menu by default */
            position: absolute;
            top: 100%; /* Position the dropdown menu below the parent list item */
            left: 0;
            background-color: #f9f9f9;
            padding: 5px 0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar .dropdown-menu li {
            padding: 5px 20px;
        }

        .navbar .dropdown-menu li a {
            color: #005000;
            font-family: "American Typewriter";
            text-decoration: none;
        }
            /* Show the dropdown menu on hover */
            .navbar ul li:hover .dropdown-menu {
            display: block;
        }

        .navbar ul li a {
            text-decoration: none;
            color: #005000;
            font-family: "American Typewriter";
            position: relative;
        }

        .navbar ul li a::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #005000; /* Change the color of the line as needed */
            transition: width 0.3s ease; /* Add a smooth transition for the sliding effect */
        }

        /* Slide the line across the link on hover */
        .navbar ul li a:hover::after {
            width: 100%;
        }

        .navbar .user-info {
            text-align: right;
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        .navbar .user-info span {
            color: #005000;
            font-size: 14px;
            margin-right: 10px;
        }

        .navbar .user-info .account-type {
            font-size: 12px;
            color: #666;
        }
        .navbar .logout-btn {
            background-color: #005000;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            margin-right: 20px;
        }

        /* Add this CSS to highlight the active navbar link */
        .navbar a {
            text-decoration: none;
            color: #005000;
            font-family: "American Typewriter";
            padding: 10px 20px;
        }

        /* Add this CSS to highlight the active navbar link */
        .navbar a.active {
            border-bottom: 2px solid #005000; /* Adjust the styling as needed */
            color: #005000;
        }

        /* Admin Dashboard styles */
        .dashboard-container {
            margin-top: 120px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .dashboard-container h1 {
            color: #005000;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .dashboard-container h2 {
            color: #005000;
            font-size: 20px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e5f0ff;
        }
        .drug-details-container {
            display: flex;
            align-items: center;
        }
        .drug-details-container img {
            max-width: 400px; /* Adjust the max-width as needed */
            align-self: flex-start; /* Align the image to the top/left within the container */
            margin-right: 20px;
        }
        .drug-details {
            padding: 10px;
            /*align the details to the top/left within the container */
            align-content: flex-start;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <img class="logo" src="images/_Pngtree_medical_health_logo_4135858-removebg-preview.png" alt="Logo">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <ul>
            <li><a href="logout.php" class="logout-btn">Logout</a></li>
        </ul>
    </div>
    <h1>Drug Details</h1>

<?php
// Check if the 'drugcategory' parameter is set in the URL
if (isset($_GET['drugcategory'])) {
    $drugcategory = $_GET['drugcategory'];

    // Make a database connection (reuse your connection code)
    require_once 'connection.php';

    // Fetch the image filename based on the 'drugcategory'
    $sql = "SELECT drug_image_filename FROM drugs WHERE drugcategory = ?";
    $stmt1 = $conn->prepare($sql);

    if (!$stmt1) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt1->bind_param("s", $drugcategory);
    if (!$stmt1->execute()) {
        die("Execute failed: " . $stmt1->error);
    }

    $stmt1->bind_result($imageFilename);

    // Check if a row was found
    if ($stmt1->fetch()) {
        echo "<div class='drug-details-container'>";
        echo "<img src='uploads/" . htmlspecialchars($imageFilename) . "' alt='" . htmlspecialchars($drugcategory) . "'>";
        echo "</div>";
    } else {
        echo "<p>Drug category not found.</p>";
    }

    // Close the first result set and statement
    $stmt1->close();

    // Fetch drug details based on the 'drugcategory'
    $sql = "SELECT drugid, drugcategory, drugname, drugdesc, drugmanufact, reg_date FROM drugs WHERE drugcategory = ?";
    $stmt2 = $conn->prepare($sql);

    if (!$stmt2) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt2->bind_param("s", $drugcategory);
    if (!$stmt2->execute()) {
        die("Execute failed: " . $stmt2->error);
    }

    $stmt2->bind_result($drugid, $drugcategory, $drugName, $drugDesc, $drugmanufact, $reg_date);

    // Check if a row was found
    if ($stmt2->fetch()) {
        echo "<div class='drug-details'>";
        echo "<h2>Drug Category: " . htmlspecialchars($drugcategory) . "</h2>";
        echo "<p><strong>Drug Name:</strong> " . htmlspecialchars($drugName) . "</p>";
        echo "<p><strong>Drug Description:</strong> " . htmlspecialchars($drugDesc) . "</p>";
        echo "<p><strong>Drug Manufacturer:</strong> " . htmlspecialchars($drugmanufact) . "</p>";
        echo "<p><strong>Registration Date:</strong> " . htmlspecialchars($reg_date) . "</p>";
        echo "</div>";
    } else {
        echo "<p>Drug details not found.</p>";
    }

    // Close the second result set and statement
    $stmt2->close();

    // Close the database connection
    $conn->close();
} else {
    echo "<p>Invalid request. Please provide a 'drugcategory' parameter.</p>";
}
?>
</body>
</html>


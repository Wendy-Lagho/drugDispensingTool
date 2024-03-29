<!DOCTYPE html>
<html>
<head>
    <title>Tabib Health - Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/admin_dashboard.css">
    <style>
        body {
            position: relative; /* Add position relative to the body */

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
            position: relative; /* Position the parent list items */
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

        .login-btn{
            display: inline-block;
            background-color: #005000;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            font-family: "Telugu MN";
            margin-right: 10px; /* Add some spacing between the buttons */
            cursor: pointer;
        }

        .signup-btn {
            display: inline-block;
            background-color: #ffffff;
            color: #005000;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            font-family: "Telugu MN";
            margin-right: 40px;
            cursor: pointer;
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
    /* Add a CSS style for the drug categories */
    .drug-categories {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .drug-category {
            text-align: center;
            padding: 10px;
            width: 19%; /* Distribute categories evenly */
        }

        .drug-category img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px; /* Space between image and "View Details" link */
        }

        .drug-category a {
            display: block; /* Make the link a block element to be below the image */
            color: #005000;
            font-family: "American Typewriter";
        }
        /* Add a CSS style for the drug images */
        .drug-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
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

<!-- Admin Dashboard Content -->
<div class="dashboard-container">
<h1>Welcome, Admin</h1>
    <h2>List of Tabib Health Users.</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>User Type</th>
        </tr>
        <?php
        require_once 'connection.php';
        // Check if the database connection is successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Fetch all users from the 'users' table
        $sql = "SELECT username, user_type FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["user_type"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No users found.</td></tr>";
        }
        ?>
    </table>
    <!-- Drug categories and images-->
    <h2>Drug Categories</h2>
    <div class="drug-categories">
        <?php
        require_once 'connection.php';
        // Fetch drug categories and their image filenames from the 'drugs' table
        $sql = "SELECT drugcategory, drug_image_filename FROM drugs";
        $result = $conn->query($sql);

        if ($result !== false && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='drug-category'>";
                echo "<h3>" . $row["drugcategory"] . "</h3>";
                echo "<img src='uploads/" . $row["drug_image_filename"] . "' alt='" . $row["drugcategory"] . "'>";
                echo "<a href='view_details.php?drugcategory=" . urlencode($row["drugcategory"]) . "'>View Details</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No drug categories found.</p>";
        }
        // Close the database connection
        $conn->close();
        ?>
    </div>
</div>
</body>
</html>
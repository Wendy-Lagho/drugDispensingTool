<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tabib Health - Pharmacist</title>
    <link rel="stylesheet" type="text/css" href="css/pharmacist_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            position: relative; /* Add position relative to the body */

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

        .user-info {
            text-align: right;
            padding: 10px;
            background-color: #f1f1f1;
            border-radius: 5px;
            color: green;
            font-size: 14px;
            font-family: "Telugu MN";
        }

        .profile-picture {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .card {
            margin-top: 10px;
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

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .success-message {
            text-align: center;
            margin-top: 10px;
            color: green;
        }

        /* Add this CSS for the "View All Prescriptions" button */
        .view-prescriptions-btn {
            display: inline-block;
            background-color: #005000;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            font-family: "Telugu MN";
            margin-top: 20px;
            cursor: pointer;
        }

        .view-prescriptions-btn:hover {
            background-color: #003d00;
        }

        .view-prescriptions-btn:active {
            background-color: #002500;
        }

        /* Style for the "View Dispensed Drugs" button */
        .view-dispensed-button {
            text-align: center;
            margin-top: 450px;
        }

        .view-dispensed-button button {
            display: inline-block;
            background-color: #005000;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            font-family: "Telugu MN";
            margin-top: 20px;
            cursor: pointer;
        }

        .view-dispensed-button button:hover {
            background-color: #808080;
            color: white;
        }

    </style>
</head>
<body>

<div class="navbar">
    <img class="logo" src="images/_Pngtree_medical_health_logo_4135858-removebg-preview.png" alt="Logo">
    <ul>
        <li><a href="index.php">Tabib Health - Pharmacy</a></li>
        <li><a href="#">Pharmacist Dashboard</a></li>
    </ul>
    <div class="auth-buttons">
        <?php
        if (isset($_SESSION['username'])) {
            // User is logged in, display user details and logout button
            echo '<div class="user-info">';
            if (isset($_SESSION['profile_picture'])) {
                // Display the profile picture if available
                echo '<img src="' . $targetDirectory . $_SESSION['profile_picture'] . '" alt="Profile Picture" class="profile-picture">';
            } else {
                // Display a default profile picture if no picture is available
                echo '<img src="images/blank-profile-picture-973460_1280.webp" alt="Default Profile Picture" class="profile-picture">';
            }
            echo '<span>Welcome, ' . $_SESSION['username'] . '</span>
            <span class="account-type">(' . $_SESSION['userType'] . ')</span>
            <a class="logout-btn" href="logout.php">Logout</a>
        </div>';
        } else {
            // User is not logged in, display login and signup buttons
            echo '<button class="login-btn" onclick="location.href=\'login.php\'">Login</button>
            <button class="signup-btn" onclick="location.href=\'signup.php\'">Sign Up</button>';
        }
        ?>
    </div>
</div>

<div class="drug-form">
    <?php include 'view_drug.php';
    ?>
    <button class="view-prescriptions-btn" onclick="location.href='dispense_drugs.php'">View All Prescriptions</button>
</div>

<div class="view-dispensed-button">
    <button onclick="location.href='dispensed_drugs.php'">View Dispensed Drugs</button>
</div>

</body>
</html>

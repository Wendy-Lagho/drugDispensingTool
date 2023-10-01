<?php
session_start();
require_once 'connection.php';

$successMessage = '';
$linkToPatientList = '';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $drugid = $_POST["drugid"];
    $drugcategory = $_POST["drugcategory"];
    $drugname = $_POST["drugname"];
    $drugdesc = $_POST["drugdesc"];
    $drugmanufact = $_POST["drugmanufact"];
    
    $timestamp = date('Y-m-d-H-i-s'); // Generate timestamp
    $uploadedFileName = $_FILES["drug_image"]["name"];
    $newFileName = $timestamp . "_" . $uploadedFileName;
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . $newFileName;

    if (move_uploaded_file($_FILES["drug_image"]["tmp_name"], $targetFile)) {
        $stmt = $conn->prepare("INSERT INTO Drugs (drugid, drugcategory, drugname, drugdesc, drugmanufact, reg_date, drug_image_filename) VALUES (?, ?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            echo "Error preparing statement: " . $conn->error;
            exit();
        }

        $stmt->bind_param("sssssss", $drugid, $drugcategory, $drugname, $drugdesc, $drugmanufact, $timestamp, $newFileName);

        if ($stmt->execute()) {
            $successMessage = "Drug added successfully!";
            $linkToPatientList = '<a href="pharmacist_dashboard.php">View Drug Stock List</a>';
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error uploading file.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Drug Input Form</title>
    <link rel="stylesheet" href="css/drug_form.css">
</head>
<body>

<div class="navbar">
    <img class="logo" src="images/_Pngtree_medical_health_logo_4135858-removebg-preview.png" alt="Logo">
    <ul>
        <li><a href="index.php">Tabib Health - Home</a></li>
        <li><a href="#">Doctor Dashboard</a></li>
    </ul>
    <div class="auth-buttons">
        <?php
        if (isset($_SESSION['username'])) {
            echo '<div class="user-info">';
            if (isset($_SESSION['profile_picture'])) {
                echo '<img src="' . $targetDirectory . $_SESSION['profile_picture'] . '" alt="Profile Picture" class="profile-picture">';
            } else {
                echo '<img src="images/blank-profile-picture-973460_1280.webp" alt="Default Profile Picture" class="profile-picture">';
            }
            echo '<span>Welcome, ' . $_SESSION['username'] . '</span>
            <span class="account-type">(' . $_SESSION['userType'] . ')</span>
            <a class="logout-btn" href="logout.php">Logout</a>
            </div>';
        } else {
            echo '<button class="login-btn" onclick="location.href=\'login.php\'">Login</button>
            <button class="signup-btn" onclick="location.href=\'signup.php\'">Sign Up</button>';
        }
        ?>
    </div>
</div>

<div class="card">
    <h1>Drug Stock</h1>
    <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="drugid">Drug ID:</label>
        <input type="text" id="drugid" name="drugid" required><br><br>

        <label for="drugcategory">Drug Category:</label>
        <input type="text" id="drugcategory" name="drugcategory" required><br><br>

        <label for="drugname">Drug Name:</label>
        <input type="text" id="drugname" name="drugname" required><br><br>

        <label for="drugdesc">Drug Description:</label>
        <input type="text" id="drugdesc" name="drugdesc" required><br><br>

        <label for="drugmanufact">Drug Manufacturer:</label>
        <input type="text" id="drugmanufact" name="drugmanufact" required><br><br>

        <label for="drugimage">Drug Image:</label>
        <input type="file" id="drugimage" name="drug_image" required><br><br>

        <button type="submit">Add Drug</button>
        <?php if (!empty($successMessage)) { ?>
            <div class="success-message">
                <?php echo $successMessage; ?>
                <?php echo $linkToPatientList; ?>
            </div>
        <?php } ?>
        <!-- add the view_details.php link here -->
        <?php
if (!empty($row["drugcategory"])) {
    echo "<a href='view_details.php?drugcategory=" . urlencode($row["drugcategory"]) . "'>View Details</a>";
}
?>
    </form>
</div>
</body>
</html>

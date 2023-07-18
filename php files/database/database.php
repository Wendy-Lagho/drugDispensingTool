<?php
//include database class
include 'db_connect.php';
session_start();

//create an instance of the database class
$db = new db_connect();

//store the connection variable in a local variable
$conn = $db->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $entity = $_POST['entity'];

    if($entity === 'patient') {
        echo "<script>alert('You are registered as a patient');</script>";
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $gender =  $_POST['gender'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $password = $_POST['password'];
        $reg_date = date("Y-m-d");

        // SQL query to insert user data
        $sql_insert_user = "INSERT INTO patients (firstname, lastname, gender, email, phone_number, password, reg_date)
                            VALUES ('$firstname', '$lastname', '$gender', '$email', '$phone_number', '$password', '$reg_date')";

        // Execute the query to insert user data
        if ($conn->query($sql_insert_user) === TRUE) {
            $result = mysqli_query($conn, "SELECT ID FROM patients WHERE email = '$email'");
            
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $ID = $row['ID'];
                // Display id using script
                echo "<script>alert('Your ID is: $ID');</script>";
                // Redirect using script
                echo "<script>window.location.href='../view/login.php';</script>";
                //header("Location: ../view/login.php");
            } else {
                return false;
            }
            
            /*echo "<script>alert('Data inserted successfully');</script>";
            header("Location: ../view/login.php");*/
        } else {
            echo "Error inserting user data: " . $conn->error;
        }

    } else if($entity === 'doctor') {
        echo "<script>alert('You are registered as a doctor');</script>";
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $password = $_POST['password'];
        $reg_date = date("Y-m-d");

        // SQL query to insert user data
        $sql_insert_user = "INSERT INTO doctors (firstname, lastname, gender, email, phone_number, password, reg_date)
                            VALUES ('$firstname', '$lastname', '$gender', '$email', '$phone_number', '$password', '$reg_date')";

        // Execute the query to insert user data
        if ($conn->query($sql_insert_user) === TRUE) {
            $result = mysqli_query($conn, "SELECT ID FROM doctors WHERE email = '$email'");
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $ID = $row['ID'];
                // Display id using script
                echo "<script>alert('Your ID is: $ID');</script>";
                // Redirect using script
                echo "<script>window.location.href='../view/login.php';</script>";
                //header("Location: ../view/login.php");
            } else {
                return false;
            }
            /*echo "<script>alert('Data inserted successfully');</script>";
            header("Location: ../view/login.php");*/
        } else {
            echo "Error inserting user data: " . $conn->error;
        }
    } else if( $entity === 'supervisor') {
        echo "<script>alert('You are registered as an supervisor');</script>";
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $password = $_POST['password'];
        $reg_date = date("Y-m-d");

        // SQL query to insert user data
        $sql_insert_user = "INSERT INTO supervisor (firstname, lastname, gender, email, phone_number, password, reg_date)
                            VALUES ('$firstname', '$lastname', '$gender', '$email', '$phone_number', '$password', '$reg_date')";

        // Execute the query to insert user data
        if ($conn->query($sql_insert_user) === TRUE) {
            $result = mysqli_query($conn, "SELECT ID FROM supervisors WHERE email = '$email'");
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $ID = $row['ID'];
                // Display id using script
                echo "<script>alert('Your ID is: $ID');</script>";
                // Redirect using script
                echo "<script>window.location.href='../view/login.php';</script>";
                //header("Location: ../view/login.php");
            } else {
                return false;
            }
            /*echo "<script>alert('Data inserted successfully');</script>";
            header("Location: ../view/login.php");*/
        } else {
            echo "Error inserting user data: " . $conn->error;
        }
    }
    //retrieve form data
    $entity = $_POST['Lentity'];
    
    if($entity === 'patient') {
        $username = $_POST['Lusername'];
        $password = $_POST['Lpassword'];

        // check if username and password exist in patients table
        $sql_check_user = "SELECT * FROM patients WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql_check_user);

        if($result === true) {
            // set session variables
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['entity'] = $entity;

            // redirect to patient dashboard
            header("Location: ../view/patient_details.php");
        
        } else {
            echo "Error: " . $sql_check_user . "<br>" . $conn->error;
        }
    } else if($entity === 'doctor') {
        $username = $_POST['Lusername'];
        $password = $_POST['Lpassword'];

        // check if username and password exist in doctors table
        $sql_check_user = "SELECT * FROM doctors WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql_check_user);

        if($result === true) {
            // set session variables
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['entity'] = $entity;

            // redirect to doctor dashboard
            header("Location: ../view/doctor.php");
        
        } else {
            echo "Error: " . $sql_check_user . "<br>" . $conn->error;
        }
    } else if($entity === 'supervisor') {
        $username = $_POST['Lusername'];
        $password = $_POST['Lpassword'];

        // check if username and password exist in supervisors table
        $sql_check_user = "SELECT * FROM supervisors WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql_check_user);

        if($result === true) {
            // set session variables
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['entity'] = $entity;

            // redirect to supervisor dashboard
            header("Location: ../view/supervisor_dashboard.php");
        
        } else {
            echo "Error: " . $sql_check_user . "<br>" . $conn->error;
        }
}

}
?>

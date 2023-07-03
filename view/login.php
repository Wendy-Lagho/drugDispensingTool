<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f2f2f2;
        }

        .card {
            width: 300px;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .card h2 {
            text-align: center;
            color: #333333;
        }

        .card input[type="text"],
        .card input[type="password"],
        .card select {
            width: 100%;
            padding: 10px;
            margin: auto;
            display: block;
            border: none;
            border-radius: 5px;
            background-color: #ffffff;
            text-align: center;
            box-sizing: border-box;
        }

        .card button {
            display: block;
            width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: none;
            background-color: green;
            color: #fff;
            font-weight: bold;
        }

        .card button:hover {
            background-color: darkgreen;
        }

        .card a {
            color: #4caf50;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="card">
    <h2>Login form</h2>

    <form action="patients_table.php" method="POST">
        <label for="username"> User ID:</label>
        <input type="text" name="Lusername" id="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="Lpassword" id="password" required><br><br>

        <select name="Lentity" id="entity">
          <option value="patient" id="patient">Patient</option>
          <option value="doctor" id="doctor">Doctor</option>
        </select>
        <button type="submit">Login</button>
    </form>
    <p>Not registered? <a href="signup.php">Sign up</a></p>
</div>
</body>
</html>

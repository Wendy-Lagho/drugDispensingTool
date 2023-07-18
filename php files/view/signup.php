<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
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

        .card h1 {
            text-align: center;
            color: #333333;
        }

        .card input[type="text"],
        .card input[type="password"],
        .card input[type="email"],
        .card input[type="number"],
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
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4caf50;
            color: #ffffff;
            cursor: pointer;
        }

        .card button:hover {
            background-color: #45a049;
        }

        .card a {
            color: #4caf50;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="card">
  <h2>Registration Form</h2>

  <form action="../database/database.php" method="POST">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname" required><br><br>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" id="lastname" required><br><br>

        <label for="gender">Gender:</label>
        <input type="text" name="gender" id="gender" required><br><br>
    
        <label for="email"> Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="phone_number">Phone Number:</label>
        <input type="number" name="phone_number" id="phone_number" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <select name="entity" id="entity">
          <option value="patient" id="patient">Patient</option>
          <option value="doctor" id="doctor">Doctor</option>
          <option value="supervisor" id="supervisor">Supervisor</option>
        </select>
        <button type="submit">Signup</button>
    </form>
</div>
</body>
</html>
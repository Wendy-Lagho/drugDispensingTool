<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Portal</title>
</head>
<body>
    <div class="body">
        <!--The Navigation Bar-->
<div>
<nav class="navbar">
      <!-- LOGO -->
      <div class="logo">PharmaSea</div>

        <!-- NAVIGATION MENU -->
        <ul class="nav-links">
          <div class="menu">
            <li>
              <?php 
              session_start();
              $username = $_SESSION['username'];
              echo "Welcome, $username";
              ?>
              </li>
              <li><a href="../Templates/homepage.html">Home</a></li>
              <li><a href="../config/signout.php">Sign Out</a></li>
          </div>
      </ul>
  </nav>
</div>
<div>
	<!-- code here -->
	<div class="card">
		<div class="card-image">	
			<h2 class="card-heading">
				Welcome Doctor<br>
				<small>Add Prescription</small>
			</h2>
		</div>
		  <form class="card-form" method="post" action="../config/doctor.php">
			  <div class="input">
				  <input type="number" class="input-field" name="patientID"  required/>
				  <label class="input-label">Patient ID</label>
			  </div>
        <div class="input">
          <input type="text" class="input-field" name="prescriptionDescription" required/>
          <label class="input-label">Prescription Description</label>
        </div>
        <div class="input">
				  <input type="date" class="input-field" name="prescriptionDuration"  required/>
				  <label class="input-label">Prescription Duration</label>
			  </div>   
        <div class="action">
          <input type="submit" class="action-button" value="Add Prescription" />
        </div>
      </form>
	</div>
</div>

</body>
</html>
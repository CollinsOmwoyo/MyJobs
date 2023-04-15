<?php
// Set up your local database connection
$servername = "localhost";
$username = "username";
$password = "";
$dbname = "databasename";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// Retrieve data from employers table 
$sql = "SELECT employer_name, employer_icon, job_types, current_applications FROM employers";
$result = $conn->query($sql);

// Store employer data in array
$employers = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $employers[] = $row;
  }
}
// Retrieve data from job_types table
$sql = "SELECT job_type, employers, salary, locations, sequence FROM job_types";
$result = $conn->query($sql);

// Store job_types  data in array look for popular listings and ask colleagues
$job_types = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $job_types[] = $row;
  }
}
// Retrieve data from job table
$sql = "SELECT job_id, employer_name, job_name, date_posted, date_applied, days_late, source_reference, status FROM job";
$result = $conn->query($sql);

// Store job data in array
$job = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $job[] = $row;
  }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>My Applications</title>
  <nav>
      <ul>
        <li><a href="#employers">Potential Employers</a></li>
        <li><a href="#job-types">Jobs and Current Expressions</a></li>
        <li><a href="#jobs">Jobs</a></li>
      </ul>
    </nav>
  <style>
body {
background-color: #222;
color: #fff;
font-family: Arial, sans-serif;
font-weight: bold;
font-size: 16px;
}

h1{
font-size: 40px;
font-weight: bold;
text-align: left;
margin-top: 50px;
margin-bottom: 20px;
color: #cccccc;
text-shadow: 2px 2px #333;
}
header {
background-color: #4c3d00;
padding: 10px;
animation: header-animation 1s ease-in-out;
}

@keyframes header-animation {
0% { transform: translateY(-20px); opacity: 0; }
100% { transform: translateY(0); opacity: 1; }
}

nav ul {
margin: 0;
padding: 0;
list-style: none;
}

nav li {
display: inline-block;
margin-right: 20px;
}

nav a {
color: #fff;
text-decoration: none;
padding: 5px;
border-radius: 5px;
background-color: #555;
transition: background-color 0.3s ease-in-out;
}

nav a:hover {
background-color: #ffcc00;
}

table {
border-collapse: collapse;
margin: 20px 0;
width: 100%;
animation: table-animation 1s ease-in-out;
}

@keyframes table-animation {
0% { transform: translateY(-20px); opacity: 0; }
100% { transform: translateY(0); opacity: 1; }
}

th, td {
border: 1px solid #555;
padding: 10px;
text-align: left;
}

th {
background-color: #333;
color: #ffcc00;
animation: th-animation 1s ease-in-out;
}

@keyframes th-animation {
0% { transform: translateX(-20px); opacity: 0; }
100% { transform: translateX(0); opacity: 1; }
}

  </style>
</head>
<body>
  <section id ="employers">
  <h1>Potential Employers </h1>
  <table>
    <thead>
      <tr>
        <th>Employer Name</th>
        <th>Employer Icon</th>
        <th>Salary</th>
        <th>Job Listings</th>
        <th>Open Applications</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($employers as $employers): ?>
        <tr>
          <td><?php echo $employers['employer_name']; ?></td>
          <td><?php echo $employers['employer_icon']; ?></td>
          <td><?php echo $employers['job_types']; ?></td>
          <td><?php echo $employers['current_applications']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </section>
  <section id ="job-types">
  <h1>Jobs and Current Expressions</h1>
  <table>
    <thead>
      <tr>
        <th>Job Type</th>
        <th>Employers</th>
        <th>Salary</th>
        <th>Locations</th>
        <th>Sequence</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($job_types as $job_type): ?>
        <tr>
          <td><?php echo $job_type['job_type']; ?></td>
          <td><?php echo $job_type['employers']; ?></td>
          <td><?php echo $job_type['salary']; ?></td>
          <td><?php echo $job_type['locations']; ?></td>
          <td><?php echo $job_type['sequence']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </section>

  <section id ="jobs">
  <h1>Jobs</h1>
  <table>
    <thead>
      <tr>
        <th>Job ID</th>
        <th>Employer Name</th>
        <th>Job Name</th>
        <th>Posted</th>
        <th>Applied</th>
        <th>Late</th>
        <th>Listing</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($job as $job): ?>
        <tr>
          <td><?php echo $job['job_id']; ?></td>
          <td><?php echo $job['employer_name']; ?></td>
          <td><?php echo $job['job_name']; ?></td>
          <td><?php echo $job['date_posted']; ?></td>
          <td><?php echo $job['date_applied']; ?></td>
          <td><?php echo $job['days_late']; ?></td>
          <td><?php echo $job['source_reference']; ?></td>
          <td><?php echo $job['status']; ?></td>

        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
</section>

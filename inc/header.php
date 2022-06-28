<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
</head>
<?php session_start() ;?>
<nav class="navbar navbar-expand-lg" style="background-color: #e2f4eb;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php
// Show the user he is logged in
if(isset($_SESSION['username'])){
            echo'<h6 style="text-align:right"> Welcome ' . $_SESSION['username'] . '</h6>';
        } ?>
<p style="text-align:right"><a class="btn btn-outline-success" href="logout.php"> Logout</a></p>

<?php
$servername = "localhost";
$username = "root";
$password = $error = $connectionStatus = '';
// Setup show to console
function debug_to_console($data) {
  $output = $data;
  if (is_array($output))
      $output = implode(',', $output);

  echo "<script>console.log('Connection Status: " . $output . "' );</script>";
}
//PDO connection
try {
  $conn = new PDO("mysql:host=$servername;dbname=blogDB", $username, $password);
  // Set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $connectionStatus = "Connected successfully";
} catch(PDOException $e) {
  $connectionStatus = "Connection failed: " . $e->getMessage();
}
// Show the connection status in console
debug_to_console($connectionStatus);
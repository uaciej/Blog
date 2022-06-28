<?php include 'inc/header.php';?>
<?php
//Check for input
if(isset($_POST['submit'])){
$username = filter_input(INPUT_POST,'username', FILTER_SANITIZE_SPECIAL_CHARS);
$password = $_POST['password'];
$password2 = $_POST['password2'];
//Check for errors
if($username == ''){
    $error = $error . "Username cannot be blank<br>";
}
if($password == ''){
    $error = $error . "Password cannot be blank<br>";
}
if($password != $password2){
    $error = $error . "Passwords don't match<br>";
}
if($password != '' && $password2 == ''){
    $error = $error . "Please, confirm your password<br>";
}
//Check if user is not yet registered
$sqlTables = $conn->prepare("SELECT username FROM users");
    $sqlTables->execute();
    $result = $sqlTables->setFetchMode(PDO::FETCH_ASSOC);
    $users = $sqlTables->fetchAll();
    foreach($users as $user){
        if($user['username'] == $username){
            $error = 'Username already used';
        }
    }
// Create a new user in the DB
$sql = "INSERT INTO users (username, password)
VALUES ('$username', '$password')";
if($error == ''){
    $conn->exec($sql);
    header('Location: /blog/login.php');
}}
?>
<body>
      
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="container-fluid">
            <label for="username">Username: </label>
            <input type="text" name="username">
        </div>
        <div class="container-fluid">
            <label for="password">Password: </label>
            <input type="password" name="password">
        </div>
        <div class="container-fluid">
            <label for="password">Confirm Password: </label>
            <input type="password" name="password2">
        </div>
        <input type="submit" value="Register" name="submit">
        <?php
        if ($error != ''){
            echo "<p style='color:red'> $error </p>";
        }
        ?>
    </form>
    <?php include 'inc/footer.php'; ?>
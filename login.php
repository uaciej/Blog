<?php include 'inc/header.php';?>

<?php
//Form submitted?
if(isset($_POST['submit'])){
$username = filter_input(INPUT_POST,'username', FILTER_SANITIZE_SPECIAL_CHARS);
$password = $_POST['password'];

//Checking for input errors:
if($username == ''){
    $error = $error . "Username cannot be blank<br>";
}
if($password == ''){
    $error = $error . "Password cannot be blank<br>";
}
$sqlTables = $conn->prepare("SELECT * FROM users WHERE username='$username' AND password='$password' ");
    $sqlTables->execute();
    $result = $sqlTables->setFetchMode(PDO::FETCH_ASSOC);
    $users = $sqlTables->fetchAll();
    if(empty($users)){
        $error = $error . 'Incorrect credentials';
    }
    else{
        $_SESSION['username']= $username;
        header('Location: /blog/index.php');
    }
}
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
        <input type="submit" value="Login" name="submit">
        <?php
        if ($error != ''){
            echo "<p style='color:red'> $error </p>";
        }
        ?>
    </form>
    
    <?php include 'inc/checker.php'; ?>
    <?php include 'inc/footer.php'; ?>
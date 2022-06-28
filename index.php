<?php include 'inc/header.php';?>
    <?php        
        $postErr = '';

        $sqlTables = $conn->prepare("SELECT posts.body, posts.time, users.username FROM posts 
        JOIN users ON posts.user_id = users.id");
        $sqlTables->execute();
        $result = $sqlTables->setFetchMode(PDO::FETCH_ASSOC);
        $posts = $sqlTables->fetchAll();
        foreach($posts as $post){
            echo '<div class="card"><div class="card-body">' . $post['body'] . '</div>
            <div class="card-footer">' . $post['username'] . '<h6>'. $post['time'] . '</h6></div></div>';
        }
    

    
if(isset($_POST['submit'])){
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $sqlTables = $conn->prepare("SELECT id FROM users WHERE '$username' = username");
        $sqlTables->execute();
        $result = $sqlTables->setFetchMode(PDO::FETCH_ASSOC);
        $userId = $sqlTables->fetchAll();
        $userID = $userId[0]['id'];
        $post = $_POST['body'];
        if(empty($_POST['body'])){
            $postErr = 'Nothing to post';
        }
        $sql = "INSERT INTO posts (user_id, body)
        VALUES ('$userID', '$post')";
            if($postErr == ''){
                $conn->exec($sql);
            }
    }
    else{
        $postErr = 'Please login or register first';
    }
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div class="mb-3">
        <label for="body" class="form-label"><h5>Create a new post</h5></label>
        <textarea class="form-control <?php echo $postErr ? 'is-invalid' : null; ?>" id="body" name ="body" rows="3"></textarea>
        <div class="invalid-feedback">
            <?php echo $postErr; ?>
        </div>
    <input type="submit" value="Post" name="submit">
    </div>
   
</form>

<?php include 'inc/footer.php'; ?>
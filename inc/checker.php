
    <?php
    $sqlTables = $conn->prepare("SELECT * FROM users");
    $sqlTables->execute();
    $result = $sqlTables->setFetchMode(PDO::FETCH_ASSOC);
    $users = $sqlTables->fetchAll();
    foreach($users as $user){
        echo $user['username']. ' '. $user['password'] . '<br>';
    }
    ?>
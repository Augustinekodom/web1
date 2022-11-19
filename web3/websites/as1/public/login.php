<?php 
session_start();
require 'nav.php';
require 'setup.php';

if (isset($_POST['submit'])) {
    //Query the data base to check for matching details

    $stmt = $pdo->prepare('SELECT * FROM user WHERE email = :email'); 
    $values = ['email' => $_POST['email']];
    $stmt->execute($values);
    $user = $stmt->fetch();
    $link = 'addAuction.php';

    if(is_array($user)){

        if (password_verify($_POST['password'], $user['password'])) { 
            $_SESSION['loggedin'] = $user['userId'];
            $_SESSION['level'] = $user['level'];
            $sessionId = $_SESSION['loggedin'];
            echo 'welcome, you are logged in';
            echo '<a href="'.$link.'"><h3>' . 'Add Auction' . '</h3></a>';
            //Check if session id is being logged correctly
            echo "<script>console.log('$sessionId');</script>";
            
        } 
        }
        else {
            echo 'Sorry, your account could not be found';}}

        
?>
<h1>Login</h1>
<form action="login.php" method="POST">
    <input type="email" name="email" placeholder="E-mail">
    <input type="password" name="password" placeholder="Password">
    <button type="submit" name="submit">Login</button>
</form>


<?php

require 'footer.php';
//require 'setup.php';

?>
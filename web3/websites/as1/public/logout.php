<?php 
session_start();
if(isset($_SESSION['loggedin'])){
    include 'setup.php';

    unset($_SESSION['loggedin']);
    $newURL = 'login.php';
    header('Location: '.$newURL);
}
else{
    $newURL = 'login.php';
    header('Location: '.$newURL);
}
?>

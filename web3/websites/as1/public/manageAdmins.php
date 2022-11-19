<?php
session_start();
//if(isset($_SESSION['loggedin']) AND $_SESSION['level']== '2'){
    require 'functions.php';
    require 'nav.php';
    include 'setup.php';

$recordOfAdmins = find($pdo,'user','level','2');
foreach($recordOfAdmins as $adminRow){
     echo'<h3><label>name:</label><h3>';
     echo'<h4>'.$adminRow['name'].' </h4>';
    echo'<h3><label>email:</label></h3>';
    echo'<h4>'.$adminRow['email'].' </h4>';
    echo'<form action=editAdmin.php?id='.$adminRow['userId'].' method="POST">';
    echo'<input type="submit" name="editAdmin" value="Edit Account">';
    echo'</form>';

    echo'<form action=deleteAdmin.php?id='.$adminRow['userId'].' method="POST">';
    echo'<input type="submit" name="deleteAdmin" value="Delete Account">';
    echo'</form>';

}

/* }
else{
    $newURL = 'login.php';
    header('Location: '.$newURL);
}
 */
?>
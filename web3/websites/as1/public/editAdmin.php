<?php
session_start();
if(isset($_SESSION['loggedin']) AND $_SESSION['level']== '2'){
    require 'functions.php';
    require 'nav.php';
    include 'setup.php';

if(isset($_GET['id'])){
    $recordOfAdmin = find($pdo,'user','userId',$_GET['id']);
    $rowOfAdmin = $recordOfAdmin[0];

echo'
<h1>update Admin</h1>
<form action="editAdmin.php" method="POST">

    <input type="text" name="adminName" value="'.$rowOfAdmin['name'].'">
    <input type="text" name="adminEmail" value="'.$rowOfAdmin['email'].'">
    <input type="text" name="accountLevel" value="'.$rowOfAdmin['level'].'">
    <input type=password name=password value="'.$rowOfAdmin['password'].'">
    <input type="hidden" name="userId" value="'.$rowOfAdmin['userId'].'">';


echo '
    <button type="submit" name="submit">update Admin</button>

</form>';
}
if(isset($_POST['submit'])){
    $data = [
        'userId' => $_POST['userId'],
        'name' => $_POST['adminName'],
        'email' => $_POST['adminEmail'],
        'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
        'level' => $_POST['accountLevel']
    ];
    update($pdo,'user',$data,'userId');
    echo'<h2>Admin updated</h2>';
    echo'<a href="manageAdmins.php" >Manage Admins </a>';
    
    

}
include 'footer.php';

}
else{
    $newURL = 'login.php';
    header('Location: '.$newURL);
}
?>
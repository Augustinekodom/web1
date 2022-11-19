<?php
session_start();
if(isset($_SESSION['loggedin']) AND $_SESSION['level']== '2'){
    require 'functions.php';
    require 'nav.php';
    include 'setup.php';
echo'
<h1>Add Admin</h1>
<form action="addAdmin.php" method="POST">

    <input type="text" name="adminName" placeholder="admin Name">
    <input type="text" name="adminEmail" placeholder="admin Email">
    <input type=password name=password placeholder="password">';


echo '
    <button type="submit" name="submit">Add Admin</button>

</form>';

if(isset($_POST['submit'])){
    $data = [
        'name' => $_POST['adminName'],
        'email' => $_POST['adminEmail'],
        'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
        'level' => '2'
    ];
    if(insert($pdo,'user',$data)){
        echo'<h2>Admin Added</h2>';
    }
    
    

include 'footer.php';
}

}
else{
    $newURL = 'login.php';
    header('Location: '.$newURL);
};


?>
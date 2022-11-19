<?php 
session_start();
if(isset($_SESSION['loggedin']) AND $_SESSION['level']== '2'){
include 'setup.php';
//require 'functions.php';

function delete($pdo, $table, $id) {
	$stmt = $pdo->prepare('DELETE FROM ' . $table . ' WHERE userId = :userId');
	$criteria = [
		'userId' => $id
	];
	$stmt->execute($criteria);
}

if (isset($_POST['deleteAdmin'])) {
$userId = $_GET['id'];
$stmt2 = $pdo->prepare('SET FOREIGN_KEY_CHECKS = 0');
$stmt2->execute();
delete($pdo,'user',$_GET['id']);
$stmt2 = $pdo->prepare('SET FOREIGN_KEY_CHECKS = 1');
$stmt2->execute();
//unset($_SESSION['catId']);
$newURL = 'manageAdmins.php';
header('Location: '.$newURL);

}
else{
    echo'failed deleting :/';
};
}
else{
    $newURL = 'login.php';
    header('Location: '.$newURL);
}

?>
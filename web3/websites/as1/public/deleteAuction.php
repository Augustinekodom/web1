<?php 
session_start();
include 'setup.php';
//require 'functions.php';

function delete($pdo, $table, $id) {
	$stmt = $pdo->prepare('DELETE FROM ' . $table . ' WHERE auctionId = :auctionId');
	$criteria = [
		'auctionId' => $id
	];
	$stmt->execute($criteria);
}

if(isset($_SESSION['loggedin'])){
    if (isset($_POST['deleteAuctionBtn'])) {
    $deletingAuctionId = $_GET['id'];
    $stmt2 = $pdo->prepare('SET FOREIGN_KEY_CHECKS = 0');
    $stmt2->execute();
    delete($pdo,'auction',$deletingAuctionId);
    $stmt2 = $pdo->prepare('SET FOREIGN_KEY_CHECKS = 1');
    $stmt2->execute();

    $newURL = 'index.php';
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
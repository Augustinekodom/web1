<?php 
session_start();
include 'setup.php';

//bidAmount
$bidAmount = $_POST['bidAmount'];
//auctionId
$auctionId = $_GET['id'];
//userId
$userId = $_SESSION['loggedin'];
//bidDate
$bidDate = date('Y-m-d H:i:s');

function insert($pdo, $table, $record) {
    $keys = array_keys($record);

    $values = implode(', ', $keys);
    $valuesWithColon = implode(', :', $keys);

    $query = 'INSERT INTO ' . $table . ' (' . $values . ') VALUES (:' . $valuesWithColon . ')';

    $stmt = $pdo->prepare($query);

    $stmt->execute($record);
};

$data = [
    'bidAmount' => $bidAmount,
    'auctionId' => $auctionId,
    'userId' => $userId,
    'bidDate' => $bidDate
];

insert($pdo,'bid',$data);
unset($_SESSION['auctionId']);
$newURL = 'auction.php?id='.$auctionId.'';
header('Location: '.$newURL);







?>

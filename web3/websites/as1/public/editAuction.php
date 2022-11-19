<?php 
session_start();
if(isset($_SESSION['loggedin'])){
require 'nav.php';
include 'setup.php';


function find($pdo, $table, $field, $value) {
	$stmt = $pdo->prepare('SELECT * FROM ' . $table . ' WHERE ' . $field . ' = :value');

	$criteria = [
		'value' => $value
	];
	$stmt->execute($criteria);

	return $stmt->fetchAll();
}



function update($pdo, $table, $record, $primaryKey) {
	$query = 'UPDATE ' . $table . ' SET ';
	$parameters = [];

	foreach ($record as $key => $value) {
		$parameters[] = $key . ' = :' .$key;
	}

	$query .= implode(', ', $parameters);
	$query .= ' WHERE ' . $primaryKey . ' = :primaryKey';
	$record['primaryKey'] = $record[$primaryKey];
	
	$stmt = $pdo->prepare($query);
	$stmt->execute($record);
}

if (isset($_POST['editAuctionBtn'])) {
    $editingAuction = $_GET['id'];

    $recordOfAuction = find($pdo,'auction', 'auctionId', $editingAuction);
    $rowOfAuction = $recordOfAuction[0];
    $auctionTitle = $rowOfAuction['title'];
    $auctionDescription = $rowOfAuction['description'];
    $auctioncategoryId = $rowOfAuction['categoryId'];
    $auctionEndDate = trim($rowOfAuction['endDate'],  " 00:00:00");

    //fetch the categorise from database and put into slect dropdown.
    $stmt = $pdo->prepare('SELECT categoryId, name FROM category');
    $stmt->execute();

    

    echo'<h1>Edit Auction</h1>';
    echo'<form action=editAuction.php?id='.$editingAuction.' method="POST"/>';
    echo'<label>Auction Title:</label>';
    echo'<input type="text" name="title" value="'.$auctionTitle.'">';
    echo'<label>Auction Category:</label>';
    echo '<select name="category" value="'.$auctioncategoryId.'>';
    while ($category = $stmt->fetch()) {
        echo '<option value="' . $category['categoryId'] . '">' . $category['name'] .'</option>';
        }
   
  
    echo '</select>';
    echo'<label>Auction End Date:</label>';
    echo '<input type="date" name="endDate" value="'.$auctionEndDate.'">';
    echo'<label>Auction Description:</label>';
    echo '<input type="text" name="description" value="'.$auctionDescription.'">';
   
    echo'<input type="submit" name="updateAuction" >';
    echo'</form>';
}

if (isset($_POST['updateAuction'])) {
    $auctionId = $_GET['id'];
    $newAuctionTitle = $_POST['title'];
    $newAuctionCategoryId = $_POST['category'];
    $newAuctionEndDate = $_POST['endDate'];
    $newAuctionDescription = $_POST['description'];
    $newAuctionAuthorId = $_SESSION['loggedin'];
    $values = [
        'auctionId' => $auctionId,
        'title' => $newAuctionTitle,
        'categoryId' => $newAuctionCategoryId,
        'endDate' => $newAuctionEndDate,
        'description' => $newAuctionDescription,
        'auctionAuthorId' => $newAuctionAuthorId
	];
    update($pdo,'auction',$values,'auctionId');
    echo'Auction Updated with no errors';
    echo'<a href="editAuction.php?id='.$auctionId.'">Click here to go back</a>';

};
require 'footer.php';}
else{
    $newURL = 'login.php';
    header('Location: '.$newURL);
}
?>
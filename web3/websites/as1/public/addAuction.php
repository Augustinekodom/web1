<?php 
session_start();
if(isset($_SESSION['loggedin'])){
require 'nav.php';
include 'setup.php';


//fetch the categorise from database and put into slect dropdown.
$stmt = $pdo->prepare('SELECT categoryId, name FROM category');
$stmt->execute();

echo'
<h1>Add Auction</h1>
<form action="addAuction.php" method="POST">

    <input type="text" name="title" placeholder="Title">';

echo '<select name="category">';
while ($category = $stmt->fetch()) {
echo '<option value="' . $category['categoryId'] . '">' . $category['name'] .'</option>';
}
echo '</select>';
echo '
    <input type="date" name="endDate" placeholder="Auction End Date">
    <input type="text" name="description" placeholder="Description">
    <button type="submit" name="submit">Post Auction</button>

</form>';


if (isset($_POST['submit'])) {
    unset($_POST['submit']);//Remove submit value from array
	$stmt = $pdo->prepare('INSERT INTO auction (title, description , categoryId,  endDate, auctionAuthorId)
						   VALUES ( :title, :description, :categoryId,  :endDate, :auctionAuthorId)');
    
    
    $values = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
		'categoryId' => $_POST['category'],
        'endDate' => $_POST['endDate'],
        'auctionAuthorId' => $_SESSION['loggedin']
	];
	
    $stmt->execute($values);

echo "Auction Posted!!";}
}
else{
    $newURL = 'login.php';
    header('Location: '.$newURL);
}

require 'footer.php';
?>
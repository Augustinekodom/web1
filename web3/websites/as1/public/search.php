<?php
include 'setup.php';
require 'nav.php';
include 'functions.php';
$searchTerm = $_GET['searchSpace'];

$stmt = $pdo->prepare("SELECT * FROM auction WHERE title + description  LIKE '%".$searchTerm."%'");
$stmt->execute();
$rowOfResults = $stmt->fetch();

while ($rowOfResults = $stmt->fetch()){
    echo'<label>Aution Title</label>';
    echo'<h3>'.$rowOfResults['title'].'<h3>';
    echo'<a href=auction.php?id='.$rowOfResults['auctionID'].'>View Auction</a>';
}
?>
<?php 
require 'nav.php';
include 'setup.php';
require 'functions.php';
$id = $_GET['id'];


$allAuction = find($pdo, 'auction', 'categoryId', $id);
//$allAuctionRec = $allAuction[0];
//if($allAuction)
if (count($allAuction) >0){
$title1 = $allAuction[0];
$title2 = $title1['title'];
$testVar = is_null($allAuction);
echo "<script>console.log('$testVar');</script>";




$stmt = $pdo->prepare('SELECT auctionId, title, description, categoryId FROM auction WHERE categoryId = ?');
$array = array($_GET['id']);
$stmt->execute($array);



$stmt2 = $pdo->prepare('SELECT name FROM category WHERE categoryId = ?');
$values = array($_GET['id']);
$stmt2->execute($values);
$categoryName = $stmt2->fetch();

/* $stmt3 = $pdo->prepare('SELECT MAX ( bidAmount ) AS largestBid FROM bid WHERE auctionId = ?');
$values2 = array($auction['auctionId']);
$stmt3->execute($values2);
$row = mysql_fetch_array( $stmt3 );
$largestBid = $row['largestBid']; */


// $rowSQL = mysql_query( "SELECT MAX( ID ) AS max FROM `tableName`;" );
// $row = mysql_fetch_array( $rowSQL );
// $largestNumber = $row['max'];


    echo'<h1>Latest Listings / Search Results / Category listing</h1>
    <ul class="productList">';
    while ($auction = $stmt->fetch()) {
    echo'<li>
    <img src="product.png" alt="product name">
    <article>
        <h2>'. $auction['title'] . '</h2>';
    echo'<h3>'.$categoryName['name'].'</h3>';
    echo'    <p>'.$auction['description'].'</p>';
    //$stmt3 = $pdo->prepare('SELECT MAX ( bidAmount )  FROM bid WHERE auctionId = :auctionId');
    $auction_ID_ID = $auction['auctionId'];
    $stmt3 = $pdo->prepare("SELECT `bidAmount` FROM bid WHERE auctionId = '$auction_ID_ID' ORDER BY `bidAmount` DESC LIMIT 1");
    //$values = ['auctionId' => $auction['auctionId']];)
    
    $stmt3->execute();
    $row = $stmt3->fetch();
    if ($row == false || is_null($row[0])){
        $largestBid = 'No Bid Yet';
    }
    else{$largestBid = $row[0];};
    
    $aution_ID = $auction['auctionId'];
    $moreLink = 'auction.php?id='.$aution_ID;

    echo '<a  class = "more auctionLink" href="'. $moreLink . '">  ' . 'More &gt;&gt;' . '</a>';
    echo'    <p class="price">Current bid: £' . $largestBid . '</p>';
    echo'  </article>
        </li>';}
    echo'</ul>';
}
    else{
        echo'<h1> No Auction For this category yet</h1>';
    };
?>

<?php
require 'footer.php';
?>
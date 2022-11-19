<?php 
session_start();
require 'nav.php';
include 'setup.php';
require 'functions.php';

$id = $_GET['id'];

$allAuction = find($pdo, 'auction', 'auctionId', $id);
$recordOfAuction = $allAuction[0];
$categoryName = find($pdo, 'category','categoryId',$recordOfAuction['categoryId'] );
$recordOfCategory = $categoryName[0];


//$recordOfAuction2 = $recordOfAuction['title'];

//echo "<script>console.log('$title2');</script>";
echo'<ul class="productList">';
echo'<h1> Auction </h1>';

echo'<section class="product">';
    echo'<li>';
    echo'<h3> title: '. $recordOfAuction['title'] . '</h3><br></br>';
    echo'<h3> description: '. $recordOfAuction['description'] . '</h3><br></br>';
    //https://stackoverflow.com/questions/1735252/php-countdown-to-date
    $timeLeft = strtotime($recordOfAuction['endDate']) - time();
    $day = floor($timeLeft / 86400);
    $hours  = floor(($timeLeft % 86400) / 3600);
    $min = floor(($timeLeft % 3600) / 60);
    $seconds = ($timeLeft % 60);
    echo'<br><br><h3>';
    if($day) echo "$day Days ";
    if($hours) echo "$hours Hours ";
    if($min) echo "$min Minutes ";
    if($seconds) echo "$seconds seconds"; 
    echo'</h3>';
    echo'<br><h3> Category: '. $recordOfCategory['name'] . '</h3><br></br>';
    echo'</li>';
echo'</section>';

echo'</ul>';

//add reviews here
$allAuctionReviews = find($pdo,'review','auctionId',$id);
foreach ( $allAuctionReviews as $recordOfreview){
    echo'<section class="reviews">';
    echo'<ul>';
    echo'<li>';
    echo'<label>Reviewee Email:</label>';
    echo'<h4>'.$recordOfreview['reviweeEmail'].'</h4>';
    echo'<label>Review Text:</label>';
    echo'<h4>'.$recordOfreview['reviewText'].'</h4>';
    echo'<label>Review Date:</label>';
    echo'<h4>'.$recordOfreview['reviewDate'].'</h4>';
    echo'</li>';
    echo'</ul>';
    echo'</section>';
}


if(isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin'])) {
    $auction__Id = $recordOfAuction['auctionId'];
    $moreLink = 'addReview.php?id='.$auction__Id;
    $moreLink2 = 'placeBid.php?id='.$auction__Id;
    echo'<form action="'.$moreLink.'">';



    echo'<label>Add your review</label>';
    echo '<textarea name="reviewtext"></textarea>';

    echo'<input type="submit" name="submit" value="Add Review" />
</form>';


    $_SESSION['auctionId'] = $auction__Id;

     //bid form

 echo'<label>Place Bid</label><br>';
 echo'<form action="placeBid.php?id='.$_GET['id'].'"method="POST">';
 echo'<input type="text" name="bidAmount" placeholder="Enter Bid Amount"/>';
 echo'<input type="submit" name="submit" value="Place Bid" />
</form>';
 };

if(isset($_SESSION['loggedin'])){
if($_SESSION['loggedin'] == $recordOfAuction['auctionAuthorId']){
    $editingAuction = $_GET['id'];
    echo'<br><br>';
    echo'<form action=editAuction.php?id='.$editingAuction.' method="POST"/>';
    echo'<input type="submit" name="editAuctionBtn"value="Edit"/>';
    echo'</form>';

    echo'<form action=deleteAuction.php?id='.$editingAuction.' method="POST"/>';
    echo'<input type="submit" name="deleteAuctionBtn" value="Delete" Auction/>';
    echo'</form>';
}
}
else{
    echo'<h2>please login to Add an Review or Place Bid</h2>';
    echo'<a hoursef="login.php">Login</a>';
};

require 'footer.php';
?>
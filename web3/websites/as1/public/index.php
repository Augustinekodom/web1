<?php 

require 'nav.php';
include 'setup.php';

?>

<?php

    $stmt = $pdo->prepare("SELECT * FROM auction ORDER BY `endDate` ASC LIMIT 10 "); 
    $stmt->execute();
    $stmt->fetch();
    


echo'<h1> Listings Ending Soon </h1>';
echo'<ul class="productList">';

while ($lastTen = $stmt->fetch()){
    echo'<li>';
    echo'<h3>'. $lastTen['title'] . '</h3>';
    echo'<h3>'. $lastTen['endDate'] . '</h3>';
    echo'</li>';
}

echo'</ul>';

?>

<?php
require 'footer.php';
?>
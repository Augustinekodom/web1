<?php 
session_start();
if(isset($_SESSION['loggedin'])){
    //require 'nav.php';
    include 'setup.php';

    // reviweeEmail -> get userId from $SESSION & query for email where userId == userId, reviewText-> get from $_POST['reviewText'], auctionId-> get from url , reviewDate-> use current date

    $loggedUserId = $_SESSION['loggedin'];
    //$sessionId = $_SESSION['loggedin'];

    function find($pdo, $table, $field, $value) {
        $stmt = $pdo->prepare('SELECT * FROM ' . $table . ' WHERE ' . $field . ' = :value');

        $criteria = [
            'value' => $value
        ];
        $stmt->execute($criteria);

        return $stmt->fetchAll();
    };
    function insert($pdo, $table, $record) {
        $keys = array_keys($record);

        $values = implode(', ', $keys);
        $valuesWithColon = implode(', :', $keys);

        $query = 'INSERT INTO ' . $table . ' (' . $values . ') VALUES (:' . $valuesWithColon . ')';

        $stmt = $pdo->prepare($query);

        $stmt->execute($record);
    };

    $loggedUserEmail = find($pdo, 'user', 'userId', $loggedUserId );
    $recordOfUser = $loggedUserEmail[0];

    //-----EMAIL---------
    $reviweeEmail = $recordOfUser['email'];

    //------Review Text-------
    if (isset($_GET['submit'])) {
        $reviewText = $_GET['reviewtext'];
    };

    //------Auction Id-------
    $auctionId = $_SESSION['auctionId'];

    //------Review date-------
    $reviewDate = date('Y-m-d H:i:s');

    $data = [
        'reviweeEmail' => $reviweeEmail,
        'reviewText' => $reviewText,
        'auctionId' => $auctionId,
        'reviewDate' => $reviewDate
    ];

    insert($pdo,'review',$data);
    $newURL = 'auction.php?id='.$auctionId.'';
    //https://stackoverflow.com/questions/768431/how-do-i-make-a-redirect-in-php

    unset($_SESSION['auctionId']);

    header('Location: '.$newURL);
}
else{
    $newURL = 'login.php';
    header('Location: '.$newURL);
};

?>
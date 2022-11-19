<?php 
session_start();
if(isset($_SESSION['loggedin']) AND $_SESSION['level']== '2'){
include 'setup.php';

function delete($pdo, $table, $id) {
	$stmt = $pdo->prepare('DELETE FROM ' . $table . ' WHERE categoryId = :categoryId');
	$criteria = [
		'categoryId' => $id
	];
	$stmt->execute($criteria);
}

if (isset($_POST['deleteCategoryBtn'])) {
$deletingCategoryId = $_GET['id'];
delete($pdo,'category',$deletingCategoryId);

//unset($_SESSION['catId']);
$newURL = 'adminCategories.php';
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
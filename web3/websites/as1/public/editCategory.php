<?php 
session_start();
if(isset($_SESSION['loggedin']) AND $_SESSION['level']== '2'){
require 'nav.php';
include 'setup.php';
require 'functions.php';



if (isset($_POST['editCategoryBtn'])) {
    $editingCategoryId = $_GET['id'];

    $recodOfCategory = find($pdo,'category', 'categoryId', $editingCategoryId);
    $categoryName = $recodOfCategory[0];
    $categoryName1 = $categoryName['name'];
    echo'<h1>Edit Category</h1>';
    echo'<form action=editCategory.php?id='.$editingCategoryId.' method="POST"/>';
    echo'<label>Category Name:</label>';
    echo'<input type=text name="newCategoryName" value="'.$categoryName1.'">';
    echo'<input value="Edit" type="submit" name="updateCategory" >';
    echo'</form>';
}

if (isset($_POST['updateCategory'])) {
    $categoryId = $_GET['id'];
    $values = [
        'categoryId' => $categoryId,
        'name' => $_POST['newCategoryName'],
	];
    update($pdo,'category',$values,'categoryId');
    echo'Category Updated with no errors';
    echo'<a href="adminCategories.php">Click here to go back</a>';

}
require 'footer.php';
}
else{
    $newURL = 'login.php';
    header('Location: '.$newURL);
}
?>
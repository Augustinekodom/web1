<?php 
session_start();
if(isset($_SESSION['loggedin']) AND $_SESSION['level']== '2'){
require 'nav.php';
include 'setup.php';
require 'functions.php';

$allCategories = findAll($pdo, 'category');

//$categoryId = $recordOfCategory['categoryId'];

echo'<h1> Categories</h1>';
echo'<ul>';
foreach($allCategories as $recordOfCategory ){
echo'<label>Category Name:</label>';
echo'<li>'.$recordOfCategory['name'].'</li>';
echo'<form action="deleteCategory.php?id='.$recordOfCategory['categoryId'].'" method="POST">'; 
echo'<button type="submit" name="deleteCategoryBtn">Delete</button>';
echo'</form>';
echo'<form action="editCategory.php?id='.$recordOfCategory['categoryId'].'" method="POST">'; 
echo'<button type="submit" name="editCategoryBtn">Edit</button>';
echo'</form>';
};
echo'</ul>';

require 'footer.php';
}


else{
    $newURL = 'login.php';
    header('Location: '.$newURL);
    debug_to_console($_SESSION['loggedin']);
    debug_to_console($_SESSION['level']);
}
?>
<?php 
session_start();
if(isset($_SESSION['loggedin']) AND $_SESSION['level']== '2'){
require 'nav.php';
include 'setup.php';

function findAll($pdo, $table) {
	$stmt = $pdo->prepare('SELECT * FROM ' . $table);

	$stmt->execute();

	return $stmt->fetchAll();
}

function insert($pdo, $table, $record) {
    $keys = array_keys($record);

    $values = implode(', ', $keys);
    $valuesWithColon = implode(', :', $keys);

    $query = 'INSERT INTO ' . $table . ' (' . $values . ') VALUES (:' . $valuesWithColon . ')';

    $stmt = $pdo->prepare($query);

    $stmt->execute($record);
}


$allCategory = findAll($pdo,'category');
echo'<h1>All Categories</h1>';
foreach($allCategory as $recordOfCategory){
    
    echo'<ul>';
    echo'<h2>'.$recordOfCategory['name'].'</h2>';
    echo'</ul>';
}
echo'
<h1>Add Category</h1>
<form action="addcategory.php" method="POST">
    <input type="text" name="categoryName" placeholder="Category Name">
    <button type="submit" name="submit">Add Category</button>
</form>';

if (isset($_POST['submit'])) {
    $data = [
        'name' => $_POST['categoryName']
    ];
    insert($pdo,'category',$data);
    echo "Category Added!!";
    echo'<a href=addCategory.php>click here To see update</a>';
}




require 'footer.php';
}
else{
    $newURL = 'login.php';
    header('Location: '.$newURL);
}
?>
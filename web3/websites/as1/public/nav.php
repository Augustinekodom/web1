<?php 
include 'setup.php';
//fetch the categorise from database and put into slect dropdown.

$stmt = $pdo->prepare('SELECT categoryId, name FROM category');
$stmt->execute();
//$category = $stmt->fetch();
?>


<!DOCTYPE html>
<html>
	<head>
		<title>ibuy Auctions</title>
		<link rel="stylesheet" href="ibuy.css" />
	</head>

	<body>
		<header>
			<h1><span class="i">i</span><span class="b">b</span><span class="u">u</span><span class="y">y</span></h1>

			<?php 
	
			echo'<form action="search.php?search=" method="GET">
		
			
				<input type="text" name="searchSpace" placeholder="Search for anything" />
				<input type="submit" name="submit" value="Search" />
			</form>'; 
			?>
		</header>

		<nav>
			<ul>
			<li><a href="login.php">Login</a></li>
			<?php
			while($category = $stmt->fetch()) {
			echo '<li><a class="categoryLink" href="category.php?id=' . $category['categoryId'] . '">' . $category['name'] .'</a>';
			};

			
			//echo'<li><a class="categoryLink" href="#">Electronics</a></li>'
			

			?>	
				
				
			</ul>
		</nav>
		<img src="banners/1.jpg" alt="Banner" />

		<main>

		<?php
		
		?>
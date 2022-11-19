<?php 

require 'nav.php';
require 'setup.php';

?>
<h1>Register</h1>
<form action="register.php" method="POST">
    <label>Email</label>
    <input type="email" name="email" placeholder="E-mail">
    <label>Password</label>
    <input type="password" name="password" placeholder="Password">
    <label>Name</label>
    <input type="text" name="displayName" placeholder="Name">
    <label>Admin?</label>
    <input type="checkbox" name="./">
    <button type="submit" name="submit">Sign Up</button>

</form>

<?php 
require 'footer.php';

if (isset($_POST['submit'])) {
    if(isset($_POST['level'])){
        $userLevel = '2';
    }
    else{
        $userLevel = '1';
    };
    unset($_POST['submit']);//Remove submit value from array
	$stmt = $pdo->prepare('INSERT INTO user(email, password, name,level)
						   VALUES ( :email, :password, :name, :level)');
    
    
    $values = [
		'email' => $_POST['email'],
		'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
        'name' => $_POST['displayName'],
        'level' => $userLevel
	];
	
    $stmt->execute($values);
    $variable = sha1($_POST['password']);
echo "<script>console.log('$variable');</script>";
}
?>


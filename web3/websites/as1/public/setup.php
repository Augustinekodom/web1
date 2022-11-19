<?php

$server = 'mysql';
$username = 'student';
$password = 'student';

$schema = 'Y3WEB';
$pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password);

?>
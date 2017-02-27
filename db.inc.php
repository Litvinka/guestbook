
<?php

	$dbhost = "localhost";
	$dbuser = "root";
	$dbpassword = ""; 
	$dbname = "guestbook";
	try{
	$pdo = new PDO("mysql:host=localhost;dbname=guestbook", $dbuser, $dbpassword);
	//$pdo=setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec('SET NAMES "utf8"');
	}
	catch(PDOException $e){
		exit('No connection with database');
	}

?>
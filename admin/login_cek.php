<?php
	
	include "../dbinfo.php";
	$uname = $_POST["username"];
	$pwd = $_POST["password"];

	$sql = "SELECT * FROM users WHERE email=:uname and password=:pwd and status=0";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam('uname', $uname);
	$stmt->bindParam('pwd', $pwd);
	$stmt->execute();
	$count = $stmt->rowCount();
	
	if ($count > 0) {
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$token_expired = date('Y-m-d H:i:s', strtotime('+1 hour'));
		
		session_start();
		$_SESSION["idx_user"] = $result["id"];
		$_SESSION["email"] = $result["email"];
		$_SESSION["pp"] = $result["picture"];
		$_SESSION["nama"] = $result["first_name"]." ".$result["last_name"];
		$_SESSION["token_expired"] = $token_expired;
		$_SESSION["isAdmin"] =  $result["isAdmin"];
		
		header('Location: dashboard.php');
		
		
	} else {
		session_start();
		session_unset();
		session_destroy();
		header('Location: index.php');
	}
?>
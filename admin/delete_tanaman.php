<?php
    include "../dbinfo.php";
	include "cek_session.php";
	
	if ($_GET["idx"]=='') {
		header('Location: data_tanaman.php');
	}
	
	try{
		$query = $conn->prepare("update markers set status=0, modifydate=:tgl where idx=:idx_pohon and idx_user=:idx_user");
		$data = array(
			':idx_pohon' => $_GET["idx"],
			':idx_user' => $idx_user,
			':tgl' => date('Y-m-d h:i:s')
		);
		$query->execute($data);
		
		header('Location: data_tanaman.php');
	}catch(PDOException $e){
		echo $e->getMessage();
	}
?>
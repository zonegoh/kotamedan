<?php
    include "../dbinfo.php";
	
	require "../vendor/autoload.php";

	$s3 = new Aws\S3\S3Client([
		'region'  => 'us-east-2',
		'version' => 'latest',
		'credentials' => [
			'key'    => "AKIAITNCENDQ7QMCR7IQ",
			'secret' => "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",
		]
	]);		

	$s3->deleteObject([
		'Bucket' => 'kotamedan',
		'Key'    => basename($_GET['gambar'])
	]);
		

	try{
		$query = $conn->prepare("delete from markers_update where id=:id");
		$data = array(
		':id' => $_GET['id']
		);
		$query->execute($data);
		header('Location: form_update_tanaman.php?idx='.$_GET['idx']);
	}catch(PDOException $e){
		echo $e->getMessage();
	}
	
    

?>
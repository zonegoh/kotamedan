<?php
    include "../dbinfo.php";
	$tmp_file = $_FILES['gambar']['tmp_name'];
	$gambar=$_POST['t_gambar'];
	
	
	if ($tmp_file!='') {
		$file_name = 'TM_'.$_POST['idx'].'_'.str_replace(' ', '_', $_FILES['gambar']['name']);
		
		require '../vendor/autoload.php';

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
			'Key'    => basename($gambar)
		]);
		
		$result = $s3->putObject([
			'ACL'	=> 'public-read',
			'Bucket' => 'kotamedan',
			'Key'    => $file_name,
			'SourceFile' => $tmp_file			
		]);
		
		$gambar = $result['ObjectURL'];
	} 

    try{
		//var_dump(date('Y-m-d h:i:s'));
		//die();
		$tgl = date('Y-m-d h:i:s');
		$query = $conn->prepare("update markers set name=:name, address=:address, lat=:lat, lng=:lng, dob=:dob, gambar=:gambar, idx_penanam=:penanam, modifydate=:tgl where idx=:idx");
		$data = array(
		':name' => $_POST['t_nama'],
		':address' => $_POST['t_alamat'],
		':lat' => $_POST['t_lat'],
		':lng' => $_POST['t_lng'],
		':dob' => $_POST['t_dob'],
		':penanam' => $_POST['p_id'],
		':gambar' => $gambar,
		':tgl' => $tgl,
		':idx' => $_POST['idx']
		);
		$query->execute($data);
		header('Location: data_tanaman.php');
	}catch(PDOException $e){
		echo $e->getMessage();
	}
	
?>
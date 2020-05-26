<?php
    include "../dbinfo.php";
	$tmp_file = $_FILES['gambar']['tmp_name'];
	$gambar=$_POST['p_gambar'];
	
	
	if ($tmp_file!='') {
		$file_name = 'PP_'.$_POST['p_idx'].'_'.str_replace(' ', '_', $_FILES['gambar']['name']);
		
		require '../vendor/autoload.php';
		
		$s3 = new Aws\S3\S3Client([
			'region'  => 'us-east-2',
			'version' => 'latest',
			'credentials' => [
				'key'    => "AKIAITNCENDQ7QMCR7IQ",
				'secret' => "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",
			]
		]);		

		$result = $s3->putObject([
			'ACL'	=> 'public-read',
			'Bucket' => 'kotamedan',
			'Key'    => $file_name,
			'SourceFile' => $tmp_file			
		]);
		
		$s3->deleteObject([
			'Bucket' => 'kotamedan',
			'Key'    => basename($gambar)
		]);
		
		$gambar = $result['ObjectURL'];
		
	} 

    try{
		$tgl = date('Y-m-d h:i:s');
		$query = $conn->prepare("update penanam set name=:name, alamat=:alamat, dob=:dob, ktp=:ktp, email=:email, phone=:phone, gambar=:gambar, pekerjaan=:pekerjaan, modifydate=:modifydate where idx=:idx");
		$data = array(
		':name' => $_POST['p_nama'],
		':alamat' => $_POST['p_alamat'],
		':dob' => $_POST['p_dob']?$_POST['p_dob']:'1990-01-01',
		':ktp' => $_POST['p_ktp'],
		':email' => $_POST['p_email'],
		':phone' => $_POST['p_phone'],
		':gambar' => $gambar,
		':pekerjaan' => $_POST['p_pekerjaan'],
		':idx' => $_POST['p_idx'],
		':modifydate' => $tgl
		);
		$query->execute($data);
		header('Location: data_penanam.php');
		
	}catch(PDOException $e){
		echo $e->getMessage();
		sleep(5);
		//header('Location: data_penanam.php');
	}
?>
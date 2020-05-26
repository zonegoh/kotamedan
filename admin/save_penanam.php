<?php
    include "../dbinfo.php";
    include "cek_session.php";
	
	//$crc = abs(crc32(date('Y-m-d h:i:sa')));
	$crc = date('Ymdhis');
	$tmp_file = $_FILES['gambar']['tmp_name'];
	$gambar='https://kotamedan.s3.us-east-2.amazonaws.com/JXcjgHQ.png';
	
	if ($tmp_file!='') {
		$file_name = 'PP_'.$crc.'_'.str_replace(' ', '_', $_FILES['gambar']['name']);
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
		
		$gambar = $result['ObjectURL'];
		
	} 

    try{
		
		$query = $conn->prepare("insert into penanam (name,alamat,dob, ktp, email, phone, pekerjaan, gambar, idx,idx_user,createdate)
		values (:name,:alamat,:dob,:ktp,:email,:phone,:pekerjaan,:gambar,:crc,:idx_user,:createdate)");
		$data = array(
			':name' => $_POST['p_nama'],
			':alamat' => $_POST['p_alamat'],
			':dob' => $_POST['p_dob'],
			':ktp' => $_POST['p_ktp'],
			':email' => $_POST['p_email'],
			':phone' => $_POST['p_phone'],
			':pekerjaan' => $_POST['p_pekerjaan'],
			':gambar' => $gambar,
			':crc' => $crc,
			':idx_user' => $idx_user,
			':createdate' => date('Y-m-d h:i:s')
		);
		$query->execute($data);
		header('Location: data_penanam.php');			
		
	}catch(PDOException $e){
		echo $e->getMessage();
	}
?>
<?php
    include "../dbinfo.php";
    include "cek_session.php";

	//$crc = abs(crc32(date('Y-m-d h:i:sa')));
	$crc = date('Ymdhis');
	$gambar='https://kotamedan.s3.us-east-2.amazonaws.com/Nm3IiPk.png';
	$tmp_file = $_FILES['gambar']['tmp_name'];
	
	if ($tmp_file!='') {
		$file_name = 'TM_'.$crc.'_'.str_replace(' ', '_', $_FILES['gambar']['name']);
		
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
		$query = $conn->prepare("insert into markers (name,address,lat, lng, type, dob, gambar, idx, idx_penanam, idx_user,createdate)
		values (:name,:address,:lat,:lng,:type,:dob,:gambar,:crc,:idx_penanam,:idx_user,:createdate)");
		$data = array(
			':name' => $_POST['t_nama'],
			':address' => $_POST['t_alamat'],
			':lat' => $_POST['t_lat'],
			':lng' => $_POST['t_lng'],
			':type' => $_POST['t_kategori'],
			':dob' => $_POST['t_dob'],
			':gambar' => $gambar,
			':crc' => $crc,
			':idx_penanam' => $_POST['p_id'],
			':idx_user'=>$idx_user,
			':createdate'=>date('Y-m-d h:i:s')
		);
		$query->execute($data);
		header('Location: data_tanaman.php');
	}catch(PDOException $e){
		echo $e->getMessage();
	}

?>
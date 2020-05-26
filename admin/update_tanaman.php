<?php
    include "../dbinfo.php";
    include "cek_session.php";
	
	//$crc = abs(crc32(date('Y-m-d h:i:sa')));
	$crc = date('Ymdhis');
	$tmp_file = $_FILES['file']['tmp_name'];
	
	if ($tmp_file!='') {
		$file_name = 'TM_UP_'.$_POST['idx'].'_'.str_replace(' ', '_', $_FILES['file']['name']);
		
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
		
		try{
			//console.log ($gambar);
			$query = $conn->prepare("insert into markers_update (idx_pohon,gambar,updated,updatedby,idx_user)
			values (:idx_pohon,:gambar,:updated,:updatedby,:idx_user)");
			$data = array(
			':idx_pohon' => $_POST['idx'],
			':gambar' => $gambar,
			':updated' => date('Y-m-d h:i:s'),
			':updatedby' => $_POST['updatedby'],
			':idx_user' => $idx_user
			);
			$query->execute($data);
			//console.log($query);
			//header('Location: form_update_tanaman.php?idx='.$_POST['idx']);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	} 
	
    

?>
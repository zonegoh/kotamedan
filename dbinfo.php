<?php
$apimap = 'API_MAP'; //halaman depan
$apiplace = 'API_PLACE'; // halaman form_tanaman.php
$access_token="API_IG"; // instagram token
$photo_count=18; // jumlah foto

$host = 'localhost:3360';
$user = 'root';
$pass = '';
$dbname = 'kotamedan';


try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo $conn . "<br>" . $e->getMessage();
    }
?>

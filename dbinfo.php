<?php
$apimap = 'AIzaSyDXz_0-5inGnqOviL1E-IB4V4mCphoP-WE'; //halaman depan
$apiplace = 'AIzaSyDsuKxIca6Htk8cAzf4H5Cbd2ebmVZ7caA'; // halaman form_tanaman.php
$access_token="8644563795.1677ed0.4b2ed0dfe9e14bf099f47e6322c61b04"; // instagram token
$photo_count=18; // jumlah foto

$host = 'localhost:3360';
$user = 'remote';
$pass = 'w})Z37]8fqS/@z3$';
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
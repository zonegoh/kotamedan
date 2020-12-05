<?php
include "dbinfo.php";

if ($_GET['q']=="planters") {
	try {
		$sql = 'select p_nama, p_gambar, count(idx) as jumlah_pohon from v_markers where p_nama is not null group by p_nama order by jumlah_pohon desc';
		$stmt = $conn->prepare($sql);
		$stmt->bindParam('idx', $idx);
		$stmt->execute();
		$result_planters = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	} catch(PDOException $e) {
		echo $e->getMessage();
	}
} 
if ($_GET['q']=="plants") { 
	try {
		$sql = 'select idx, nama, alamat, dob, gambar, lat, lng, p_nama, p_gambar from v_markers order by dob desc';
		$stmt = $conn->prepare($sql);
		$stmt->bindParam('idx', $idx);
		$stmt->execute();
		$result_plants = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	} catch(PDOException $e) {
		echo $e->getMessage();
	}
} 

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Medan kota buah BUNG!!!">
    <meta name="author" content="YAKI Foundation">

    <title>Medan Kota Buah BUNG!!!</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="assets/medankotabuahlogos-removebg-preview.png" type="image/png" sizes="16x16"> 

    <!-- Custom styles for this template -->
    <link href="css/full.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
      <a class="navbar-brand" href="home"><img src="assets/medankotabuahlogos-removebg-preview.png" width="50"> Medan Kota Buah BUNG!!!</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="gallery">Gallery</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="planters">Planters</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="plants">Plants</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://newsmedankotabuahbung.tumblr.com">News</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://docs.google.com/forms/d/e/1FAIpQLSc-uhA68xfE7VSy8tWf9OxuRKIlywpbuShwAikwg-s712V_Uw/viewform" target="_new">Contact</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="admin">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
	<div class="container konten">
		<div class="row">
			<div class="col">
            <?php if ($_GET['q']=='plants') { ?>
                <h2>Plants List</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Plant</th>
                        <th scope="col">Plant Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Plant by</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no=0; foreach ($result_plants as $data_plants) { $no=$no+1; ?>
                    
                        <tr>
                        <th scope="row"><?=$no?></th>
                        <td><img src="<?=$data_plants['gambar']?>" width="50" height="50" class="rounded-circle"></td>
                        <td><b><a href="timeline.php?idx=<?=$data_plants['idx']?>"><?=$data_plants['nama']?></a></b></td>
                        <td><?=$data_plants['alamat']?><br>Coordinates: <a href="http://www.google.com/maps/place/<?=$data_plants['lat']?>,<?=$data_plants['lng']?>" target="_blank"><?=$data_plants['lat']?>, <?=$data_plants['lng']?></a><br>Plant date: <?=$data_plants['dob']?></td>
                        <td class="text-center"><img src="<?=$data_plants['p_gambar']?>" width="50" height="50" class="rounded-circle"><br><?=$data_plants['p_nama']?></td>
                        </tr>
                    
                    <?php } ?>
                    </tbody>
                    </table>

            <?php } elseif ($_GET['q']=='planters') { ?>
                <h2>Planters List</h2>
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Profile Pic</th>
                        <th scope="col">Profile Fullname</th>
                        <th scope="col">Count of Plants</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no=0; foreach ($result_planters as $data_planters) { $no=$no+1; ?>
                    
                        <tr>
                        <th scope="row"><?=$no?></th>
                        <td><img src="<?=$data_planters['p_gambar']?>" width="50" height="50" class="rounded-circle"></td>
                        <td><?=$data_planters['p_nama']?></td>
                        <td><?=$data_planters['jumlah_pohon']?></td>
                        </tr>
                    
                    <?php } ?>
                    </tbody>
                    </table>

            <?php } ?>
			</div>
		</div>
	</div>
	
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126647944-2"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-126647944-2');
	</script>
  </body>
</html>

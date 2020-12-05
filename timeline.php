<?php
include "dbinfo.php";
$idx = $_GET['idx'];
$status = 0;
if (isset($idx)) { 
	$status = 1;
	try {
		$sql = 'select * from v_markers where idx=:idx';
		$stmt = $conn->prepare($sql);
		$stmt->bindParam('idx', $idx);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		foreach ($result as $data) {
			//var_dump($data);
			$nama = $data['nama'];
			$idx = $data['idx'];
			$alamat = $data['alamat'];
			$lat = $data['lat'];
			$lng = $data['lng'];
			$dob = $data['dob'];
			$p_nama = $data['p_nama'];
			$p_pekerjaan = $data['p_pekerjaan']; 
			$gambar = $data['gambar']; /**/
			$p_gambar = $data['p_gambar']; /**/
			$pgambar = $data['pgambar']; /**/
			$pengawas = $data['pengawas']; /**/
		}
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
	<!-- Theme style -->
	<link rel="stylesheet" href="admin/dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="admin/dist/css/skins/_all-skins.min.css">
	<!-- Font Awesome -->
  <link rel="stylesheet" href="admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="admin/bower_components/Ionicons/css/ionicons.min.css">

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
			<div class="col-md-8 offset-md-2">
			  <!-- Box Comment -->
			  <div class="box box-widget">
				<div class="box-header with-border">
				  <div class="user-block">
					<img class="img-circle" src="<?= $p_gambar ?>" alt="User Image">
					<span class="username"><a href="#"><?= $nama ?></a></span>
					<span class="description"><?= $p_nama ?></span>
				  </div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <img class="img-responsive pad" style="max-width:500px;max-height:500px;" src="<?= $gambar ?>" alt="Photo">

				  <p><h2><?= $nama ?></h2></p>
				</div>
				<!-- /.box-body -->
				<div class="box-footer box-comments">
				  <div class="box-comment">
					<!-- User image -->
					<img class="img-circle img-sm" src="<?= $p_gambar ?>" alt="User Image">

					<div class="comment-text">
					  <span class="username">
						<?= $p_nama ?>
						<span class="text-muted pull-right"></span>
					  </span><!-- /.username -->
					  Tanggal: <?= date_format(date_create($dob),'F j, Y') ?><br>Lokasi: <?= $alamat ?><br>Koordinat: <?= $lat.', '.$lng ?>
					</div>
					<!-- /.comment-text -->
				  </div>
				  <div class="box-comment">
					<!-- User image -->
					<img class="img-circle img-sm" src="<?= $pgambar ?>" alt="User Image">
					
					<div class="comment-text">
					  <span class="username">
						<?= $pengawas ?>
						<span class="text-muted pull-right"></span>
					  </span><!-- /.username -->
					   Sebagai pengawas <b><?= $nama ?></b>
					</div>
					<!-- /.comment-text -->
				  </div>
				  <!-- /.box-comment -->
				</div>
			  </div>
			  <!-- /.box -->
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<?php
				if ($status==1) {
					try {
						$sql = 'select * from v_markers_update where idx_pohon=:idx_pohon order by updated DESC';
						$stmt = $conn->prepare($sql);
						$stmt->bindParam('idx_pohon', $idx);
						$stmt->execute();
						$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
						
						foreach ($result as $datas) {
							$vdate = date_format(date_create($datas['updated']), 'F j, Y h:i:s');
							
				?>
				<div class="box box-comments">
					
					<div class="box-body">
					<!-- User image -->
					<img class="img-circle img-sm" src="<?= $datas['picture'] ?>" alt="User Image">

					<div class="comment-text">
					  <span class="username">
						<?= $datas['fullname'] ?>
						<span class="text-muted pull-right"><?= $vdate ?></span>
					  </span><!-- /.username -->
					  <img class="img-responsive pad" style="max-width:500px;max-height:500px;" src="<?= $datas['gambar'] ?>" alt="User Image">
					</div>
					<!-- /.comment-text -->
				  </div>		  
				</div>			
							
							
							
						
				<?php
						}
					} catch(PDOException $e) {
						echo $e->getMessage();
					}
				}
				?>
				</ul>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<div id="disqus_thread"></div>
				<script>

				/**
				*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
				*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
				/*
				var disqus_config = function () {
				this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
				this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
				};
				*/
				(function() { // DON'T EDIT BELOW THIS LINE
				var d = document, s = d.createElement('script');
				s.src = 'https://kotamedankotabuah.disqus.com/embed.js';
				s.setAttribute('data-timestamp', +new Date());
				(d.head || d.body).appendChild(s);
				})();
				</script>
				<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
			</div>
		</div>	
                            
	</div>
	
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="admin/dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="admin/dist/js/demo.js"></script>
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

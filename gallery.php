<?php
include "dbinfo.php";
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
	<h2>Gallery</h2>
		<div class="row">
			<?php
			//$json_link = "https://graph.instagram.com/me/media?fields=caption,media_url,permalink&access_token=IGQVJVenBycGttMGdPb3JKVXRyeUk2dHEtak5LOWltYU1HNVMzMm9aamJnUUR1Rmh4R0t6a0NkLURqZA3BOX1hmQ283Wnc3VG5BQUMyYlRRdFJ4eHpQdW5SS3E2U1p5T3BxanhuSXFHanNwX290bjhZAQgZDZD";
      
      $json_link = "https://www.instagram.com/kotamedankotabuah/?__a=1";
      
			$json = file_get_contents($json_link);
			$obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);

			foreach ($obj['graphql']['user']['edge_owner_to_timeline_media']['edges'] as $post){
        //var_dump($post['node']['thumbnail_src']);
			?>	
			
			  <div class="col-sm-6 col-md-4">
				<div class="thumbnail">
				  <a href="https://instagram.com/p/<?= $post['node']['shortcode'] ?>" target="_blank"><img class="img-thumbnail img-responsive" src="<?= $post['node']['thumbnail_src'] ?>" alt="<?= $post['node']['accessibility_caption'] ?>"></a>
				  <div class="caption">
					<p><mark><?= $post['node']['edge_media_to_caption']['edges'][0]['node']['text'] ?></mark></p>
				  </div>
				</div>
			  </div>
			
			<?php	
			}
			?>
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

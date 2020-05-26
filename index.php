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

    <title>Medan Kota Buah BUNG!!! - Support by YAKI Foundation</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="assets/medankotabuahlogos-removebg-preview.png" type="image/png" sizes="16x16"> 

    <!-- Custom styles for this template -->
    <link href="css/full.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="min-height:75px;">
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
	<div id="map-canvas" style="margin-top:75px;"></div>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Google Maps -->
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXz_0-5inGnqOviL1E-IB4V4mCphoP-WE&callback=initialize"
type="text/javascript"></script>
	<?php include "script_map.php"; ?>
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

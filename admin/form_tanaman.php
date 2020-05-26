<?php
include "../dbinfo.php";
include "cek_session.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kota Medan Kota Buah - Yakifoundation.org</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="../assets/medankotabuahlogos-removebg-preview.png" type="image/png" sizes="16x16"> 
  <?php include "style.php"; ?>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <?php include "top.php"; ?>
  <?php include "sidebar.php"; ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tanaman baru
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <form role="form" action="save_tanaman.php" method="POST" enctype="multipart/form-data">
              <div class="box-body">
			  <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label for="nama">Nama pohon</label>
                  <input class="form-control" name="t_nama" placeholder="Nama" type="text" required>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat tanaman</label>
                  <input class="form-control" name="t_alamat" placeholder="Alamat" type="text" id="carialamat" >
                </div>
				<div class="form-group">
                  <label for="alamat">Koordinat latitude - <a style="cursor: -webkit-grab; cursor: grab;" onclick="html5geotag();">ambil otomatis</a></label>
                  <input class="form-control" id="t_lat" name="t_lat" placeholder="Koordinat latitude" type="text">
                </div>
				<div class="form-group">
                  <label for="alamat">Koordinat longitude</label>
                  <input class="form-control" id="t_lng" name="t_lng" placeholder="Koordinat longitude" type="text">
                </div>
                <div class="form-group">
                  <label for="dob">Tanggal Tanam</label>
                  <input value="<?= date("Y-m-d") ?>" class="form-control" name="t_dob" placeholder="Tanggal lahir" type="date">
                </div>
                <div class="form-group">
                  <label for="penanam">Nama penanam</label>
                  <select class="form-control select2" name="p_id" style="width: 100%;">
				  <?php
				  try{
						$query = $conn->prepare("select idx, name, alamat from penanam where status=1 and idx_user='".$idx_user."' ORDER BY id DESC");
						$query->execute();
						while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
							echo "<option value='".$result['idx']."'>".strtoupper($result['name'])." / " .strtoupper($result['alamat'])."</option>";
						}
					}catch(PDOException $e){
						echo $e->getMessage();
					}
				  ?>
				  </select>
                </div>
              </div>
			  <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label for="Profile">Gambar Pohon</label>
				  <input type="file" id="preview" name="gambar">
                </div> 
				<div class="text-center" style="padding:5px;border:1px solid #ccc">
					<img id="img-preview" class="img-responsive" style="width:355px;height:355px;opacity:0.5;" src="../assets/upload_image.png"/>
				</div>
			  </div>	
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
				<input value="Pohon" name="t_kategori" type="hidden">
                <button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-danger">Cancel</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include "footer.php"; ?>
  <?php include "pengaturan.php"; ?>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include "footer_script.php"; ?>
<!-- Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsuKxIca6Htk8cAzf4H5Cbd2ebmVZ7caA&libraries=places&callback=initAutocomplete"
async defer></script>
<script>
$(document).ready( function() {
	function tampil(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#img-preview').attr('src', e.target.result);
				$('#img-preview').attr('style', 'opacity:1;width:355px;height:355px;');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#preview").change(function(){
		tampil(this);
	});	
});

function html5geotag(){
	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(function(position){
			document.getElementById("t_lat").value = position.coords.latitude;
			document.getElementById("t_lng").value = position.coords.longitude;
		});
	} else{
		alert("Sorry, your browser does not support HTML5 geolocation.");
	}
}

var autocomplete;
function initAutocomplete() {
	autocomplete = new google.maps.places.Autocomplete(
		(document.getElementById('carialamat')),
		{types: ['geocode']});
		
	autocomplete.addListener('place_changed', fillInAddress);
}
function fillInAddress() {
	var place = autocomplete.getPlace();
	document.getElementById("t_lat").value = place.geometry.location.lat();
	document.getElementById("t_lng").value = place.geometry.location.lng();
}
$(function () {
    $('.select2').select2()
});
</script>
</body>
</html>
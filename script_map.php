<script>
	var marker;
	function initialize() {
		var mapCanvas = document.getElementById('map-canvas');
		var mapOptions = {
			zoom: 15,
            //center: {lat: 3.597031, lng: 98.678513},
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			mapTypeControl: false,
			mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.TOP_CENTER
			},
		zoomControl: true,
		zoomControlOptions: {
			position: google.maps.ControlPosition.LEFT_CENTER
		},
		scaleControl: true,
		streetViewControl: false,
		streetViewControlOptions: {
			position: google.maps.ControlPosition.LEFT_TOP
		},
		fullscreenControl: true
		}
		
		var map = new google.maps.Map(mapCanvas, mapOptions);
		var infoWindow = new google.maps.InfoWindow;      
		var bounds = new google.maps.LatLngBounds();


		function bindInfoWindow(marker, map, infoWindow, html) {
			google.maps.event.addListener(marker, 'click', function() {
				infoWindow.setContent(html);
				infoWindow.open(map, marker);
			});
		}

		function addMarker(lat, lng, tipe, info) {
			var pt = new google.maps.LatLng(lat, lng);
			bounds.extend(pt);
			var marker = new google.maps.Marker({
				map: map,
				position: pt,
				icon: 'assets/' + tipe + '.png',
				animation: google.maps.Animation.DROP
			});			
			map.fitBounds(bounds);
			bindInfoWindow(marker, map, infoWindow, info);
		}

	  <?php
		
		$sql = 'select * from v_markers';
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		foreach ($result as $data) {
			$lat = $data['lat'];
			$idx = $data['idx'];
			$lon = $data['lng'];
			$nama = $data['nama'];
			$gbr = $data['gambar'];
			$address = $data['alamat'];
			$dob = $data['dob'];
			$type = $data['kategori'];
			$pnama = $data['p_nama'];
			$pgambar = $data['p_gambar'];
			$palamat = $data['p_alamat'];
			$pengawas = $data['pengawas'];
			$pgambar = $data['pgambar'];
			
			$info = '<div id="content"><div id="bodyContent"><p><h4>'.$data["nama"].'</h4>Penanam: <b>'.$data['p_nama'].'</b><br>Nomor Id: '.$data['idx'].'<br/>Lokasi: '.$data["alamat"].'<br/>Koordinat: '.$data["lat"].', '.$data["lng"].'<br/>Tanggal Tanam: '.$data['dob'].'<br>Pengawas: <b>'.$data['pengawas'].'</b></p><p><a href="timeline.php?idx='.$data['idx'].'">Informasi lebih lanjut</a></p><table class="text-center" border="1" bordercolor="#eee"><tr><td>Pohon</td><td>Penanam</td><td>Pengawas</td></tr><tr><td><img src="'.$data['gambar'].'" class="img-thumbnail" style="width:100px;height:100px"></td><td> <img src="'.$data['p_gambar'].'" class="img-thumbnail" style="width:100px;height:100px"></td><td> <img src="'.$data['pgambar'].'" class="img-thumbnail" style="width:100px;height:100px"></td></tr></table></div></div>';
			
			echo ("addMarker($lat, $lon, '$type', '$info');\n");
		}
	  ?>
	}
	google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php

	$nama = $_GET["cariMakanan"];
	$con = mysqli_connect("localhost", "root", "", "inablues");
	if($nama != "kosong" || $nama != null){
		$sql = "SELECT * FROM makanan WHERE Nama_makanan like '%$nama%'";
		$result = mysqli_query($con, $sql);

		$xml = new SimpleXMLElement("<data-makanan/>");
		while ($row = mysqli_fetch_assoc($result)) {
			$no = $xml->addChild("no", $row["id_makanan"]);	
			$nama = $xml->addChild("nama", $row["Nama_makanan"]);	
			$harga = $xml->addChild("harga", $row["Harga"]);
			$jenis = $xml->addChild("jenis", $row["Jenis_makanan"]);
		}

		echo $xml->asXml();
		mysqli_free_result($result);
		mysqli_close($con);		
	} else {
		$sql = "SELECT * FROM makanan";
		$result = mysqli_query($con, $sql);

		$xml = new SimpleXMLElement("<data-makanan/>");
		while ($row = mysqli_fetch_assoc($result)) {
			$no = $xml->addChild("no", $row["id_makanan"]);	
			$nama = $xml->addChild("nama", $row["Nama_makanan"]);	
			$harga = $xml->addChild("harga", $row["Harga"]);
			$jenis = $xml->addChild("jenis", $row["Jenis_makanan"]);
		}

		echo $xml->asXml();
		mysqli_free_result($result);
		mysqli_close($con);
	}
?>
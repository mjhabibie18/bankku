<?php
	include("../config.php");
    
	$no_rek = $_GET["cariData"];
	$con = mysqli_connect("localhost", "kridho_bankku", "kridho1234", "kridho_bankku");
	if($no_rek != "kosong" || $no_rek != null){
		$sql = "SELECT * FROM transaksi WHERE no_rekening = '$no_rek'";
		$result = mysqli_query($con, $sql);
		$numResult = mysqli_num_rows($result);

		$xml = new SimpleXMLElement("<data-client/>");
		while ($row = mysqli_fetch_assoc($result)) {
			// $no_rek = $xml->addChild("no_rekekening", $row["no_rekening"]);	
			$nama_pengirim = $xml->addChild("nama_pengirim", $row["nama_pengirim"]);
            $nama_penerima = $xml->addChild("nama_penerima", $row["nama_penerima"]);
			$nominal = $xml->addChild("nominal", $row["nominal"]);
            $tanggal_transaksi = $xml->addChild("tanggal_transaksi", $row["tanggal_transaksi"]);
			
		}

		echo $xml->asXml();
		mysqli_free_result($result);
		mysqli_close($con);		
	} else {
		$sql = "SELECT * FROM transaksi";
		$result = mysqli_query($con, $sql);

		$xml = new SimpleXMLElement("<data-client/>");
		while ($row = mysqli_fetch_assoc($result)) {
			// $no_rek = $xml->addChild("no_rekening", $row["no_rekening"]);	
			$nama_pengirim = $xml->addChild("nama_pengirim", $row["nama_pengirim"]);
            $nama_penerima = $xml->addChild("nama_penerima", $row["nama_penerima"]);
			$nominal = $xml->addChild("nominal", $row["nominal"]);
            $tanggal_transaksi = $xml->addChild("tanggal_transaksi", $row["tanggal_transaksi"]);
		}

		echo $xml->asXml();
		mysqli_free_result($result);
		mysqli_close($con);
	}
?>

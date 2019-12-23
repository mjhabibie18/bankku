<?php
	include("../config.php");
	$pin = $_GET["cariData"];
	$con = mysqli_connect("localhost", "kridho_bankku", "kridho1234", "kridho_bankku");
	if($pin != "kosong" || $pin != null){
		$sql = "SELECT * FROM data WHERE pin = $pin";
		$result = mysqli_query($con, $sql);

		$xml = new SimpleXMLElement("<data-client/>");
		while ($row = mysqli_fetch_assoc($result)) {
			$no_rekening = $xml->addChild("no", $row["no_rekening"]);	
			$nama = $xml->addChild("nama", $row["nama"]);	
			$saldo = $xml->addChild("saldo", $row["saldo"]);
			
		}

		echo $xml->asXml();
		mysqli_free_result($result);
		mysqli_close($con);		
	} else {
		$sql = "SELECT * FROM data";
		$result = mysqli_query($con, $sql);

		$xml = new SimpleXMLElement("<data-client/>");
		while ($row = mysqli_fetch_assoc($result)) {
			$no_rekening = $xml->addChild("no", $row["no_rekening"]);	
			$nama = $xml->addChild("nama", $row["nama"]);	
			$saldo = $xml->addChild("saldo", $row["saldo"]);
		}

		echo $xml->asXml();
		mysqli_free_result($result);
		mysqli_close($con);
	}
?>
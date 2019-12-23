<?php

	$norek = $_GET["norek"];
	$con = mysqli_connect("localhost", "kridho_bankku", "kridho1234", "kridho_bankku");
	if($norek != "kosong" || $norek != null){
		$sql = "SELECT * FROM data WHERE no_rekening = '$norek'";
		$result = mysqli_query($con, $sql);
		$numResult = mysqli_num_rows($result);
		if($numResult > 0){
			$xml = new SimpleXMLElement("<data-rekening/>");
			while ($row = mysqli_fetch_assoc($result)) {
				$nama = $xml->addChild("nama", $row["nama"]);
				//$no = $xml->addChild("no", $row["no_rekening"]);
			}
		} else {
			$xml = new SimpleXMLElement("<data-rekening/>");
			$nama = $xml->addChild("nama", "no rekening tidak ada");
		}		
		
		echo $xml->asXml();
		mysqli_free_result($result);
		mysqli_close($con);		
	}
?>
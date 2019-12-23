<?php

	$tlp = $_GET["tlp"];
	$con = mysqli_connect("kongkow3logi.com", "kongkowl_danar", "kongkowldanar", "kongkowl_kongkow");
	if($tlp != "kosong" || $tlp != null){
		$sql = "SELECT * FROM data WHERE no_tlp = '$tlp'";
		$result = mysqli_query($con, $sql);
		$numResult = mysqli_num_rows($result);
		if($numResult > 0){
			$xml = new SimpleXMLElement("<data-rekening/>");
			while ($row = mysqli_fetch_assoc($result)) {
				$nama_lengkap = $xml->addChild("nama_lengkap", $row["nama_lengkap"]);
				//$no = $xml->addChild("no", $row["no_rekening"]);
			}
		} else {
			$xml = new SimpleXMLElement("<data-rekening/>");
			$nama_lengkap = $xml->addChild("nama_lengkap", "no rekening tidak ada");
		}		
		
		echo $xml->asXml();
		mysqli_free_result($result);
		mysqli_close($con);		
	}
?>
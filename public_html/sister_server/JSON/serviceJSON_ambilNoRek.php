<?php
	include "../../config.php";
	$norek = $_GET["norek"];
	// $con = mysqli_connect("localhost", "epiz_22340213", "hlCDykFN6fY", "epiz_22340213_client");
	if($norek != "kosong" || $norek != null){
		$sql = "SELECT * FROM data WHERE no_rekening = '$norek'";
		$result = mysqli_query($db, $sql);
		$numResult = mysqli_num_rows($result);
		if($numResult > 0) {
			$json = mysqli_fetch_assoc($result);
			// $xml = new SimpleXMLElement("<data-rekening/>");
			// while ($row = mysqli_fetch_assoc($result)) {
			// 	$nama = $xml->addChild("nama", $row["nama"]);
			// 	//$no = $xml->addChild("no", $row["no_rekening"]);
			// }
		// } else {
		// 	$xml = new SimpleXMLElement("<data-rekening/>");
		// 	$nama = $xml->addChild("nama", "no rekening tidak ada");
		    $out = array(
		    	'status' => 200,
		    	'message' => "sukses",
		    	'data' => $json
		    	);
		    echo json_encode($out);
		} else {
			$out = array(
		    	'status' => 400,
		    	'message' => "no rekening tidak ada",
		    	'data' => null
		    	);
		    echo json_encode($out);
		}
		
		// echo $xml->asXml();
		// mysqli_free_result($result);
		mysqli_close($con);		
	}
?>
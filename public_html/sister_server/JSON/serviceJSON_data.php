	<?php
	include "../config/koneksi.php";	
	$pin = $_GET["cariData"];
	// on = mysqli_connect("localhost", "root", "", "client");
	$k = new db();
	$con = mysqli_connect($k->server, $k->username, $k->password, $k->database);
	if($pin != "" || $pin != null){
		$sql = "SELECT * FROM data WHERE pin = $pin";
		$result = mysqli_query($con, $sql);
		$cek = mysqli_num_rows($result);
		if ($cek > 0){
			$json = mysqli_fetch_assoc($result);
			//echo json_encode($json);
			$out = array(
	            'status' => 200,
	            'message' => "sukses",
	            'data' => $json
	          );
		} else {
			$out = array(
	            'status' => 400,
	            'message' => "GaGal!!",
	            'data' => null
	          );
		}
		// $xml = new SimpleXMLElement("<data-client/>");
		// while ($row = mysqli_fetch_assoc($result)) {
		// 	$no_rekening = $xml->addChild("no", $row["no_rekening"]);	
		// 	$nama = $xml->addChild("nama", $row["nama"]);	
		// 	$saldo = $xml->addChild("saldo", $row["saldo"]);
			
		// }
		// $json = mysqli_fetch_assoc($result);
		// //echo json_encode($json);
		// $out = array(
  //           'status' => 200,
  //           'message' => "sukses",
  //           'data' => $json
  //         );
		// mysqli_free_result($result);
		echo json_encode ($out);
		mysqli_close($con);		
	} else {
		$sql = "SELECT * FROM data";
		$result = mysqli_query($con, $sql);

		// $xml = new SimpleXMLElement("<data-client/>");
		// while ($row = mysqli_fetch_assoc($result)) {
		// 	$no_rekening = $xml->addChild("no", $row["no_rekening"]);	
		// 	$nama = $xml->addChild("nama", $row["nama"]);	
		// 	$saldo = $xml->addChild("saldo", $row["saldo"]);
		// }
		$data = array();
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($data, $row);
		}
		$out = array(
            'status' => 200,
            'message' => "sukses",
            'data' => $data
          );
		echo json_encode ($out);
		//echo json_encode($json);
		// echo $xml->asXml();
		// mysqli_free_result($result);
		mysqli_close($con);
	}
?>
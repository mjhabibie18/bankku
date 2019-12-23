<?php

    require_once "../koneksi.php";
    $z = new db();
    
    $tampung=$_GET["kodee"];
    
	$con = mysqli_connect($z->server,$z->username,$z->password,$z->database);
	
	$sql = "select * from pembayaran where kode_transfer='$tampung'";
	
	$result = mysqli_query($con,$sql);
	
	
	$xml = new SimpleXMLElement("<data_cekPembayaran/>");
	while ($row = mysqli_fetch_assoc($result))
	{
	    $kodee=$xml->addChild("kodee",$row["kode_transfer"]);
	    $kodee->addAttribute("tgl_transfer",$row["tgl_transfer"]);
	}
	
	echo $xml->asXml();
	mysqli_free_result($result);
	mysqli_close($con);
?>
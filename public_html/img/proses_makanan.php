<?php
	$user = $_POST["user"];

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "http://localhost/sister_server/service_makanan.php?Nama_makanan=$user");
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$xml = new SimpleXMLElement(curl_exec($curl));
	curl_close($curl);

	$nm="";
	foreach ($xml->nama as $nama) :
		$nm=$nama;
	endforeach;

	if ($nm != "")
	{
		echo "Login Sukses";
	}
	else
	{
		echo "Login Gagal";
	}
?>

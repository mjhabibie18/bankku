<!DOCTYPE html>
<html>
<head>
	<title>Menu Makanan What's Up Cafe</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<center><h1 style="color: blue;">Menu Makanan What's Up Cafe</h1></center>
	<hr>
	<div class="col-md-4">
		<form method="get" action="<?php $_SERVER['PHP_SELF'] ?>">
		<table>
			<tr>
				<td>Cari Makanan&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td><input type="text" name="cariMakanan" placeholder="Nama Makanan" class="form-control"></td>
				
			</tr>
		</table>
		</form>
	</div>
	<div class="col-md-12">
	<br><br>
		<table class="table table-bordered">
			<tr>
				<th>No</th>
				<th>Nama Makanan</th>
				<th>Harga</th>
				<th>Jenis Makanan</th>
			</tr>
		<?php
		if(empty($_GET['cariMakanan'])){ 
			$counter = 1;
			$nama = '';
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, "http://localhost/sister_server/service_makanan.php?cariMakanan=$nama");
			curl_setopt($curl, CURLOPT_HEADER, 0);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$xml = new SimpleXMLElement(curl_exec($curl));
			curl_close($curl); 
			foreach ($xml as $key){ 
				if($counter == 1){ ?>
				<tr>
					<td><?php echo $key; ?></td>
				<?php $counter++; } else if($counter % 4 == 0){ ?>
					<td><?php echo $key; ?></td></tr>
				<?php $counter = 1;} else { ?>
				<td><?php echo $key; ?></td>
			<?php $counter++; } 
			}
		} else { 
		$counter = 1;
		$nama = $_GET['cariMakanan'];
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "http://localhost/sister_server/service_makanan.php?cariMakanan=$nama");
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$xml = new SimpleXMLElement(curl_exec($curl));
		curl_close($curl); 
		foreach ($xml as $key){ 
			if($counter == 1){ ?>
			<tr>
				<td><?php echo $key; ?></td>
			<?php $counter++; } else if($counter % 4 == 0){ ?>
				<td><?php echo $key; ?></td></tr>
			<?php $counter = 1;} else { ?>
			<td><?php echo $key; ?></td>
		<?php $counter++; } 
		} }?>
		</table>
	</div>
</body>
</html>
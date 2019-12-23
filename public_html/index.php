<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <link rel="shortcut icon" href="img/bank.jpg"/>
  <title>BANKKU.yippytech.COM</title>
  <link rel="shortcut icon" href="img/bank.jpg"/>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
  <script src="js/md5.js"></script>
  <script src="js/funcNumber.js"></script>
  <!-- <script> var pass = md5(document.getElementById("password").value)</script>
</head> -->
<body>
  <div class="wrap">
  		<div style="font-size:20px; font-family:arial; "><center><h1>BANK KITA</h1></center>
		<div class="avatar">
      <img src="img/bank.jpg">
		</div>
		</div>
		<form action="../sister_server/service_login.php" method="POST" >
			<input type="text" name="pin" id="pin" placeholder="PIN" required>
			<div class="bar">
				<i></i>
			</div>
			<input type="password" name="password" id="password" placeholder="password" required>
			<a href="" class="forgot_link">forgot ?</a>
			<input type = "submit" value = " Submit "/>
		</form>
	</div>
  <script src="js/index.js"></script>

</body>

</html>
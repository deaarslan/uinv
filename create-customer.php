<!DOCTYPE html>
<html>
<head>
	<title>Create Customer</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Create Customer</h1>
	<?php 
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
		{
			$conn = mysqli_connect('localhost','root','','ticketing');
			$s = "insert into customers(f_name,l_name,phone_number,mail,password,management_id) values('"
			. $_POST['f_name'] . "','" . $_POST['l_name'] . "','" . $_POST['phone']  . "','" . $_POST['mail']
			 . "','" . $_POST['password'] . "'," . $_POST['id'] . ")";
			 
			 mysqli_query($conn, $s);
			 mysqli_close($conn);
			 ?>

			 <p class='created-text'>Customer Created</p>
		<?php
			header('Location:' . 'management.php');
		}

		else
		{

	?>
	<form action='' method="POST">
		<?php include('c/form-inputs.php'); ?>
		<input type='hidden' name='id' value='1' />
	</form>
	<?php } ?>
</body>
</html>
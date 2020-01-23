<?php
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
	{
		echo $_POST['type'];
		$conn = mysqli_connect('localhost','root','','ticketing');
		if ( $_POST['type'] == 'customer' )
		{
			$sql = "SELECT customer_id, password FROM customers WHERE mail ='" . $_POST['mail'] . "'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result);
			if ( isset($row['password']) )
				if ( $row['password'] == $_POST['password'] )
				{
					session_start();
					$_SESSION['customer_id'] = $row['customer_id'];
					header('Location:' . 'customer.php');
				}
		}

		else if ( $_POST['type'] == 'dist' )
		{
			$sql = "SELECT distributor_id, password FROM distributors WHERE mail ='" . $_POST['mail'] . "'";
			echo $sql;
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result);
			print_r($row);
			if ( isset($row['password']) )
				if ( $row['password'] == $_POST['password'] )
				{
					session_start();
					$_SESSION['distributor_id'] = $row['distributor_id'];
					header('Location:' . 'dist.php');
				}
		}

		else if ( $_POST['type'] == 'agent' )
		{
			$sql = "SELECT agent_id, password FROM agents WHERE mail ='" . $_POST['mail'] . "'";
			echo $sql;
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result);
			print_r($row);
			if ( isset($row['password']) )
				if ( $row['password'] == $_POST['password'] )
				{
					session_start();
					$_SESSION['agent_id'] = $row['agent_id'];
					header('Location:' . 'agent.php');
				}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class='container'>
		<h1>Customer Login</h1>
		<form class='login-form' action='' method='post'>
			<select class='input' name='type'>
				<option value='customer'>Customer</option>
				<option value='dist'>Distributor</option>
				<option value='agent'>Agent</option>
			</select>
			<input placeholder="mail" class='input' type="email" name="mail" required>
			<br />
			<input placeholder="password" class='input' type="password" name="password" required>
			<br />
			<input class='input submit-button login-button' type="submit" value='Login'>
			<br />
		</form>
	</div>
</body>
</html>
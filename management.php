<!DOCTYPE html>
<html lang="fa">
<head>
	<meta charset="UTF-8">
	<title>Management</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Management</h1>
	<div>
		<a class='btn' href='create-agent.php'>Create Agent</a>
		<a class='btn' href='create-dist.php'>Create Distributor</a>
		<a class='btn' href='create-customer.php'>Create Customer</a>
	</div>
	<div class='management-panel'>
		<div>
			<h2>Distributors</h2>
			<ul>
				<?php
					$conn = mysqli_connect('localhost','root','','ticketing');
					mysqli_query($conn, 'SET NAMES utf8');
					$s = 'select * from distributors';
					$result = mysqli_query($conn, $s);
					while ( $row = mysqli_fetch_array($result) ) {
						echo '<li>' . $row['f_name'] . ' ' . $row['l_name'] . '</li>';
					}
				?>
			</ul>
		</div>
		<div>
			<h2>Agents</h2>
			<ul>
				<?php
					$s = 'select * from agents';
					$result = mysqli_query($conn, $s);
					while ( $row = mysqli_fetch_array($result) ) {
						echo '<li>' . $row['f_name'] . ' ' . $row['l_name'] . '</li>';
					}
				?>
			</ul>
		</div>
		<div>
			<h2>Customers</h2>
			<ul>
				<?php
					$s = 'select * from customers';
					$result = mysqli_query($conn, $s);
					while ( $row = mysqli_fetch_array($result) ) {
						echo '<li>' . $row['f_name'] . ' ' . $row['l_name'] . '</li>';
					}
				?>
			</ul>
		</div>
	</div>
	<div class='management-panel'>
		<form class='search-form' method="get" action=''>
			<input type="text" placeholder="search in tickets" name="q" class='input'>
			<input type="submit" value="search" class='submit-button search-button'>
		</form>
		<div>
			<h2 class='panel-h2'>Tickets</h2>
			<ul>
				<?php
					$s = 'select * from tickets';
					$result = mysqli_query($conn, $s);
					while ( $row = mysqli_fetch_array($result) ) {
						echo '<li><a href="?q=' . $row['ticket_id'] . '">' . $row['ticket_id'] . ' : ' . $row['type'] . '</a></li>';
					}
				?>
			</ul>
		</div>
	</div>
	<?php
		if ( isset($_GET['q']) )
		{
			$id = $_GET['q'];
			echo "<div class='ticket-container'>";

			include('c/show-ticket.php');
		?>
			<form class='comment-form' method='POST' action=''>
				<p>Comment:</p>
				<textarea class='comment-textarea' rows='4' name='comment'></textarea>
				<input type="submit" class='submit-button' value="Add comment">
			</form>
			<div class='ticket-container'>
	<?php
		}

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
		{
			$s = "update tickets set comment='" . $_POST['comment'] . "' where ticket_id=" . $id;
			echo $s;
			if ( mysqli_query($conn, $s) )
				echo 'success';

			else
				echo mysqli_error($conn);

			header('Location:' . 'management.php');
		}
	?>
</body>
</html>
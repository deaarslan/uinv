<?php
	session_start();
	include('c/connection.php');
?>

<!DOCTYPE html>
<html lang="fa">
<head>
	<meta charset="UTF-8">
	<title>Distributor</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Distributor</h1>
	<div class='management-panel'>
		<div>
			<h2>Agents</h2>
			<ul>
				<?php
					$s = 'select * from agents';
					$result = mysqli_query($conn, $s);
					while ( $row = mysqli_fetch_array($result) ) {
						echo '<li>' . $row['agent_id'] . ' : ' . $row['f_name'] . ' ' . $row['l_name'] . '</li>';
					}
				?>
			</ul>
		</div>
		<div>
			<h2>New Tickets</h2>
			<ul>
				<?php
					$s = 'select * from tickets where ticket_id not in (
						select ticket_id
						from distribution_ticket
						)';
					$result = mysqli_query($conn, $s);
					while ( $row = mysqli_fetch_array($result) ) {
						echo '<li><a href="?q=' . $row['ticket_id'] . '">' . $row['ticket_id'] . ' : ' . $row['type'] . '</a></li>';
					}
				?>
			</ul>
		</div>
	</div>
	<div class='management-panel'>
		<div>
			<h2>Distributed Tickets</h2>
			<ul>
				<?php
					$s = 'select * from tickets where ticket_id in (
						select ticket_id
						from distribution_ticket
						where distributor_id = ' . $_SESSION['distributor_id'] .
						')';
					$result = mysqli_query($conn, $s);
					while ( $row = mysqli_fetch_array($result) ) {
						echo '<li><a href="?q=' . $row['ticket_id'] . '">' . $row['ticket_id'] . ' : ' . $row['type'] . '</a></li>';
					}
				?>
			</ul>
		</div>
		<div>
			<h2>Returned Tickets</h2>
			<ul>
				<?php
					$s = 'select * from tickets inner join return_ticket on tickets.ticket_id = return_ticket.ticket_id';
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

			if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				$s = "insert into distribution_ticket(ticket_id, agent_id, distributor_id) values(" . $id . ',' . $_POST['agent_id'] . "," . $_SESSION['distributor_id'] . ")";
				echo $s;
				if ( mysqli_query($conn, $s) )
					echo '<p>Success</p>';

				else
					echo mysqli_error($conn);

				header('Location:' . 'dist.php');
			}

			else {
		?>
			<form class='comment-form' method='POST' action=''>
				<label>Agent ID:</label>
				<br>
				<input type='number' name='agent_id' required>
				<br><br>
				<input type="submit" class='submit-button' value="Send to Agent">
			</form>
			<div class='ticket-container'>
	<?php
			}
		}
		?>
</body>
</html>
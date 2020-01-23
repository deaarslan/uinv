<?php
	session_start();
	include ('c/connection.php');
?>

<!DOCTYPE html>
<html lang="fa">
<head>
	<meta charset="UTF-8">
	<title>Agent</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Agent</h1>
	<div class='management-panel'>
		<div>
			<h2>New Tickets</h2>
			<ul>
				<?php
					$s = 'select * from tickets where ticket_id in (
						select ticket_id
						from distribution_ticket
						where agent_id = ' . $_SESSION['agent_id'] . '
						)' . ' and ticket_id not in (
							select ticket_id
							from apply_answer
						)';
					$result = mysqli_query($conn, $s);
					while ( $row = mysqli_fetch_array($result) ) {
						echo '<li><a href="?q=' . $row['ticket_id'] . '">' . $row['ticket_id'] . ' : ' . $row['type'] . '</a></li>';
					}
				?>
			</ul>
		</div>
		<div>
			<h2>Replies</h2>
			<ul>
				<?php
					$s = 'select * from apply_answer inner join tickets on tickets.ticket_id = apply_answer.ticket_id where agent_id = ' . $_SESSION['agent_id'];
					$result = mysqli_query($conn, $s);
					while ( $row = mysqli_fetch_array($result) ) {
						echo '<li><a href="?r=' . $row['apply_answer_id'] . '">' . $row['ticket_id'] . ' : ' . $row['type'] . '</a></li>';
					}
				?>
			</ul>
		</div>
	</div>
	<div class='management-panel'>
		<div>
			<h2>All Tickets</h2>
			<ul>
				<?php
					$s = 'select * from tickets where ticket_id in (
						select ticket_id
						from distribution_ticket
						where agent_id = ' . $_SESSION['agent_id'] .
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
				$s = "insert into apply_answer(ticket_id,agent_id,text) values (" . $id . ',' . $_SESSION['agent_id'] . ",'" . $_POST['reply'] . "')";
				if ( mysqli_query($conn, $s) )
					echo '<p>Success</p>';

				else
					echo mysqli_error($conn);

				header('Location:' . 'agent.php');
			}

			else {
		?>
			<form class='comment-form' method='POST' action=''>
				<p>Reply:</p>
				<textarea class='comment-textarea' rows='4' name='reply'></textarea>
				<input type="submit" class='submit-button' value="Send Reply">
			</form>
			<div class='ticket-container'>
	<?php
			}
		}

		if ( isset($_GET['r']) )
		{
			$reply_id = $_GET['r'];
			$s = 'select apply_answer.date,type,level_tic,apply_answer.text from apply_answer inner join tickets on tickets.ticket_id = apply_answer.ticket_id where apply_answer.apply_answer_id = ' . $reply_id;
			$result = mysqli_query($conn, $s);
			$row = mysqli_fetch_array($result);
			?>

			<div class='ticket'>
				<div class='ticket-info'>
					<h2><?php echo $row['type'] ?></h2>
					<p class='ticket-date'>Date: <?php echo $row['date'] ?></p>
					<p class='ticket-date'>Level: <?php echo $row['level_tic'] ?></p>
				</div>
				<p>Text: <br><?php echo $row['text'] ?></p>
			</div>
	<?php
		}
		?>
</body>
</html>
<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Customer</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
		require('c/connection.php');

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
			$s = "insert into tickets(file,level_tic,type,text, customer_id) values('" . $_POST['file'] . "','" . $_POST['level']
			. "','" . $_POST['type'] . "','" . $_POST['text'] . "'," . $_SESSION['customer_id'] . ")";
			mysqli_query($conn, $s);
			header('Location:' . 'customer.php');
		}
	?>
	<div class='management-panel'>
		<form class='search-form' method="get" action=''>
			<input type="text" placeholder="search in tickets" name="q" class='input'>
			<input type="submit" value="search" class='submit-button search-button'>
		</form>
		<div>
			<h2 class='panel-h2'>Tickets</h2>
			<ul>
				<?php
					$s = "select * from tickets where customer_id = '" .  $_SESSION['customer_id'] . "'";
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
			<h2 class='panel-h2'>Replies</h2>
			<ul>
				<?php
					$s = "select * from apply_answer inner join tickets on apply_answer.ticket_id = tickets.ticket_id where tickets.ticket_id in (
						select ticket_id
						from tickets
						where customer_id = " .  $_SESSION['customer_id'] . ")";
					$result = mysqli_query($conn, $s);
					while ( $row = mysqli_fetch_array($result) ) {
						echo '<li><a href="?r=' . $row['apply_answer_id'] . '">' . $row['ticket_id'] . ' : ' . $row['type'] . '</a></li>';
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
			echo '<h2>Ticket</h2>';
			include('c/show-ticket-customer.php');
		}

		if ( isset($_GET['r']) )
		{
			$reply_id = $_GET['r'];
			$s = 'select apply_answer.date,type,level_tic,apply_answer.text from apply_answer inner join tickets on tickets.ticket_id = apply_answer.ticket_id where apply_answer.apply_answer_id = ' . $reply_id;
			$result = mysqli_query($conn, $s);
			$row = mysqli_fetch_array($result);
			echo '<h2>Reply</h2>';
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
	<h1>Send a ticket</h1>
	<form class='login-form' action='' method="POST">
		<label>level</label>
		<br>
		<select class='select-input' name='level'>
			<option value='1'>Low</option>
			<option value='2'>Medium</option>
			<option value='3'>High</option>
		</select>
		<br>
		<br>
		<label>type</label>
		<br>
		<select class='select-input' name='type'>
			<option value='Technical'>Technical</option>
			<option value='Payment'>Payment</option>
			<option value='Other'>Other</option>
		</select>
		<br>
		<br>
		<textarea class='input' placeholder="ticket text" rows="6" cols="30" name='text'></textarea>
		<br>
		<br>
		<input class='submit-button' type="submit" value="send">
	</form>
</body>
</html>
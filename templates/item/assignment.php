<?php

$assignment = $args;

$started_at = format_datetime($assignment['started_at']);
$ended_at = format_datetime($assignment['ended_at']);
$given_by_name = $assignment['first_name'] . ' ' . $assignment['last_name'];
$given_by_link = '/person/' . $assignment['username'];

$with_header = isset($assignment['room_id']);

?>

<div class="assignment">
	<header>
		<?php
		if ($with_header) {
			echo '
			<a href="/room/' . $assignment['room_id'] . '">' . $assignment['room_name'] . '</a>
			<br>';
		}
		?>
		<i>Due <?php echo $ended_at; ?></i>
	</header>
	<h3><?php echo $assignment['title']; ?></h3>
	<p><?php echo $assignment['body']; ?></p>
	<footer>
		<i>Assignment given by
			<a href="<?php echo $given_by_link; ?>">
				<?php echo $given_by_name; ?>
			</a>
			at <?php echo $started_at; ?>
		</i>
	</footer>
</div>

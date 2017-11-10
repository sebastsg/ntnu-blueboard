<?php

$post = $args;

$posted_at = format_datetime($post['created_at']);
$poster_name = $post['first_name'] . ' ' . $post['last_name'];
$poster_link = '/person/' . $post['username'];

$with_header = isset($post['room_id']);

if ($with_header) {
	$room_link = '/room/' . $post['room_id'];
	$room_title = $post['room_name'];
}

?>

<div class="post">
	<?php
	if ($with_header) {
		echo '
		<header>
			<a href="' . $room_link . '">' . $room_title . '</a>
		</header>';
	}
	?>
	<h3><?php echo $post['title']; ?></h3>
	<p><?php echo $post['body']; ?></p>
	<footer>
		<i>
			by
			<a href="<?php echo $poster_link; ?>">
				<?php echo $poster_name; ?>
			</a>
			at <?php echo $posted_at; ?>
		</i>
	</footer>
</div>

<!doctype html>
<html>
	<head>
		<title>Blueboard</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="/img/icon.png">
		<link rel="stylesheet" type="text/less" href="/css/main.less">
		<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200|700">
		<script src="/js/jquery-3.2.1.min.js"></script>
		<script src="/js/less.min.js"></script>
		<script src="/js/main.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<header>
				<nav>
					<a href="/">Dashboard</a>
					<a href="/rooms">Rooms</a>
					<a href="/assignments">Assignments</a>
					<a href="/groups">Groups</a>
					<a href="/notifications" class="secondary"><i class="fa fa-bell-o"></i></a>
					<a href="/profile" class="secondary" style="margin-right:16px;"><i class="fa fa-user-circle"></i></a>
				</nav>
				<img src="/img/header.png">
			</header>
			<main>
				<div>
					<?php echo $args['page']; ?>
				</div>
			</main>
			<footer>
				<p>2017 &copy; Blueboard</p>
			</footer>
		</div>
	</body>
</html>

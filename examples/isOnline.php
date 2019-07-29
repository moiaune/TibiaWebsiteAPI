<?php
include_once "../TibiaWebAPI.class.php";

$player = new Tibia\Player($_GET['name']);
$isOnline = $player->isOnline();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Is player online?</title>

		<style>
			.Online { color:green; }
			.Offline { color:red; }
		</style>
	</head>
	<body>
		<h1>Is <?= $_GET['name'] ?> online?</h1>
		<p class="<?= $isOnline ?>"><?= $_GET['name'] ?> is <?= $isOnline ?></p>
	</body>
</html>
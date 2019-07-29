<?php
include_once "../TibiaWebAPI.class.php";

$vip = array(
	"Kamerat",
	"Pyruvat",
	"CM Mirade",
	"Sir Sippo"
);
$status = array(
	"online" => array(),
	"offline" => array()
);

foreach($vip as $playerName) {
	$player = new Tibia\Player($playerName);
	if($player->isOnline() === "Online") {
		$status['online'][] = $playerName;
	} else {
		$status['offline'][] = $playerName;
	}
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Is player online?</title>

		<style>
			.online { color:green; }
			.offline { color:red; }
		</style>
	</head>
	<body>
		<h1>VIP</h1>
		<ul>
		<?php foreach($status['online'] as $name): ?>
			<li class="online"><?= $name ?></li>
		<?php endforeach; foreach($status['offline'] as $name): ?>
			<li class="offline"><?= $name ?></li>
		<?php endforeach; ?>
		</ul>

	</body>
</html>

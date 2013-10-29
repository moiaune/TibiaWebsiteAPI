Tibia Website API
======================

This is a simple PHP class to extracting information from the official Tibia website (http://www.tibia.com)

Usage
--------------
To get information about a specific player

	<?php

	$player = new Tibia\Player("Player Name");

To get information about a specific guild

	<?php

	$guild = new Tibia\Guild("Guild name");

Methods
--------------

**Player
- getOtherChars() : Returns an array of other listed chars if any. False if not.
- getDeaths() : Returns an array of deaths if any listed. False if not.
- isOnline($alt = array('Online', 'Offline')) : Check wether the person is online or offline.

**Guild
- getMembers() : Returns an array of members
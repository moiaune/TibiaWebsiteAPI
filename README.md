Tibia Website API
====================

This is a simple PHP class to extracting information from the official Tibia website (http://www.tibia.com)

Methods
------------------
**Player**
- getOtherChars() : *Returns an array of other listed chars if any. False if not.*
- getDeaths() : *Returns an array of deaths if any listed. False if not.*
- isOnline($alt = array('Online', 'Offline')) : *Check wether the person is online or offline.*

**Guild**
- getMembers() : *Returns an array of members.*

Properties
-------------------
**Player**
- $name
- $sex
- $vocation
- $level
- $points : *Achievment Points*
- $world
- $formerWorld
- $city
- $house
- $guild
- $lastLogin
- $comment
- $status : *Account status (Free account | Premium account)*
- $created

**Guild**
- $name
- $description
- $founded
- $guildHall

Usage
----------------
Include the class

	include_once "TibiaWebAPI.class.php";

Initiate a player object

	$player = new Tibia\Player("Player Name");

Initiate a guild object

	$guild = new Tibia\Guild("Guild name");

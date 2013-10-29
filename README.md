Tibia Website API
====================

This is a simple PHP class to extracting information from the official Tibia website (http://www.tibia.com)

Methods
------------------
**Player**
- __getOtherChars()__ : Returns an array of other listed chars if any. False if not.
- __getDeaths()__ : Returns an array of deaths if any listed. False if not.
- __isOnline($alt = array('Online', 'Offline'))__ : Check wether the person is online or offline.

**Guild
- __getMembers()__ : Returns an array of members

Properties
-------------------
**Player**
- $name
- $sex
- $vocation
- $level
- $points : Achievment Points
- $world
- $formerWorld
- $city
- $house
- $guild
- $lastLogin
- $comment
- $status : Account status (Free account | Premium account)
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

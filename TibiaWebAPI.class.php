<?php
namespace Tibia;

/**
 * @author Mads Dahlen Aune
 * @version 0.1
 * @package Tibia
*/
class Player {

	public $name;
	public $sex;
	public $vocation;
	public $level;
	public $points;
	public $world;
	public $formerWorld;
	public $city;
	public $house;
	public $guild;
	public $lastLogin;
	public $comment;
	public $status;
	public $created;

	private $_otherChars = array();
	private $_deaths = array();
	
	/**
	 * @param string $playerName The name of player to lookup
	 */
	public function __construct($playerName) {
		$html = file_get_contents("http://www.tibia.com/community/?subtopic=characters&name=" . urlencode($playerName));

		$this->name = Parser::doesExist(trim(Parser::parse($html, '#Name:</td><td>(.+?)<div#')), $playerName);
		$this->sex = Parser::parse($html, '#Sex:</td><td>(.+?)</td>#');
		$this->vocation = Parser::parse($html, '#Vocation:</td><td>(.+?)</td>#');
		$this->level = Parser::parse($html, '#Level:</td><td>(\d+?)</td>#');
		$this->points = Parser::parse($html, '#Points:</nobr></td><td>(\d+?)</td>#');
		$this->world = Parser::parse($html, '#World:</td><td>(.+?)</td>#');
		$this->formerWorld = Parser::parse($html, '#Former World:</td><td>(.+?)</td>#');
		$this->city = Parser::parse($html, '#Residence:</td><td>(.+?)</td>#');
		$this->house = Parser::parse($html, '#House:</td><td>(.+?)</td>#');
		$this->guild = Parser::parse($html, '#membership:</td><td>(.+?)</td>#');
		$this->lastLogin = Parser::parse($html, '#login:</td><td>(.+?)</td>#');
		$this->comment = Parser::parse($html, '#Comment:</td><td>(.+?)</td>#s');
		$this->status = Parser::parse($html, '#Status:</td><td>(.+?)</td>#');
		$this->created = Parser::parse($html, '#Created:</td><td>(.+?)</td>#');

		$this->_otherChars = Parser::parse($html, '#<NOBR>[0-9].&\#160;(.+?)</NOBR></TD><TD WIDTH=[0-9]+%><NOBR>(.+?)</NOBR>#', true);
		$this->_deaths = Parser::parse($html, '#<td width="[0-9]+%" valign="top" >(.+?)</td><td>(.+?)</td>#', true);
	}

	/**
	 * @return mixed|bool
	 */
	public function getOtherChars() {
		if($this->_otherChars) {
			$tmp = array();
			for($i = 0; $i < count($this->_otherChars); $i++) {
				if($this->_otherChars[$i][1] === $this->name) { continue; }
				$tmp[$i]['name'] = $this->_otherChars[$i][1];
				$tmp[$i]['world'] = $this->_otherChars[$i][2];
			}
			return $tmp;
		}

		return false;
	}

	/**
	 * @return mixed|bool
	 */
	public function getDeaths() {
		if($this->_deaths) {
			$tmp = array();
			for($i = 0; $i < count($this->_deaths); $i++) {
				$tmp[] = $this->_deaths[$i][1] . " " . $this->_deaths[$i][2];
			}

			return $tmp;
		}

		return false;
	}
	
	/**
	 * @param mixed $alt Option to set custom output.
	 * @return string
	 */
	public function isOnline($alt = array('Online', 'Offline')) {
		$html = file_get_contents("http://www.tibia.com/community/?subtopic=worlds&world=" . urlencode($this->_world));
		return (preg_match('#>('.str_replace(' ', '&nbsp;', $this->_name).'?)</a>#', $html)) ? $alt[0] : $alt[1];
	}

}

class Guild {
	public $name;
	public $description;
	public $founded;
	public $guildHall;

	private $_members;


	public function __construct($guildName) {
		$html = file_get_contents("http://www.tibia.com/community/?subtopic=guilds&page=view&GuildName=" . urlencode($guildName));

		$this->name = Parser::doesExist(Parser::parse($html, '#<H1>(.+?)</H1>#'), $guildName);
		$this->description = Parser::parse($html, '#</TABLE><BR>(.+?)<BR>#s');
		$this->founded = Parser::parse($html, '#(The guild was founded on .+?)<BR>#');
		$this->guildHall = Parser::parse($html, '#(Their home .+?)<BR>#');

		$this->_members = Parser::parse($html, '#<TD><A HREF="(.+)">(.+?)</A>#', true);
	}

	public function getMembers() {
		$tmp = array();
		for($i = 0; $i < count($this->_members); $i++) {
			$tmp[$i]['name'] = $this->_members[$i][2];
			$tmp[$i]['link'] = $this->_members[$i][1];
		}
		return $tmp;
	}
}

class Parser {
	public static function parse($source, $pattern, $all = false) {
		if($all) {
			if(preg_match_all($pattern, $source, $matches, PREG_SET_ORDER))
				return $matches;
		} else {
			if(preg_match($pattern, $source, $matches))
				return $matches[1];
		}

		return false;
	}

	public static function doesExist($value, $expected, $failMsg = "Could not find.") {
		// echo "DEBUG: Value: $value Expected: $expected";
		return ($value === $expected) ? $value : exit($failMsg);
	}
}